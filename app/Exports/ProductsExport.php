<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Product;
class ProductsExport implements FromCollection
{

    private  $products_ids;

    public function __construct($products_ids)
    {
        $this->products_ids = $products_ids;
    }

    public function collection()
    {
//       $data=Product::select('products.id','products.full_name','products.name_ar','products.name_en','products.price','products.tax','products.discount_rate',
//           'price_after_discount','quantity','weight','description_ar','description_en','oracle_short_code',
//       'product_categories.id as IntersectionId', 'product_categories.product_id', 'product_categories.category_id',
//           'categories.id as categoryID', 'categories.name_en as categoryNameEn', 'categories.name_ar as categoryNameAr', 'categories.parent_id', 'categories.level', 'categories.is_available'
//       )->join('product_categories','product_categories.product_id','=','products.id')
//       ->join('categories','product_categories.category_id','=','categories.id');
//       if ($this->products_ids !== "0")
//           $data=$data->whereIn('products.id',$this->products_ids);
            return Product::select('products.id'
            )
                ->join('product_categories','product_categories.product_id','=','products.id')
                ->join('categories','product_categories.category_id','=','categories.id')
                ->get();
    }

//    public function headings(): array
//    {
//        return  ['id','full_name','name_ar','name_en','price','tax','discount_rate','price_after_discount',
//            'quantity','weight','description_ar','description_en','oracle_short_code',
//
//            'id', 'product_id', 'category_id',
//           'id', 'name_en', 'name_ar', 'parent_id', 'level', 'is_available'
//
//            ];
//    }
}
