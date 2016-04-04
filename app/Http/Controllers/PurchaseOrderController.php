<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\PurchaseOrder;

class PurchaseOrderController extends Controller
{

    public function index() {
        $purchaseorders = PurchaseOrder::current($this->company->id)->paginate(100);
        return view('purchaseorder.index', compact('purchaseorders'));
    }

}
