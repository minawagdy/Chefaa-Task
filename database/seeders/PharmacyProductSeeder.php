<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Factories\PharmacyProductFactory;
use App\Models\Pharmacy;
use App\Models\Product;
use App\Models\PharmacyProduct;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;


class PharmacyProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
private $pharmacyProductData = [];

 public function run()
    {
      
      $faker = Faker::create();

        
           $pharmacies = Pharmacy::all();
           $products   = Product::all();
           
           foreach($products as $product){ 
           for($i=1;$i<=6;$i++){
            $pharmacyProductData[] = [
            'pharmacy_id'=> $faker->numberBetween($min = 1, $max = 20000),
            'product_id'=>  $product->id,
            'price'=>    $faker->numberBetween($min = 1, $max = 500),
            'quantity'=> $faker->numberBetween($min = 1, $max = 500)
        ];

       }
       }

            $chunks = array_chunk($pharmacyProductData, 7000);

        foreach ($chunks as $chunk) {
            PharmacyProduct::insert($chunk);
        }
        


        
      
       
    }
}