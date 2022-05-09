<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description','image'];


    public function pharmacies(){

        return $this->belongsToMany(Pharmacy::class,'pharmacy_products');
    }


    public function products(){

     return $this->belongsToMany(Product::class,'pharmacy_products');
    }

}


