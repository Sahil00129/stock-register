<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Exports\BulkExport;
use Response;
use App\Imports\BulkImport;
use App\ItemMaster;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use DataTables,Auth;
use PDF;
use Session;
class ImportExportController extends Controller
{
    /**
    * 
    */
    public function importExportView()
    {
       return view('importexport');
    }
    public function import() 
    {
        try
        {   
            $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            fgetcsv($csvFile);
            $ignored = array(); 
            while(($csvData = fgetcsv($csvFile)) !== FALSE){
            $csvData = array_map("utf8_encode", $csvData);
            if($_POST['import_type'] != 1){
            $exists = ItemMaster::where('item_name', '=', $csvData[3])->exists();
            if(!$exists){
                $ignored[] = $csvData[3];
            }
            }
            else{
                $ignored[] = '';
            }
            }
            
            $countIgnored = count($ignored);
             //echo "<pre>"; print_r($countIgnored);die;
            // die;
            $data = Excel::import(new BulkImport,request()->file('file'));
            $response['success'] = true;
            $response['ignoredItems'] = $ignored;
            $response['ignoredcount'] = $countIgnored;
            $response['messages'] = 'Succesfully imported';
            return Response::json($response);

        }catch (\Exception $e) {
            $bug = $e->getMessage();
            $response['success'] = false;
            $response['messages'] = $bug;
            return Response::json($response);
        }
           
        //return back();
    }

    public function list()
    {
        $list = DB::table('item_master')->get();
       return view('pages.items',  ['list' => $list]);
    }

    public function saledata()
    {
        $list = DB::table('sale_data')->get();
       return view('pages.salesData',  ['list' => $list]);
    }

    public function purchasedata()
    {
        $list = DB::table('purchase_data')->get();
       return view('pages.purchaseData',  ['list' => $list]);
    }

    public function getpdf()
    {
        if (Auth::check())
        {
            $user_id = Auth::user()->id;  
            //echo "<pre>";print_r($user_id);die;
            if($user_id == 1) {
              $sites = DB::table('warehouse_sites')->select('site_id')->get(); 
            }
            else{
              $sites = DB::table('users')->select('site_id')->where('id',$user_id)->get();
            } 
            $group = DB::table('item_master')->select('group')->distinct()->get();
             return view('pages.getPdf', ['list' => $group, 'site' => $sites]);
        }
        else{

           return redirect('/login');
        }
     }  


     public function bulkpdf()
     {
         if (Auth::check())
         { 
             $user_id = Auth::user()->id;  
             //echo "<pre>";print_r($user_id);die;
             if($user_id == 1) {
               $sites = DB::table('warehouse_sites')->select('site_id')->get(); 
             }
             else{
               $sites = DB::table('users')->select('site_id')->where('id',$user_id)->get();
             } 
             $group = DB::table('item_master')->select('group')->distinct()->get();
              return view('pages.bulkPdf', ['list' => $group, 'site' => $sites]);
         }
         else{
 
            return redirect('/login');
         }
      }  

    public function getItemsofgroup()
    {
       // echo "<pre>";print_r($_POST);die;
        $packing = DB::table('item_master')->select('pack')->where('group',$_POST['group'])->distinct()->get();
        $response['success'] = true;
        $response['messages'] = $packing;
        return Response::json($response);
    }

    public function getDateFilter()
    {
        try
        {
            $site_id = $_POST['site_id'];
            //echo "<pre>"; print_r($user_id);die;
            $list =  DB::table('item_master')->where('pack', $_POST['packing'])->where('group', $_POST['group'])->get();
            //echo "<pre>"; print_r($list);die;
           $items  = array();
           $count = count($list);
           //echo "<pre>"; print_r($count);

            foreach($list as $item){
               // echo "<pre>"; print_r($item);
                $items['sale'][] =  DB::table('sale_data')->where('item_name', $item->item_name)->where('site_id', $site_id)->whereBetween('bill_date',[$_POST['fromDate'],$_POST['toDate']])->get();
               
                $items['purchase'][] =  DB::table('purchase_data')->where('item_name', $item->item_name)->where('site_id', $site_id)->whereBetween('bill_date',[$_POST['fromDate'],$_POST['toDate']])->get(); 

                $items['stock_trf'][] =  DB::table('stock_transfer')->where('item_name', $item->item_name)->where('site_id', $site_id)->whereBetween('bill_date',[$_POST['fromDate'],$_POST['toDate']])->get();   
                         
            }
            $array = json_decode(json_encode($items), true);
            $saleData = $array['sale'];
            $purchaseData = $array['purchase'];
            $stock_trf = $array['stock_trf'];
            $sale_count = count($saleData);
            $purchase_count = count($purchaseData);
            $trf_count = count($stock_trf);
            $dataCount = $sale_count + $purchase_count + $trf_count;
            $res = array_merge($saleData, $purchaseData, $stock_trf);

            for ($i=0; $i < count($res); $i++) { 
                for ($j=0; $j < count($res[$i]); $j++) { 

                    $doc_type= $res[$i][$j]['document_type'];
                    
               }
               echo "<br>";
            }
            $pdf = PDF::loadHtml('myPDF');
            $sheet = $pdf->setPaper('a4', 'landscape');
           // $pdf->save('pdf/'.$site_id.'.pdf');
            return $pdf->download('pdf/'.$site_id.'.pdf');

        }catch (\Exception $e) {
            $bug = $e->getMessage();
            $response['success'] = false;
            $response['messages'] = $bug;
            return Response::json($response);
        }
           
    }

    public function itemDelete($id)
    {
        $list = ItemMaster::find($id);
        Session::flash('datadelete', 'deleted');
        $list->delete();
        
        return redirect()->back();
    }

}