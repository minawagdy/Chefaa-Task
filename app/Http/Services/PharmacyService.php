<?php

namespace App\Http\Services;

use App\Http\Repositories\PharmacyRepository;

class PharmacyService extends BaseServiceController
{

    private $PharmacyRepository;

    public function __construct(PharmacyRepository  $PharmacyRepository)
    {
        $this->PharmacyRepository = $PharmacyRepository;
    }

    public function getAll($inputData)
    {
        return $this->PharmacyRepository->getAllData($inputData);
    }

    public function updateRow($updatedData , $id)
    {
        return  $this->PharmacyRepository->updateData(['id' => $id] ,$updatedData);
    }

    public function createRow($inputData)
    {
        return  $this->PharmacyRepository->create($inputData);
    }
      public function getAllPharmacyWithOutPagination ()
    {
        return $this->PharmacyRepository->getAll(['id','name','address']);
    }
}
