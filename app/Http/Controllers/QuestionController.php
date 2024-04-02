<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Question;
use App\Models\Questions;
use Illuminate\Http\Request;
use App\Models\QuestionOption;
use Illuminate\Database\QueryException;

class QuestionController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::orderBy('orderBy', 'ASC')->get();
        $questions = Question::get();

        return view('admin.category-questions.index', compact('categories', 'questions'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'categoryId'   => 'required',
            'question'      => 'required|unique:questions,question',
        ]);

        $maxOrderBy = Question::where('categoryId', $request->categoryId)->max('orderBy');

        $record = Question::create([
            'categoryId'    => $request->categoryId,
            'question'      => $request->question,
            'orderBy'       => $maxOrderBy + 1,
        ]);

        foreach ($request->option as $index =>  $option) {
            $isCorrect = $index == $request->correct_answer ? true : false;
            QuestionOption::create([
                'questionId'    => $record->id,
                'option'        => $option,
                'isCorrect'     => $isCorrect,
            ]);
        }


        return response()->json(['success' => true]);
    }

    public function edit($id)
    {
        return Question::with('option')->find($id);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'categoryId'   => 'required',
            'question'      => 'required|unique:questions,question,' . $id,
        ]);

        $records = Question::find($id);
        $records->categoryId    = $request->categoryId;
        $records->question       = $request->question;
        $records->save();

        return response()->json(['success' => true]);
    }

    public function delete($id)
    {
        try {
            Question::find($id)->delete();
            return response()->json(['success' => true]);
        } catch (QueryException $e) {
            return response()->json(['success' => $e]);
        }
    }

    public function updateOrder(Request $request, $id)
    {
        $criteria = Category::findOrFail($id);
        $criteria->orderBy = $request->input('orderBy');
        $criteria->save();

        return response()->json(['message' => 'Order updated successfully']);
    }
}
