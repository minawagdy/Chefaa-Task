<?php

namespace App\Http\Services;

use App\Http\Repositories\ProductRepository;
use App\Libraries\UploadImagesController;

class ProductService extends BaseServiceController
{
    private  $ProductRepository;
    private  $MediaController;

    public function __construct(ProductRepository  $ProductRepository, UploadImagesController $MediaController)
    {
        $this->ProductRepository = $ProductRepository;
        $this->MediaController  = $MediaController;
    }

    public function getAllProduct($inputData)
    {
        return $this->ProductRepository->getAllProduct($inputData);
    }

    public function updateProductRow($updatedData , $id)
    {
        if (isset($updatedData['image']))
            $updatedData['image'] = $this->MediaController->UploadImage($updatedData['image'] ,'images/product');

        return  $this->ProductRepository->updateProduct(['id' => $id] ,$updatedData);
    }

    public function createProductRow($inputData)
    {
        $inputData['image'] = $this->MediaController->UploadImage($inputData['image'] ,'images/product');
        return  $this->ProductRepository->create($inputData);
    }
    
    public function getAllProductWithOutPagination ()
    {
        return $this->ProductRepository->getAll(['id','title','description','image']);
    }
     
}
