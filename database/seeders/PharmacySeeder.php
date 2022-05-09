<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Factories\PharmacyFactory;
use App\Models\Pharmacy;
use Illuminate\Support\Str;

use Faker\Factory as Faker;

class PharmacySeeder extends Seeder
{
    private $pharmacyData = [];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    public function run()
    {
        $faker = Faker::create();
        for ($i=0; $i < 20000; $i++) {
            $pharmacyData[] = [
                'name' => $faker->unique()->name(),
                'address' => $faker->unique()->address(),
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ];
        }


        $chunks = array_chunk($pharmacyData, 2000);

        foreach ($chunks as $chunk) {
            Pharmacy::insert($chunk);
        }
    }



    }

