<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrderUserExport implements FromCollection ,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private  $start_date;
    private  $end_date;
    public function __construct($start_date , $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }
    public function collection()
    {
        //
        $OrderLines= DB::table('order_headers')
            ->join('users', 'order_headers.created_for_user_id', '=', 'users.id')
            ->select(
                     'order_headers.id',
                            'order_headers.payment_code',
                            'order_headers.total_order',
                            'users.full_name',
                            'users.account_type',
                            'users.account_id',
                            'users.phone',
                            'users.telephone',
                            'users.email',
                            'users.address',
                            'users.city',
                            'users.area',
                            'users.building_number',
                            'users.floor_number',
                            'users.apartment_number',
                            'users.landmark',
                            'users.nationality_id',

                            'order_headers.order_type',
                            'order_headers.shipping_amount',
                            'order_headers.payment_status',
                            'order_headers.order_status',
                            'order_headers.shipping_date',
                            'order_headers.delivery_date',
                            'order_headers.wallet_status',
                            'order_headers.wallet_used_amount',
                            'order_headers.gift_category_id',
                            'order_headers.created_at',


            )
            ->orderBy('order_headers.created_at')
            ->whereBetween('order_headers.created_at',[$this->start_date, $this->end_date])
            ->get();
        return  $OrderLines;

    }


    public function headings(): array
    {
        return [
      "Invoice Number",
                        "payment_code",
                        "total_order",
                        "User Name",
                        "User Type",
                        "User Serial Number",
                        "User phone",
                        "User landline number",
                        "User email",
                        "User Street",
                        "User City",
                        "User Area",
                        "User Building Number",
                        "User Floor Number",
                        "User Apartment Number",
                        "User Landmark",
                        "User NationalID",

                        "order_type",
                        "shipping_amount",
                        "payment_status",
                        "order_status",
                        "shipping_date",
                        "delivery_date",
                        "wallet_status",
                        "wallet_used_amount",
                        "gift_category_id",
                        "Date",
        ];
    }
}
