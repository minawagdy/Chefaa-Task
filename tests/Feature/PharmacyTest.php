<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PharmacyTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

      public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
   public function a_thread_can_be_deleted(){
       
       $response = $this->post('/pharmacy',[
            'name'=> 'El Ezaby',
            'address'=>'Ain Shams'
        ]);

       $this->assertOk();
       $this->assertCount(1,Pharmacy::all());

       $pharmacy = Pharmacy::first();

       $this->assertEqual($pharmacy->name,'Test Name');
       $this->assertEqual($pharmacy->address,'Test Address');
    }
    
}
