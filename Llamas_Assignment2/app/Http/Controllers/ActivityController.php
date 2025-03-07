<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function customerMethod($custid, $name, $address){
        return view('customer',
        [
            'custid' => $custid,
            'name' => $name,
            'address' => $address,
        ]);
    }

    public function itemMethod($itemno, $name, $price){
        return view('item',
        [
            'itemno' => $itemno,
            'name' => $name,
            'price' => $price,
        ]);
    }

    public function orderMethod($custid, $name, $orderno, $date){
        return view('order', [
            'custid' => $custid,
            'name' => $name,
            'orderno' => $orderno,
            'date' => $date,
        ]);
    }

    public function orderdetailsMethod($transno, $orderno, $itemid, $name, $price, $qty){
        return view('orderdetails',[
            'transno' => $transno,
            'orderno' => $orderno,
            'itemid' => $itemid,
            'name' => $name,
            'price' => $price,
            'qty' => $qty,
        ]);
    }
}
