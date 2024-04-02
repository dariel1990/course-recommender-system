<?php

namespace App\Http\Controllers;

use App\Models\Faculties;
use App\Models\Evaluation;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\EvaluationService;
use App\Rules\DuplicatedAcademicYear;
use App\Services\AcademicYearService;
use Illuminate\Database\QueryException;

class AcademicYearController extends Controller
{
    protected $evaluationService;
    protected $academicYearService;

    public function __construct(EvaluationService $evaluationService, AcademicYearService $academicYearService)
    {
        $this->evaluationService    = $evaluationService;
        $this->academicYearService  = $academicYearService;
    }

    public function index(Request $request)
    {
        $data = AcademicYear::get();
        return view('admin.academic-year.index', compact('data'));
    }

    public function create()
    {
        return view('admin.academic-year.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'academic_year'     => ['required', new DuplicatedAcademicYear($request->semester)],
            'semester'          => 'required',
        ]);

        $record = AcademicYear::create([
            'academic_year'     => $request->academic_year,
            'semester'          => $request->semester,
        ]);

        return redirect()->route('academic.year')
            ->with('success', 'Record added successfully');
    }

    public function edit($id)
    {
        $acad = AcademicYear::find($id);

        return view('admin.academic-year.edit', compact('acad'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'academic_year' => [
                'required',
                'unique:academic_years,academic_year,' . $id
            ],
            'semester'      => 'required',
        ]);
        //update
        $records = AcademicYear::find($id);
        $records->academic_year = $request->academic_year;
        $records->semester = $request->semester;
        $records->save();

        return redirect()->route('academic.year')
            ->with('success', 'Record updated successfully');
    }

    public function delete($id)
    {
        try {
            DB::table("academic_years")->where('id', $id)->delete();
            return response()->json(['success' => true]);
        } catch (QueryException $e) {
            return response()->json(['success' => false]);
        }
    }

    public function updateDefaultStatus(Request $request, $id)
    {
        $currentDefaultRow = AcademicYear::where('isDefault', true)->first();

        if ($currentDefaultRow) {
            $currentDefaultRow->update(['isDefault' => false]);
        }

        $newDefaultRow = AcademicYear::findOrFail($id);

        $newDefaultRow->update(['isDefault' => true]);

        return redirect()->back()->with('success', 'Default status updated successfully.');
    }
}
