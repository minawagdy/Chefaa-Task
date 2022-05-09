<?php

namespace App\Http\Repositories;

interface PharmacyRepository
{
    public function getAllData($inputData);
    public function updateData($conditions , $updatedData);
}
