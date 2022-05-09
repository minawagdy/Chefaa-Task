<?php

namespace App\Http\Repositories;

interface PharmacyProductRepository
{
    public function getAllPharmacyProduct($inputData);
    public function updatePharmacyProduct($conditions , $updatedData);
}
