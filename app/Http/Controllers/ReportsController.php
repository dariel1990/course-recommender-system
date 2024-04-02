<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Category;
use App\Models\Question;
use App\Models\Settings;
use App\Models\ExamResult;
use App\Models\Examination;
use Illuminate\Support\Facades\App;

class ReportsController extends Controller
{
    public function printExamResult($examinationId)
    {
        $settings = [
            'SCHOOL_NAME'                           => Settings::where('Keyname', 'SCHOOL_NAME')->first(),
            'CAMPUS_NAME'                           => Settings::where('Keyname', 'CAMPUS_NAME')->first(),
            'CAMPUS_ADDRESS'                        => Settings::where('Keyname', 'CAMPUS_ADDRESS')->first(),
            'ASSISTANT_CAMPUS_DIRECTOR'             => Settings::where('Keyname', 'ASSISTANT_CAMPUS_DIRECTOR')->first(),
            'ASSISTANT_CAMPUS_DIRECTOR_POSITION'    => Settings::where('Keyname', 'ASSISTANT_CAMPUS_DIRECTOR_POSITION')->first(),
            'CAMPUS_DIRECTOR'                       => Settings::where('Keyname', 'CAMPUS_DIRECTOR')->first(),
            'CAMPUS_DIRECTOR_POSITION'              => Settings::where('Keyname', 'CAMPUS_DIRECTOR_POSITION')->first(),
            'GC'                                    => Settings::where('Keyname', 'GC')->first(),
            'GC_POSITION'                           => Settings::where('Keyname', 'GC_POSITION')->first(),
        ];

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

        $pdf = App::make('snappy.pdf.wrapper');

        $pdf->loadView(
            'admin.reports.results-pdf',
            compact(
                'examination',
                'course1',
                'course2',
                'categories',
                'catCount',
                'questionCount',
                'categoryScores',
                'totalScore',
                'settings'
            )
        )
            ->setOrientation('portrait')
            ->setOption('page-width', '215.9')
            ->setOption('page-height', '330.2');

        return $pdf->inline();
    }
}
