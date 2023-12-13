<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bill;
use App\Models\Bill_list;

class BillController extends Controller
{
    //
    public function index($id){
        $bills = Bill::where('bill_id',$id)->get();
        $bill_lists = Bill_List::where('bill_id',$id)->get();

        return view('bill')->with('bills',$bills)->with('bill_lists',$bill_lists)->with('bill_id',$id);
}
}
