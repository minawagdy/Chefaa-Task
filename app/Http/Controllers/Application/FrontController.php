<?php

namespace App\Http\Controllers\Application;

use App\Http\Services\FrontService;
use App\Libraries\ApiResponse;
use App\Libraries\ApiValidator;
use Illuminate\Http\Request;
use Response;

class FrontController extends HomeController
{
    private  $API_VALIDATOR;
    private  $API_RESPONSE;
    private  $FrontService;

    public function __construct(ApiValidator  $apiValidator, ApiResponse  $API_RESPONSE, FrontService $FrontService)
    {
        $this->API_RESPONSE      = $API_RESPONSE;
        $this->API_VALIDATOR     = $apiValidator;
        $this->FrontService      = $FrontService;
    }

    public function getProduct(Request  $request)
    {
        $search = $request->input('search');
        $search_product = $this->FrontService->getProduct($search);
         return Response::json($search_product);
    }

      public function getProductDetails($id)
    {
        $search_product = $this->FrontService->getProductDetails($id);
         return Response::json($search_product);
    }
}
