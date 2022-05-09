<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ProductsExport;
use App\Http\Requests\ProductChangeStatusRequest;
use App\Http\Requests\ProductExportRequest;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\StoreProductRequest;
use App\Http\Services\CategoryService;
use App\Http\Services\CompanyService;
use App\Http\Services\ProductService;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class ProductsController extends HomeController
{
    private $ProductService;
    private $CategoryService;
    private $CompanyService;

    public function __construct(ProductService $ProductService,
                                CategoryService  $CategoryService,
                                CompanyService  $CompanyService)
    {
        $this->ProductService  = $ProductService;
        $this->CategoryService = $CategoryService;
        $this->CompanyService  = $CompanyService;
    }

    public function index()
    {
        $data = $this->ProductService->getAll(request()->all());

        return view('AdminPanel.PagesContent.Products.index')->with('products',$data);
    }

    public function create()
    {
        $categories = $this->CategoryService->getAllSubCategories();
        $companies  = $this->CompanyService->getAll();
        return view('AdminPanel.PagesContent.Products.edit',compact('categories','companies'));
    }

    public function store(StoreProductRequest $request)
    {
        $validated = $request->validated();
        $this->ProductService->createRow($validated);
        return redirect()->route('products.index')->with('message',' Product Created Successfully');
    }

    public function show(Product $product)
    {
        return view('AdminPanel.PagesContent.Products.show',compact('product'));
    }

    public function edit(Product $product)
    {
        $newCategories = $this->CategoryService->getAllSubCategories();
        $companies = $this->CompanyService->getAll();

        return view('AdminPanel.PagesContent.Products.edit',compact('product','newCategories','companies'));
    }

    public function update(ProductRequest $request,$id)
    {
        $validated = $request->validated();
        $this->ProductService->updateRow($validated , $id);
        return redirect()->back()->with('message','Product Updated Successfully');
    }
    public function destroy(Product $product)
    {

    }

    public function changeStatus(ProductChangeStatusRequest $request)
    {
        $inputData =$request->validated();
        $products_ids = explode(",", $inputData['products_ids']);
        if($products_ids[0] == 'on')
            $products_ids[0]= 0;
        $stock_status = $inputData['stock_status'];
        $this->ProductService->changeStatus($products_ids ,$stock_status );
        return redirect()->back()->with('message','Products Updated Successfully');
    }

    public function ExportProductsSheet(ProductExportRequest $request)
    {
        $inputData =$request->validated();
        if ($inputData['products_ids'] === "0"){

//            $data=Product::select('products.id','products.full_name','products.name_ar','products.name_en','products.price',
//                'products.tax','products.discount_rate',
//                'price_after_discount','quantity','oracle_short_code',
//                'product_categories.id', 'product_categories.product_id', 'product_categories.category_id',
//             'categories.id', 'categories.name_en', 'categories.parent_id',
//                'categories.level','categories.is_available'
//                )
//                ->join('product_categories','product_categories.product_id','=','products.id')
//                ->join('categories','product_categories.category_id','=','categories.id')
//                ->get();
//            return $data;

            try{
                return Excel::download(new ProductsExport($inputData['products_ids']), 'products.xlsx');

            }catch(\Exception $e){
                return $e->getMessage();
        }
        }
        else {
            $products_ids = explode(",", $inputData['products_ids']);
            if ($products_ids[0] == 'on')
                $products_ids[0] = 0;
            return Excel::download(new ProductsExport($products_ids), 'products.xlsx');

        }

        }


}
