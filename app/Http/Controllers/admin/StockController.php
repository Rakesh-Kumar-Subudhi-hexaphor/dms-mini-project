<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        $stocks = Stock::with('product')->get();
        return view('admin.stock.index', compact('stocks'));
    }

    public function create()
    {
        $products = Product::all();
        return view('admin.stock.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',

        ]);

        Stock::create($request->all());

        return redirect()->route('admin.stock')->with('success', 'Stock entry created successfully!');
    }

    public function show($id)
    {
        $stock = Stock::findOrFail($id);
        $products = Product::all();
        return view('admin.stock.edit', compact('stock', 'products'));
    }

    public function update(Request $request, $id)
    {
        $stock = Stock::findOrFail($id);

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $stock->update($request->all());

        return redirect()->route('admin.stock')->with('success', 'Stock entry updated successfully!');
    }
}
