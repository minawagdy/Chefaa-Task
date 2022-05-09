<?php

namespace Khaleds\Voucher\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;


    public function Users(){

        return $this->hasOne(UserVoucher::class)->orderBy('created_at');
    }
}
