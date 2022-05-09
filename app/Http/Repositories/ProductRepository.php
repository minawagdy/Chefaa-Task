<?php

namespace App\Http\Repositories;

interface ProductRepository
{
    public function getAllProduct($inputData);
    public function updateProduct($conditions, $updatedData);
}
