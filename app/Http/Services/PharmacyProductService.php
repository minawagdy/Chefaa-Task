<?php

namespace App\Http\Services;

use App\Http\Repositories\PharmacyProductRepository;

class PharmacyProductService extends  BaseServiceController
{

    private $PharmacyProductRepository;

    public function __construct(PharmacyProductRepository $PharmacyProductRepository)
    {
        $this->PharmacyProductRepository = $PharmacyProductRepository;
    }

    public function getAllPharmacyProduct($inputData)
    {
        return $this->PharmacyProductRepository->getAllPharmacyProduct($inputData);
    }

    public function updatePharmacyProductRow($updatedData , $id)
    {
        return  $this->PharmacyProductRepository->updatePharmacyProduct(['id' => $id] ,$updatedData);
    }

    public function createPharmacyProductRow($inputData)
    {
        return  $this->PharmacyProductRepository->create($inputData);
    }

}
