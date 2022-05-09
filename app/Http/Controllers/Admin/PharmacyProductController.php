<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UpdatePharmacyProductRequest;
use App\Http\Services\PharmacyProductService;
use App\Http\Services\PharmacyService;
use App\Http\Services\ProductService;
use App\Models\PharmacyProduct;
use Illuminate\Http\Request;

class PharmacyProductController extends HomeController
{

    private  $PharmacyProductService;
    private  $PharmacyService;
    private  $ProductService;

    public function __construct(PharmacyProductService $PharmacyProductService, PharmacyService  $PharmacyService
        ,ProductService $ProductService
         )
    {
        $this->PharmacyProductService = $PharmacyProductService;
        $this->PharmacyService        = $PharmacyService;
       $this->ProductService         = $ProductService;

    }

    public function index()
    {
        $pharmacyProduct = $this->PharmacyProductService->getAllPharmacyProduct(request()->all());
        return view('AdminPanel.PagesContent.PharmacyProduct.index')->with('pharmacyProduct',$pharmacyProduct);
    }

    public function create()
    {
        $pharmacy = $this->PharmacyService->getAllPharmacyWithOutPagination();
        $product = $this->ProductService->getAllProductWithOutPagination();
        return view('AdminPanel.PagesContent.PharmacyProduct.edit',compact('pharmacy','product'));
    }

    public function store(UpdatePharmacyProductRequest $request)
    {
        $validated = $request->validated();
        $this->PharmacyProductService->createPharmacyProductRow($validated);
        return redirect()->route('pharmacyProduct.index')->with('message','Pharmacy Product Created Successfully');
    }

    public function show(PharmacyProduct $pharmacyProduct)
    {

    }

    public function edit(PharmacyProduct $pharmacyProduct)
    {
        $pharmacy = $this->PharmacyService->getAllPharmacyWithOutPagination();
        $product  = $this->ProductService->getAllProductWithOutPagination();
        return view('AdminPanel.PagesContent.PharmacyProduct.index',compact('pharmacy','product','pharmacyProduct'));
    }

    public function update(UpdatePharmacyProductRequest $request, $id)
    {
        $validated = $request->validated();
        $this->PharmacyProductService->updatePharmacyProductRow($validated , $id);
        return redirect()->route('pharmacyProduct.index')->with('message','Pharmacy Product Updated Successfully');
    }

    public function destroy(PharmacyProduct $pharmacyProduct)
    {
        $pharmacyProduct->delete();
        return redirect()->route('pharmacyProduct.index')->with('message', 'Pharmacy Product Deleted Successfully');
    }
}
