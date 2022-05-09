<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Pharmacy;
use App\Models\Product;
use App\Models\PharmacyProduct;

use Illuminate\Support\Facades\Response;

use Illuminate\Support\Facades\DB;

class CheapestProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:search-cheapest {product_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Cheapest Pharmacies Buy Product By Id';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
       $product_id = $this->argument('product_id');

        $product = Product::where('id', $product_id)->first();

       if ($this->confirm('This will Show Last Cheapest Pharmacies that sell "'.$product->title.'", continue?')) {

     $pharmacy=DB::table('pharmacy_products')
        ->join('pharmacies', 'pharmacy_products.pharmacy_id', '=', 'pharmacies.id')
        ->join('products', 'pharmacy_products.product_id', '=', 'products.id')
        ->select('pharmacies.id', 'pharmacies.name','pharmacy_products.price')
        ->where('pharmacy_products.product_id',$product_id)
        ->limit(5)
        ->orderby('pharmacy_products.price','asc')
        ->get();

        echo json_encode($pharmacy,JSON_PRETTY_PRINT);






}
}
}
