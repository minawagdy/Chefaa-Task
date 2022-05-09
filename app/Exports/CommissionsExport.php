<?php

namespace App\Exports;

use App\Models\UserCommission;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CommissionsExport implements FromCollection , WithHeadings
{

    private  $start_date;
    private  $end_date;
    private $data;
    public function __construct($start_date , $end_date,$data)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->data=$data;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {

        $returned=array();
        foreach($this->data as $row){
            $exported['ID']=$row->id;
            $exported['User ID']=$row->user->id;
            $exported['Nationality ID']=$row->user->nationality_id;
            $exported['User Name']=$row->user->full_name;
            $exported['Redeem Flag']=$row->is_redeemed;
            $exported['Date Of Redeem']=$row->redeem_date;
            $exported['User Acount']=$row->user->userType->name_en;
            $exported['User Name Order']=($row->createdFor)?$row->createdFor->full_name:'';
            $exported['Order Level']=($row->level)?$row->level->level:0;
            $exported['Commission Percentage']=$row->commission_percentage;
            $exported['Order Number']=($row->order)?$row->order->id:'';
            $exported['Payment Code']=($row->order)?$row->order->payment_code:'';
            $exported['Total Order']=($row->order)?$row->order->total_order:'';
            $exported['Order Type']=($row->order)?$row->order->order_type:'';
            $exported['Commission']=$row->commission;
            $exported['Front ID Image']=url(($row->createdFor)?$row->createdFor->front_id_image:'');
            $exported['Back ID Image']=url(($row->createdFor)?$row->createdFor->back_id_image:'');
            $exported['Create AT']=$row->created_at;
            $exported['PAID']=$row->is_paid;
            array_push($returned,$exported);

        }

        return collect($returned);

    }

    public function headings() :array
    {
        return
    ['ID',
                        'User ID',
                        'Nationality ID',
                        'User Name',
                        'Redeem Flag',
                        'Date Of Redeem',
                        'User Acount',
                        'User Name Order',
                        'Order Level',
                        'Commission Percentage',
                        'Order Number',
                        'Payment Code',
                        'Total Order',
                        'Order Type',
                        'Commission',
                        'Create AT',
                        'Front ID Image',
                        'Back ID Image',
                        'PAID'
    ];
    }
//    public function collection()
//    {
//        dd( UserCommission::select([
//                                        "users.account_id"
//                                        ,"users.full_name","users.email","users.phone",
//                                        DB::raw('(CASE WHEN user_commissions.is_redeemed = 0 THEN "Not Redeemed" ELSE "Redeemed" END) AS is_user'),
//                                        "user_commissions.redeem_date",
//                                        DB::raw("SUM(user_commissions.commission) as count"),
//                                        "user_commissions.created_at",
//                                        "user_commissions.is_paid"
//                                        ])
//                                ->join('order_headers','order_headers.id','user_commissions.order_id')
//                                ->join('users','users.id','user_commissions.commission_by')
//                                ->havingBetween('user_commissions.created_at',[$this->start_date, $this->end_date])
//                                ->having('user_commissions.is_paid',1)
//                                ->groupBy('user_commissions.is_redeemed','users.account_id')
//                                ->get()
//        );
//    }
//
//    public function headings() :array
//    {
//        return ["account_id","nationality_id","full_name","email","phone","is_redeemed","redeem_date","commission"];
//    }
}
