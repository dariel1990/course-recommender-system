<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Department;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $defaultAY = AcademicYear::where('isDefault', true)->first();
        $departments = Department::get();
        $courses = Course::where('academicId', $defaultAY->id)->get();

        return view('admin.department-courses.index', compact('departments', 'courses', 'defaultAY'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'academicId'        => 'required',
            'departmentId'      => 'required',
            'courseCode'        => 'required',
            'courseDesc'        => 'required',
            'passingRate'       => 'required',
        ]);

        $record = Course::create([
            'academicId'            => $request->academicId,
            'departmentId'          => $request->departmentId,
            'courseCode'            => $request->courseCode,
            'courseDesc'            => $request->courseDesc,
            'passingRate'           => $request->passingRate,
        ]);

        return response()->json(['success' => true]);
    }

    public function edit($id)
    {
        return Course::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'academicId'        => 'required',
            'departmentId'      => 'required',
            'courseCode'        => 'required',
            'courseDesc'        => 'required',
            'passingRate'       => 'required',
        ]);

        $records = Course::find($id);
        $records->academicId        = $request->academicId;
        $records->departmentId      = $request->departmentId;
        $records->courseCode        = $request->courseCode;
        $records->courseDesc        = $request->courseDesc;
        $records->passingRate       = $request->passingRate;
        $records->save();

        return response()->json(['success' => true]);
    }

    public function delete($id)
    {
        try {
            Course::find($id)->delete();
            return response()->json(['success' => true]);
        } catch (QueryException $e) {
            return response()->json(['success' => $e]);
        }
    }
}
