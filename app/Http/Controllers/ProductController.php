<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $product = new Product();

        if($request->has('action') && $request->get('action') === 'search') {
            $products = $product->filterAll($request);
        } else {
            $products = $product->orderBy('created_at', 'desc')->paginate(10);
        }

        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(ProductRequest $request)
    {
        try {
            $data = $request->all();
            $product = new Product();
            $product->create($data);

            $request->session()->flash('success', 'Registro gravado com sucesso!');
        } catch (\Exception $e) {
            $request->session()->flash('error', 'Ocorreu um erro ao tentar gravar esses dados!');
        }

        return redirect()->back();
    }

    public function show(Product $product)
    {
        //
    }

    public function edit(Request $request, Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        try {
            $data = $request->all();
            $product->update($data);

            $request->session()->flash('success', 'Registro atualizado com sucesso!');
        } catch (\Exception $e) {
            $request->session()->flash('error', 'Ocorreu um erro ao tentar atualizar esses dados!');
        }

        return redirect()->back();
    }

    public function destroy(Product $product)
    {
        //
    }
}
