<?php

namespace App\Http\Repositories;

use App\Models\PharmacyProduct;

class IPharmacyProductRepository extends BaseRepository implements PharmacyProductRepository
{

    public function __construct(PharmacyProduct $model)
    {
        parent::__construct($model);
    }
    public function getAllPharmacyProduct($inputData)
    {
        $pharmacyProduct = PharmacyProduct::orderBy('id','asc');
        
        return  $pharmacyProduct->paginate($this->defaultLimit);
    }

    public function updatePharmacyProduct($conditions, $updatedData)
    {
        return PharmacyProduct::where($conditions)->update($updatedData);
    }
}
