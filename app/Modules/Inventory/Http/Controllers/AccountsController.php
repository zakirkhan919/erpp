<?php

namespace App\Modules\Inventory\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Libraries\CommonFunction;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;
use Session;

class AccountsController extends Controller
{
    public function accounts(){

        $list =  DB::table('purchases')->select(
            'purchases.product_id',
            'purchases.quantity',
            'products.price',
            'sells.selling_quantity'

        )
        ->join('products','products.id','=','purchases.product_id')
        ->join('sells','sells.product_id','=','purchases.product_id')
        ->get()
        ->map(function ($item) {
            $total_purchased_amount = $item->price * $item->quantity;
            $total_sold_amount = $item->price * $item->selling_quantity;
            $item->total_purchased_amount = $total_purchased_amount;
            $item->total_sold_amount = $total_sold_amount;
            return $item;
        });

        $totalPurchasedSum = $list->sum('total_purchased_amount');
        $totalSoldSum = $list->sum('total_sold_amount');


        return view("Inventory::accounts.index", compact('totalPurchasedSum','totalSoldSum'));
    }


}
