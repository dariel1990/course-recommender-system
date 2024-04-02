<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Students;
use App\Models\Subjects;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use App\Models\SubjectStudents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $data = Students::get();
        return view('admin.students.index', compact('data'));
    }

    public function create()
    {
        $pageTitle = "Student Registration";
        $courses = Course::get();
        $defaultAY = AcademicYear::where('isDefault', true)->first();
        return view('admin.students.create', compact('pageTitle', 'courses', 'defaultAY'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'firstName'             => 'required',
            'middleName'            => 'required',
            'lastName'              => 'required',
            'birthDate'             => 'required',
            'address'               => 'required',
            'citizenship'           => 'required',
            'contactNo'             => 'required',
            'lastSchoolAttended'    => 'required',
            'course1'               => 'required',
            'course2'               => 'required|different:course1',
        ], [
            'course2'               => 'Course 2 must be different from Course 1.'
        ]);

        $record = Students::create([
            'status'                => $request->status,
            'lastName'              => strtoupper($request->lastName),
            'firstName'             => strtoupper($request->firstName),
            'middleName'            => strtoupper($request->middleName),
            'suffix'                => strtoupper($request->suffix),
            'gender'                => $request->gender,
            'birthDate'             => $request->birthDate,
            'citizenship'           => $request->citizenship,
            'ethnicity'             => $request->ethnicity,
            'contactNo'             => $request->contactNo,
            'emailAddress'          => $request->emailAddress,
            'address'               => $request->address,
            'lastSchoolAttended'    => $request->lastSchoolAttended,
            'course1'               => $request->course1,
            'course2'               => $request->course2,
            'academicId'            => $request->academicId,
        ]);

        return redirect()->route('student.index')
            ->with('success', 'Student record saved');
    }

    public function edit($id)
    {
        $pageTitle = "Edit Student Registration Record";
        $student = Students::find($id);
        $courses = Course::get();
        return view('admin.students.edit', compact('student', 'courses', 'pageTitle'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'firstName'             => 'required',
            'middleName'            => 'required',
            'lastName'              => 'required',
            'birthDate'             => 'required',
            'address'               => 'required',
            'citizenship'           => 'required',
            'contactNo'             => 'required',
            'lastSchoolAttended'    => 'required',
            'course1'               => 'required',
            'course2'               => 'required|different:course1',
        ], [
            'course2'               => 'Course 2 must be different from Course 1.'
        ]);

        $data = [
            'status'                => $request->status,
            'lastName'              => strtoupper($request->lastName),
            'firstName'             => strtoupper($request->firstName),
            'middleName'            => strtoupper($request->middleName),
            'suffix'                => strtoupper($request->suffix),
            'gender'                => $request->gender,
            'birthDate'             => $request->birthDate,
            'citizenship'           => $request->citizenship,
            'ethnicity'             => $request->ethnicity,
            'contactNo'             => $request->contactNo,
            'emailAddress'          => $request->emailAddress,
            'address'               => $request->address,
            'lastSchoolAttended'    => $request->lastSchoolAttended,
            'course1'               => $request->course1,
            'course2'               => $request->course2,
            'academicId'            => $request->academicId,
        ];

        $student = Students::findOrFail($id);
        $student->update($data);

        return redirect()->route('student.index')
            ->with('success', 'Changes saved.');
    }

    public function delete($id)
    {
        try {
            Students::find($id)->delete();
            return response()->json(['success' => true]);
        } catch (QueryException $e) {
            return response()->json(['success' => false]);
        }
    }
}
