<?php

namespace App\Http\Repositories;

use App\Models\Pharmacy;
use Illuminate\Database\Eloquent\Model;

class IPharmacyRepository extends BaseRepository implements PharmacyRepository
{
    public function __construct(pharmacy $model)
    {
        parent::__construct($model);
    }

    public function getAllData($inputData)
    {
        $data = Pharmacy::orderBy('id','desc');

        return  $data->paginate($this->defaultLimit);
    }

    public function updateData($conditions, $updatedData)
    {
        return Pharmacy::where($conditions)->update($updatedData);
    }
}
