<?php

namespace App\Http\Controllers\Admin;

use App\Http\Services\OracleProductService;
use App\Http\Services\ProductService;
use Illuminate\Http\Request;

class OracleProductsController extends HomeController
{
    private $ProductService;
    private $OracleProductService;

    public function __construct(ProductService $ProductService ,OracleProductService $OracleProductService)
    {
        $this->ProductService        = $ProductService;
        $this->OracleProductService  = $OracleProductService;
    }


    public function index()
    {
        $data = $this->OracleProductService->getAll(request()->all());
        return json_encode($data);
    }

    public function updateProductsCodes()
    {


        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST',
            'https://oso.akhnatontrade.com/api/RefreshNettinghubItems.php',['verify' => false,
                    'form_params' => array(
                        'number' => '100',
                        'name' => 'Test user',
                    )

                ]);
        $products = $response->getBody();


        if (isset($products))
        {
            $products = json_decode($products);

            foreach ($products as $product)
            {
                $this->OracleProductService->createOrUpdate($product);
            }
            return redirect()->back()->with('message' , "Items Updated  Successfully");
        }
        else
        {
            return redirect()->back()->withErrors(['error' => "error in get Data"]);
        }
    }

    public function updateTableJS(Request $request){

        $products=$request->input('myData');
        if (isset($products))
        {
            $products = json_decode($products);
            foreach ($products as $product)
            {
                $this->OracleProductService->createOrUpdate($product);
            }
            return  "Items Updated  Successfully";
        }
    }
    public function updateProductsPrice()
    {
        $this->OracleProductService->updatePrices();
        return redirect()->back()->with('message' , "Items Prices Updated  Successfully");
    }

    public function getOracleProduct()
    {
        $data = $this->OracleProductService->find(request()->id);
        return json_encode($data);
    }
}
