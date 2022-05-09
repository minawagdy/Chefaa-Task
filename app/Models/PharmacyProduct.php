<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PharmacyProduct extends Model
{
    use HasFactory;
    protected $fillable = ['pharmacy_id', 'product_id','price','quantity'];

   

 public function pharmacy()
    {
        return $this->belongsTo(Pharmacy::class,'pharmacy_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }

}
