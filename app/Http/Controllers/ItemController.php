<?php

namespace App\Http\Controllers;

use App\Item;
use App\Http\Requests;
use Yajra\Datatables\Datatables;

class ItemController extends Controller
{

    public function index() {
        $items = Item::where('company_id',$this->company->id)->paginate(100);
        return view('item.index', compact('items'));
    }

    public function getIndex()
    {
        return view('item.index2');
    }

    public function anyData()
    {

        $items = Item::with('category');

        $result = Datatables::of($items)
            //->editColumn('title', '{!! str_limit($title, 60) !!}')
            ->make(true);

        return Datatables::of($items)
            //->editColumn('title', '{!! str_limit($title, 60) !!}')
            ->make(true);

        //return Datatables::of(Item::query())->make(true);
    }

}
