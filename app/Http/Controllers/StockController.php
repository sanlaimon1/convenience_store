<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            try {
                $data = Stock::latest()->with('product')->get();
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
        $stock = [];
        $products = Product::orderBy('created_at')->get();
        return view('stock.index' , compact('stock' , 'products'));
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
            'prod_id' => 'required|integer',
            'qty' => 'required|string',
        ]);
        DB::beginTransaction();
        try {
            $stock = new Stock();
            $stock->product_id = $request->prod_id;
            $stock->quantity = $request->qty;
            $stock->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $message = $e->getMessage();
            return $message;
        }
        return redirect()->route('stock.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Stock $stock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $id = (int)$id;
        $stock = Stock::find($id);
        $stocks = Stock::get();
        $products = Product::orderBy('created_at')->get();

        return view('stock.index', compact('stock', 'stocks', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'prod_id' => 'required|integer',
            'qty' => 'required|string',
        ]);
        $id = (int)$id;
        DB::beginTransaction();
        try {
            $stock = Stock::find($id);
            $stock->product_id = $request->prod_id;
            $stock->quantity = $request->qty;
            $stock->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $message = $e->getMessage();
            return $message;
        }
        return redirect()->route('stock.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            $id = (int)$id;
            $stock = Stock::find($id);
            $stock->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $message = $e->getMessage();
            return $message;
        };
        return redirect()->route('stock.index')->with('success', 'Stock deleted successfully');;
    }
}
