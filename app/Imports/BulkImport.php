<?php
namespace App\Imports;
use App\ItemMaster;
use App\salesData;
use App\purchaseData;
use App\StockTransfer;
use App\StockBalance;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class BulkImport implements ToModel,WithHeadingRow
{
	/**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if($_POST['import_type'] == 1){
           
            return new ItemMaster([
            'item_name'  => $row['item_name'],
            'item_number'    => $row['item_number'],
            'pack' => $row['pack'],
            'group'   => $row['item_group'],
            'poi'   => $row['perticulars_of_insecticide'],
            'regis_no'   => $row['registration_number']
        ]);
       }

       if($_POST['import_type'] == 2){
        //echo "<pre>"; print_r($row);die;
        set_time_limit(2333);
        if (ItemMaster::where('item_name', '=', $row['item_name'])->exists()) {
            $string = $row['bill_date'];
            $trydate = date("Y-m-d", strtotime(substr($string, -4) . "-" . substr($string, 3, 2) . "-" . substr($string, 0, 2)));
            return new salesData([
                'item_name'  => $row['item_name'],
                'bill_no'    => $row['bill_no'],
                'bill_date' => $trydate,
                'sales_to_customer_name'   => $row['bill_to_customer_name'],
                'quantity_in_kgltr'    => $row['quantity_in_kgltr'],
                'batch_no' =>  $row['batch_number'],
                'mfg_date' =>  $row['manufacturing_date'],
                'exp_date' =>  $row['exp_date'],
                'site_id' =>  $row['site_id'],
                'document_type' => $row['document_type'],
            ]);
         }

       }

       if($_POST['import_type'] == 3){
        //echo "<pre>"; print_r($row);die;  
        if (ItemMaster::where('item_name', '=', $row['item_name'])->exists()) {
        $string = $row['bill_date']; 
        $billDate = date("Y-m-d", strtotime(substr($string, -4) . "-" . substr($string, 3, 2) . "-" . substr($string, 0, 2))); 
        $vendorIn = $row['vendor_invoice_date'];
        $vendorIn_newDate = date("Y-m-d", strtotime(substr($vendorIn, -4) . "-" . substr($vendorIn, 3, 2) . "-" . substr($vendorIn, 0, 2))); 
        return new purchaseData([
            'item_name'  => $row['item_name'],
            'bill_date'    => $billDate,
            'vendor_name' => $row['vendor_name'],
            'batch_number' => $row['batch_number'],
            'mfg_date'    => $row['mfg_date'],
            'exp_date' => $row['exp_date'],
            'vendor_invoice_no'   => $row['vendor_invoice_no'],
            'vendor_invoice_date' => $vendorIn_newDate,
            'quantity_in_kgltr' => $row['quantity_in_kgltr'],
            'site_id' =>  $row['site_id'],
            'document_type' => $row['document_type'],
        ]);
        }
       }

       if($_POST['import_type'] == 4){
        //echo "<pre>"; print_r($row);die;  
        if (ItemMaster::where('item_name', '=', $row['item_name'])->exists()) {
        $string = $row['date']; 
        $billDate = date("Y-m-d", strtotime(substr($string, -4) . "-" . substr($string, 3, 2) . "-" . substr($string, 0, 2))); 
        return new StockTransfer([
            'item_name'  => $row['item_name'],
            'bill_date'    => $billDate,
            'bill_no' => $row['document'],
            'quantity_in_kgltr' => $row['quantity_in_kgltr'],
            'batch_number' => $row['batch_number'],
            'mfg_date'    => $row['mfg_date'],
            'exp_date' => $row['exp_date'],
            'trf_frm_site_id'   => $row['transfer_from_site'],
            'trf_to_site_id' => $row['transfer_to_site'],
            'site_id' => $row['site_id'],
            'document_type' => $row['document_type'],
        ]);
        }
       }

       if($_POST['import_type'] == 5){
        //echo "<pre>"; print_r($row);die;  
        if (ItemMaster::where('item_name', '=', $row['item_name'])->exists()) {
        $pst = date('m'); 
        if($pst<4) {
            $y=date('Y');
            $dtt=$y."-04-01<br/>";
            $pt = date('Y', strtotime('-1 year'));
            $ptt=$pt."-03-31";
            }
            else {
            $y=date('Y', strtotime('1 year'));
            $dtt=$y."-04-01<br/>";
            $pt =date('Y');
            $ptt=$pt."-03-31";
            }
        return new StockBalance([
            'item_name'  => $row['item_name'],
            'fy'    => $ptt,
            'site_id' => $row['site_id'],
            'opening_balance' => $row['opening_balance'],
        ]);
        }
       }
       
    }

    
}