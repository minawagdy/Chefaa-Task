<?php

namespace Tests\Unit;

use Tests\TestCase;

use App\Models\Pharmacy;

use Database\Seeders\PharmacySeeder;


class PharmacyTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_pharmacy_form()
    {
        $response=$this->get('/admin/pharmacy/create');
        $response->assertStatus(200);
    }

    public function test_delete_pharmacy()
    {
        $pharmacy= Pharmacy::factory()->count(1)->make();

        $pharmacy = Pharmacy::first();

        if($pharmacy) {
            $pharmacy->delete();
        }

        $this->assertTrue(true);
    }


    public function test_if_it_stores_pharmacy()
    {
        $response = $this->post('admin/pharmacy', [
            'name'=>'el ezaby',
            'address'=>'241 Gesr Al Suez St El Nozha Cairo Governorate'
        ]);

        $response->assertRedirect('/admin/pharmacy');
    }

    public function test_if_data_exists_in_database()
    {
        $this->assertDatabaseHas('pharmacies', [
            'name' => 'Silas Breitenberg'
        ]);
    }

    public function test_if_data_does_not_exists_in_database()
    {
        $this->assertDatabaseHas('pharmacies', [
            'name' => 'Silas Breitenberg'
        ]);
    }
    public function test_if_seeders_works()
    {
        $this->seed();
    }

    public function test_if_seeder_works()
    {
        $this->seed(PharmacySeeder::class);
    }

}
