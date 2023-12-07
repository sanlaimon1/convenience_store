<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Brand;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            try {
                $data = Product::latest()->get();
                return Datatables::of($data)
                        ->addIndexColumn()
                        ->editColumn('category_id', function($data){
                            return $data->category->category_name;
                        })
                        ->editColumn('brand_id', function($data){
                            return $data->brand->brand_name;
                        })
                        ->addColumn('action', function($row){
                            $btn = '<a href="'. route("product.edit", $row->id) .'" data-id="'.$row->id.'" class="btn btn-primary edit"><i class="mdi mdi-pencil-box"></i></a>';
                            $btn .= ' <a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-danger delete"><i class="mdi mdi-delete-forever"></i></a>';
                            return $btn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()]);
            }
        }
        $product = [];

        return view('product.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $product = '';
        return view('product.form', compact('categories', 'brands', 'product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'model_year' => 'required',
            'list_price' => 'required',
            'category' => 'required',
            'brand' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $product = new Product();
            $product->product_name = $request->product_name;
            $product->model_year = $request->model_year;
            $product->list_price = $request->list_price;
            $product->category_id = $request->category;
            $product->brand_id = $request->brand;

            $product->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $message = $e->getMessage();
            return $message;
        }
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
