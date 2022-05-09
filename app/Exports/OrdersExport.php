<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrdersExport implements FromCollection , WithHeadings
{
    private  $start_date;
    private  $end_date;
    public function __construct($start_date , $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    public function collection()
    {
        $OrderLines= DB::table('order_lines')
            ->join('order_headers', 'order_lines.order_id', '=', 'order_headers.id')
            ->join('users', 'order_headers.created_for_user_id', '=', 'users.id')
            ->join('products', 'order_lines.product_id', '=', 'products.id')
            ->select('users.account_id','order_headers.id','products.oracle_short_code','order_lines.quantity','order_lines.price','order_headers.payment_code','order_headers.gift_category_id')
            ->orderBy('order_lines.oracle_num')
            ->whereBetween('order_headers.created_at',[$this->start_date, $this->end_date])
            ->get();
        return  $OrderLines;
    }

    public function headings(): array
    {
        return ["serial","invoice","item","quantity","price","fawry code","has_free_product"];
    }
}
