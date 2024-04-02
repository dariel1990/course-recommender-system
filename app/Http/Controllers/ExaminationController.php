<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Category;
use App\Models\Question;
use App\Models\Students;
use App\Models\ExamResult;
use App\Models\Examination;
use App\Models\AcademicYear;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\QuestionOption;
use Yajra\DataTables\DataTables;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ExaminationController extends Controller
{
    public function index(Request $request)
    {
        $defaultPeriod = AcademicYear::where('isDefault', true)->first();
        $students = Students::get();

        return view('admin.examination.index', compact('defaultPeriod', 'students'));
    }

    public function dataTableList()
    {
        $defaultPeriod = AcademicYear::where('isDefault', true)->first();

        if (request()->ajax()) {
            $data =  Examination::where('academicId', $defaultPeriod->id)->get();

            return (new DataTables)->of($data)
                ->addColumn('studentFullname', function ($record) {
                    return $record->student->fullname;
                })
                ->addColumn('Status', function ($record) {
                    return $record->student->status;
                })
                ->addColumn('HasCompleted', function ($record) {
                    return $record->hasCompleted;
                })
                ->addColumn('ScheduleDate', function ($record) {
                    return Carbon::parse($record->schedule)->format('F d, Y');
                })
                ->addColumn('ScheduleTime', function ($record) {
                    return Carbon::parse($record->schedule)->format('h:i A');
                })

                ->make(true);
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'studentId'         => 'required',
            'scheduleDate'      => 'required|date',
            'scheduleTime'      => 'required|date_format:H:i',
        ]);

        $scheduleDateTime = Carbon::createFromFormat('Y-m-d H:i', $request->scheduleDate . ' ' . $request->scheduleTime);

        $record = Examination::create([
            'academicId'         => $request->academicId,
            'studentId'          => $request->studentId,
            'schedule'           => $scheduleDateTime,
        ]);

        return response()->json(['success' => true]);
    }

    public function edit($id)
    {
        return Examination::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'studentId'         => 'required',
            'scheduleDate'      => 'required',
            'scheduleTime'      => 'required',
        ]);

        $scheduleDateTime = Carbon::createFromFormat('Y-m-d H:i', $request->scheduleDate . ' ' . $request->scheduleTime);

        $data = [
            'academicId'         => $request->academicId,
            'studentId'          => $request->studentId,
            'schedule'           => $scheduleDateTime,
        ];

        $exam = Examination::findOrFail($id);
        $exam->update($data);

        return response()->json(['success' => true]);
    }

    public function delete($id)
    {
        try {
            Examination::find($id)->delete();
            return response()->json(['success' => true]);
        } catch (QueryException $e) {
            return response()->json(['success' => false]);
        }
    }

    public function examLogin()
    {
        return view('auth.exam-auth');
    }

    public function examAuth(Request $request)
    {
        $validatedData = $request->validate([
            'referenceCode' => 'required|exists:examinations,referenceCode',
        ], [
            'referenceCode.exists' => 'Please enter a valid reference Code.'
        ]);

        $examination = Examination::where('referenceCode', $request->referenceCode)->first();
        if ($examination->hasCompleted) {
            return redirect()->back()->withErrors(['error' => 'This examination has already been completed.']);
        }
        // If reference code is valid, create session and redirect to exam page
        $request->session()->put('referenceCode', $validatedData['referenceCode']);
        return redirect()->route('examination.page');
    }

    public function examPage(Request $request)
    {
        $referenceCode = $request->session()->get('referenceCode');
        $examination = Examination::with('student', 'academicYear')->where('referenceCode', $referenceCode)->first();
        $categories = Category::with('question', 'question.option')->get();

        if ($examination) {
            return view('student.examPage', compact('examination', 'categories'));
        } else {
            return redirect()->route('examination.login');
        }
    }

    public function submitExamination(Request $request, $examinationId)
    {
        $questions = Question::with('option')->get();

        foreach ($questions as $question) {
            $rules['question' . $question->id] = [
                'required'
            ];
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        foreach ($questions as $question) {
            $answer = $request->input('question' . $question->id);
            $selectedOption = QuestionOption::find($answer);
            $isCorrect = $selectedOption->isCorrect ? true : false;

            $data = [
                'examinationId' => $examinationId,
                'questionId'    => $question->id,
                'optionId'      => $answer,
                'isCorrect'     => $isCorrect,
            ];

            ExamResult::create($data);
        }

        $record = Examination::find($examinationId);
        $record->update(['hasCompleted' => true]);

        Session::forget('referenceCode');

        return redirect()->route('examination.done');
    }

    public function examDone()
    {
        return view('student.examDone');
    }

    public function examinationResult($examinationId)
    {
        $categoryScores = [];
        $examination = Examination::find($examinationId);
        $examResults = ExamResult::with('question')->where('examinationId', $examinationId)->get();
        $course1 = Course::where('id', $examination->student->course1)->first()->courseDesc;
        $course2 = Course::where('id', $examination->student->course2)->first()->courseDesc;
        $categories = Category::with('question')->get();
        $catCount = $categories->count();
        $questionCount = Question::get()->count();

        foreach ($categories as $category) {
            $categoryScores[$category->id] = 0;
        }

        foreach ($examResults as $result) {
            if ($result->isCorrect) {
                // Increment score for the category of the question associated with this result
                $categoryScores[$result->question->categoryId]++;
            }
        }
        $totalScore = array_sum($categoryScores);
        return view(
            'admin.examination.result',
            compact('examination', 'course1', 'course2', 'categories', 'catCount', 'questionCount', 'categoryScores', 'totalScore')
        );
    }
}
