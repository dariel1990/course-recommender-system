<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Question;
use App\Models\Questions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class CategoryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required',
        ]);

        $maxOrderBy = Category::max('orderBy');

        Category::create([
            'category' => $request->input('category'),
            'orderBy' => $maxOrderBy + 1,
        ]);

        return response()->json(['success' => true]);
    }

    public function edit($id)
    {
        return Category::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'category' => 'required',
        ]);

        $records = Category::find($id);
        $records->category      = $request->category;
        $records->percentage    = $request->percentage;
        $records->save();

        return response()->json(['success' => true]);
    }

    public function delete($id)
    {
        try {
            Category::find($id)->delete();
            return response()->json(['success' => true]);
        } catch (QueryException $e) {
            return response()->json(['success' => false]);
        }
    }

    public function updateOrder(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->orderBy = $request->input('orderBy');
        $category->save();

        return response()->json(['message' => 'Order updated successfully']);
    }
}
