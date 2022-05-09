<?php

namespace App\Http\Services;

use App\Http\Repositories\ProductRepository;
use App\Models\Product;
use Illuminate\Support\Facades\DB;


class FrontService extends BaseServiceController
{
    private  $ProductRepository;

    public function __construct(ProductRepository  $ProductRepository)
    {
        $this->ProductRepository = $ProductRepository;
    }

    public function getProduct($search = NULL)
    {

        return Product::
        where('title','like','%'.$search .'%')
            ->select(['id', 'title'])
            ->get();
    }
      public function getProductDetails($id = NULL){

        return  DB::table('pharmacy_products')
            ->join('pharmacies', 'pharmacy_products.pharmacy_id', '=', 'pharmacies.id')
            ->join('products', 'pharmacy_products.product_id', '=', 'products.id')
            ->where('pharmacy_products.product_id',$id)
            ->select('pharmacies.name','products.title','products.description','products.image','pharmacy_products.price')
            ->get();
      }


}
