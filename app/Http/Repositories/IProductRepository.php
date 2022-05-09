<?php

namespace App\Http\Repositories;

use App\Models\Product;

class IProductRepository extends BaseRepository implements  ProductRepository
{

    public function __construct(Product $model)
    {
        parent::__construct($model);
    }


    public function getAllProduct($inputData)
    {
        $product = Product::orderBy('id','desc');
        if (isset($inputData['name']))
        {
            $product>where('title','like','%'.$inputData['name'].'%');
        }
        return  $product->paginate($this->defaultLimit);
    }

    public function updateProduct($conditions, $updatedData)
    {
        return Product::where($conditions)->update($updatedData);
    }
}
