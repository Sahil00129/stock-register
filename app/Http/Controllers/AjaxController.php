<?php

namespace App\Http\Controllers;
use App\salesData;
use App\purchaseData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables,Auth;

class AjaxController extends Controller
{
    public function getServerSide(Request $request)
    {
         if ($request->ajax()) {
            $sales = salesData::select('*');
            return Datatables::of($sales)->make(true);
         }

        return view('salesData');
    }

    public function getpurchaseServerSide(Request $request)
    {
         if ($request->ajax()) {
            $purchase = purchaseData::select('*');
            return Datatables::of($purchase)->make(true);
         }

        return view('salesData');
    }
}
