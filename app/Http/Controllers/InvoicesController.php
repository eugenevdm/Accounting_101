<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\InvoiceItem;

class InvoicesController extends Controller
{

    public function index()
    {
        $invoiceitems = InvoiceItem::where('company_id',$this->company->id)->paginate(100);
        return view('invoice.index', compact('invoiceitems'));
    }

}
