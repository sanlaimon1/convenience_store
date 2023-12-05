<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::get();
        $category = [];
        return view('category.index' , compact('categories', 'category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cat_name' => 'required|string',
        ]);
        DB::beginTransaction();
        try {
            $cat = new Category();
            $cat->category_name = $request->cat_name;
            $cat->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $message = $e->getMessage();
            return $message;
        }
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $id = (int)$id;
        $category = Category::find($id);
        $categories = Category::get();

        return view('category.index', compact('category', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'cat_name' => 'required|string',
        ]);
        $id = (int)$id;
        DB::beginTransaction();
        try {
            $cat = Category::find($id);
            $cat->category_name = $request->cat_name;
            $cat->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $message = $e->getMessage();
            return $message;
        }
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request)
    {
        DB::beginTransaction();
        try {
            $id = (int)$id;
            $cat = Category::find($id);
            $cat->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $message = $e->getMessage();
            return $message;
        };
        return redirect()->route('category.index');
    }
}
