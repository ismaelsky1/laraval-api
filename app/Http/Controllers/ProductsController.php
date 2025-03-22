<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{

    private $product;

    public function __construct(Products $product)
    {
        $this->product = $product;
    }

    public function index(Request $request)
    {
        $products = $this->product;

        if ($request->has('fields')) {
            $fields = $request->get('fields');
            $products = $products->select($fields);
        }

        $resp = $products->paginate(10);

        // $products = $this->product->all();
        // return response()->json($products);
        return new ProductCollection($resp);
    }


    public function store(Request $request)
    {
        $data = $request->all();
        $product = Products::create($data);
        return response()->json($product);
    }

    public function show($id)
    {
        // $product = $this->product->find($id);
        // response()->json($product);

        $product = Products::find($id);
        return new ProductResource($product);
    }

    public function update(Request $request)
    {
        $data = $request->all();
        $product = Products::find($data['id']);
        $product->update($data);
        return response()->json($product);
    }


    public function destroy($id)
    {
        $product = Products::find($id);
        $product->delete($id);
        return response()->json($product);
    }
}
