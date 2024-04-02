<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Course;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class DepartmentController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'short_name'        => 'required|unique:departments,short_name',
            'description'       => 'required',
            'program_head'      => 'required',
        ]);

        $record = Department::create([
            'short_name'        => $request->short_name,
            'description'       => $request->description,
            'program_head'      => $request->program_head,
        ]);

        return response()->json(['success' => true]);
    }

    public function edit($id)
    {
        return Department::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'short_name'        => 'required|unique:departments,short_name,' . $id,
            'description'       => 'required',
            'program_head'      => 'required',
        ]);

        $records = Department::find($id);
        $records->short_name    = $request->short_name;
        $records->description   = $request->description;
        $records->program_head  = $request->program_head;
        $records->save();

        return response()->json(['success' => true]);
    }

    public function delete($id)
    {
        try {
            DB::table("departments")->where('id', $id)->delete();
            return response()->json(['success' => true]);
        } catch (QueryException $e) {
            return response()->json(['success' => false]);
        }
    }
}
