<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            try {
                $data = Category::latest()->get();
                return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
                            $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-primary edit"><i class="mdi mdi-pencil-box"></i></a>';
                            $btn .= ' <a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-danger delete"><i class="mdi mdi-delete-forever"></i></a>';
                            return $btn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()]);
            }
        }
        $category = [];
        return view('category.index' , compact('category'));
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
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $id = (int)$id;
        $category = Category::find($id);
        $categories = Category::get();

        return view('category.index', compact('category', 'categories'));
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
    public function destroy(string $id)
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
        return redirect()->route('category.index')->with('success', 'Category deleted successfully');
    }
}
