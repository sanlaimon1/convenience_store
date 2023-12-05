<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::all();
        $brand = [];
        return view('brand.index', compact('brands', 'brand'));
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
    public function edit(Brand $brand)
    {
        //
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
