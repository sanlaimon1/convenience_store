<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            try {
                $data = Brand::latest()->get();
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

        $brand = [];
        return view('brand.index', compact('brand'));
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
            'brand_name' => 'required|string',
        ]);
        DB::beginTransaction();
        try {
            $brand = new Brand();
            $brand->brand_name = $request->brand_name;
            $brand->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $message = $e->getMessage();
            return $message;
        }
        return redirect()->route('brand.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $id = (int)$id;
        $brand = Brand::find($id);
        $brands = Brand::all();

        return view('brand.index', compact('brand', 'brands'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $id = (int)$id;
        $brand = Brand::find($id);
        $brands = Brand::get();

        return view('brand.index', compact('brand', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'brand_name' => 'required|string',
        ]);
        $id = (int)$id;
        DB::beginTransaction();
        try {
            $brand = Brand::find($id);
            $brand->brand_name = $request->brand_name;
            $brand->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $message = $e->getMessage();
            return $message;
        }
        return redirect()->route('brand.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request)
    {
        DB::beginTransaction();
        try {
            $id = (int)$id;
            $brand = Brand::find($id);
            $brand->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $message = $e->getMessage();
            return $message;
        };
        return redirect()->route('brand.index');
    }
}
