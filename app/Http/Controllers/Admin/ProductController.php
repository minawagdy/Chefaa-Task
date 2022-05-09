<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductRequest;
use App\Http\Services\ProductService;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends HomeController
{

    private  $ProductService;

    public function __construct(ProductService $ProductService)
    {
       $this->ProductService = $ProductService;
    }

    public function index()
    {
        $product = $this->ProductService->getAllProduct(request()->all());

        return view('AdminPanel.PagesContent.Product.index')->with('product',$product);
    }

    public function create()
    {

        return view('AdminPanel.PagesContent.product.edit');
    }

    public function store(ProductRequest $request)
    {
        $validated = $request->validated();
        $this->ProductService->createProductRow($validated);
        return redirect()->route('product.index')->with('message','Product Created Successfully');
    }

    public function show(Product  $product)
    {

    }

    public function edit(Product  $product)
    {

        return view('AdminPanel.PagesContent.Product.edit',compact('product'));
    }

    public function update(ProductRequest $request,$id)
    {
        $validated = $request->validated();
        $this->ProductService->updateProductRow($validated , $id);
        return redirect()->back()->with('message','Product Updated Successfully');
    }
    public function destroy(Product  $product)
    {
        @unlink(public_path($product->image));
        $product->delete();
        return redirect()->route('product.index')->with('message', 'Product Deleted Successfully');
    }
}
