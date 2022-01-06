<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Sale Register</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<style>
@page { margin: 150px 50px; }
.header { position: fixed; left: 0px; top: -100px; right: 0px; height: 200px; text-align: center;}
.footer { position: fixed; left: 0px; bottom: -70px; right: 0px; height: 50px;text-align: center;}
footer .pagenum:before { content: counter(page); }
.table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
  page-break-after: always;
  position: relative;
}
.table td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 1px;
}
 </style>
</head>

<body style="font-size:10px;">

     <?php 

    /*********************************** Get opening balance from Stock Opening *****************************************/

    $y=date('Y');
    $opb_date = $y."-04-01";
    $date = new DateTime($fromdt);
    $date->modify('-1 day');
    $lastDay = $date->format('Y-m-d');
    $fy_in =  date('Y', strtotime('-1 year'));
    $fy_end_dt = $fy_in."-03-31";
    $opening = DB::table('stock_opening')->where('item_name', $inm)->where('site_id',  $siteid)->whereDate('fy', '<', $opb_date)->get();
    @$simplyfy = json_decode(json_encode($opening), true);
    if(@$simplyfy[0]['opening_balance'] == "-"){
        $opening_balance = 0;
    }else{
        $opening_balance = @$simplyfy[0]['opening_balance'];
     }
  
    /*********************************** Get opening balance from Sale Data *****************************************/
    
    $preData['sale']= DB::table('sale_data')->where('item_name', $inm)->where('site_id', $siteid)->whereBetween('bill_date',[$opb_date,$lastDay])->get();

    $preData['purchase']= DB::table('purchase_data')->where('item_name', $inm)->where('site_id', $siteid)->whereBetween('bill_date',[$opb_date,$lastDay])->get();

    $preData['stock_trf']= DB::table('stock_transfer')->where('item_name', $inm)->where('site_id', $siteid)->whereBetween('bill_date',[$opb_date,$lastDay])->get();

    $array = json_decode(json_encode($preData), true);
    $saleData = $array['sale'];
    $purchaseData = $array['purchase'];
    $stock_trf = $array['stock_trf'];
    
    $resPre = array_merge($saleData, $purchaseData, $stock_trf);
    if(!empty($resPre)){
    foreach ($resPre as $key => $row) {
        $resPreDate[$key]  = strtotime($row['bill_date']);
    }
    
    array_multisort($resPreDate, SORT_ASC, $resPre);

    $props = ["SalesCreditMemo", "Purchase Invoice", "TransferRcpt", "SalesInvoice", "TransferShpt", "PurchCreditMemo"];

    usort($resPre, function($a, $b) use ($props) {
        return [$a['bill_date'], $a['document_type']]
           <=>
           [$b['bill_date'], $b['document_type']];
    });
   
    $balance_stock = $opening_balance;

    foreach($resPre as $row){
        if($row['document_type'] == 'SalesInvoice'){
          @$balance_stock-= $row['quantity_in_kgltr'];
        }
        elseif($row['document_type'] == 'SalesCreditMemo'){
            @$balance_stock+= $row['quantity_in_kgltr'];
        }
        elseif($row['document_type'] == 'TransferShpt'){
            @$balance_stock-= $row['quantity_in_kgltr'];
        }
        elseif($row['document_type'] == 'Purchase Invoice'){
            @$balance_stock+= $row['quantity_in_kgltr'];
        }
        elseif($row['document_type'] == 'PurchCreditMemo'){
            @$balance_stock-= $row['quantity_in_kgltr'];
        }
        elseif($row['document_type'] == 'TransferRcpt'){
            @$balance_stock+= $row['quantity_in_kgltr'];
        }
      }
    } 
    else{
        $balance_stock = $opening_balance;
     }

    ?>

    <div class="header">

    <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
              <td style="width: 25%;">
              <table border="0" cellspacing="0" cellpadding="0">
                  <tr>
                      <td style="height: 23px;font-size:14px"><label for="username">Particulars of the insecticide:</label>
                      <span>{{  $inm }}</span></td>
                  </tr>

                  <tr>
                      <td style="height: 23px;font-size:14px"><label for="username">Registration number:</label>
                      <span></span></td>
                  </tr>

                  <tr>
                      <td style="height: 23px;font-size:14px"><label for="username">Month and year:</label>
                      <span></span></td>
                  </tr>

              </table></td>

                  <td style="width:20%; text-align:right;font-size:15px">
                  <table border="0" cellspacing="0" cellpadding="0">
                      <tr>
                          <td>
                              <h4>Appendix B</h4>
                              <h4  style="text-align: right;">(See Sub Rule(2) of Rule 15)</h4>
                          </td>
                      </tr>
                  </table></td>

                  <td style="width:35%;font-size:14px">
                  <table>
                      <tr>
                          <td>
                              <p>REGISTER FOR SALE/DISTRIBUTION OF INSECTICIDES (TECHNICAL<br>AND FORMULATION) (INCLUDING INSECTICIDES USED IN<br>COMMERCIAL PEST CONTROL OPERATIONS) </p>
                          </td>
                      </tr>
                  </table>
                 </td>

                  <td style="width:20%;font-size:14px;">
                  <table>
                      <tr>
                          <td><label for="username" >Trade Name:</label>
                          <span>{{ @$group }}</span></td>
                      </tr>

                      <tr>
                          <td>
                              <label for="username">Packing:</label>
                              <span>{{ @$pakingname }}</span>
                          </td>
                      </tr>

                  </table>
                </td>

            </tr>

        </table>

        <table style="border-collapse: collapse; border: 1px solid #dddddd;">
            <tr >
                <th rowspan="2">S.No.</th>
                <th rowspan="2">Date of receipt of the insecticide</th>
                <th rowspan="2">Name of the manufacturer, through whom received</th>
                <th rowspan="2">Name of supplier/distributor, if any, through whom received</th>
                <th rowspan="2">Batch Number</th>
                <th rowspan="2">Date of manufacture</th>
                <th rowspan="2">Date of Expiry</th>
                <th colspan="3">Invoice Details</th>
                <th colspan="6">Quantity(Kg/Lt/Units)</th>
                <th rowspan="2">Bill No.</th>
                <th rowspan="2">Bill Date</th>
                <th rowspan="2">Name & Address to whom sold/distributed</th>
                <th rowspan="2">Remarks</th>
            </tr>
 
              <tr>
                <th>Invoice No.</th>
                <th>Invoice Date</th>
                <th>Quantity (Kg/Lt/Units)</th>
                <th>Previous balance, if any</th>
                <th>Received</th>
                <th>Sold or Distributed</th>
                <th>Return to Supplier</th>
                <th>Stock Transfer to other Depot/Factory</th>
                <th>Balance Stock</th>
                 </tr>
                 <tr>
                 <td style="width:2%">1</td>
                    <td style="width:5.10%">2</td>
                    <td style="width:9.10%">3</td>
                    <td style="width:7.10%">4</td>
                    <td style="width:5.10%">5</td>
                    <td style="width:5.10%">6</td>
                    <td style="width:5.10%">7</td>
                    <td style="width:5.10%">8</td>
                    <td style="width:5.10%">9</td>
                    <td style="width:5.10%">10</td>
                    <td style="width:3.10%">11</td>
                    <td style="width:5.10%">12</td>
                    <td style="width:3.10%">13</td>
                    <td style="width:3.10%">14</td>
                    <td style="width:5.10%">15</td>
                    <td style="width:5.10%">16</td>
                    <td style="width:5.10%">17</td>
                    <td style="width:5.10%">18</td>
                    <td style="width:8.10%">19</td>
                    <td style="width:3.10%">20</td>
                </tr>
          </table>    
        </div>

       <div class="footer">
            <footer>
                    <div class="pagenum-container">Page <span class="pagenum"></span></div>
            </footer>

            <table style="width:100%;">
            <tr>
                <td style="font-size:15px">
                    <table style="" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <p>Verified with the record and found that the above information is correct</p>
                        <p>Date:</p>
                        <p>Signature with date and seal of the Insecticide Inspector</p>
                        </tr>
                    </table>
                </td>

                <td style="font-size:15px">
                    <table border="0" cellspacing="0" cellpadding="0"> 
                    <tr>
                    <p style="text-align: right;">Signature</p>
                        <p style="text-align: right;">Company's seal</p>
                    </tr>
                </table>
                </td>
            </tr>
            </table>
        </div>


    <table  class="table table-striped" style="top:75px">
    <tbody>

                   <?php
                   
                   $last_balance = $balance_stock;
                  // echo "<pre>";print_r();die;
                   ?>
                   @if ($opb_date == $fromdt)
                   <tr>
                    <td colspan="2">{{ $opb_date }}</td>
                    <td colspan="2">O/B</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>{{ $balance_stock }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>{{ $balance_stock }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                   </tr>
                   @endif 

                   @foreach ($listitems as $sldata)
                   @if (@$sldata['document_type'] == 'SalesInvoice')

                   <tr >

                    <td style="width:2%"></td>
                    <td style="width:5.10%"></td>
                    <td style="width:9.10%"></td>
                    <td style="width:7.10%"></td>
                    <td style="width:5.10%">{{ $sldata['batch_no'] }}</td>
                    <td style="width:5.10%">{{ $sldata['mfg_date'] }}</td>
                    <td style="width:5.10%">{{ $sldata['exp_date'] }}</td>
                    <td style="width:5.10%"></td>
                    <td style="width:5.10%"></td>
                    <td style="width:5.10%"></td>
                    <td style="width:3.10%">{{ $last_balance }}</td>
                    <td style="width:5.10%"></td>
                    <td style="width:3.10%">{{ $sldata['quantity_in_kgltr'] }}</td>
                    <td style="width:4.10%"></td>
                    <td style="width:4.10%"></td>
                    <td style="width:5.10%">
                    <?php 

                    $tocl = (int)$sldata['quantity_in_kgltr'];

                    echo @$last_balance -= $tocl; ?>

                    </td>

                    <td style="width:5.10%">{{ $sldata['bill_no'] }}</td>

                    <td style="width:5.10%">{{  date('d-m-Y', strtotime($sldata['bill_date'])) }}</td>

                    <td style="width:8.10%">{{ $sldata['sales_to_customer_name'] }}</td>

                    <td style="width:3.10%"></td>

                   </tr>

                   @endif

                   @if (@$sldata['document_type'] == 'SalesCreditMemo')

                   <tr>

                    <td></td>

                    <td></td>

                    <td></td>

                    <td>{{ $sldata['sales_to_customer_name'] }}</td>

                    <td>{{ $sldata['batch_no'] }}</td>

                    <td>{{ $sldata['mfg_date'] }}</td>

                    <td>{{ $sldata['exp_date'] }}</td>

                    <td>{{ $sldata['bill_no'] }}</td>

                    <td>{{  date('d-m-Y', strtotime($sldata['bill_date'])) }}</td>

                    <td>{{ $sldata['quantity_in_kgltr'] }}</td>

                    <td>{{ $last_balance }}</td>

                    <td></td>

                    <td></td>

                    <td></td>

                    <td></td>

                    <td> <?php 

                     $tocl = (int)$sldata['quantity_in_kgltr'];

                     echo @$last_balance += $tocl;

                     ?></td>

                    <td></td>

                    <td></td>

                    <td></td>

                    <td></td>

                   </tr>

                   @endif

                   @if (@$sldata['document_type'] == 'TransferShpt')

                   <tr>

                    <td></td>

                    <td></td>

                    <td></td>

                    <td></td>

                    <td>{{ $sldata['batch_no'] }}</td>

                    <td>{{ $sldata['mfg_date'] }}</td>

                    <td>{{ $sldata['exp_date'] }}</td>

                    <td></td>

                    <td></td>

                    <td></td>

                    <td>{{ $last_balance }}</td>

                    <td></td>

                    <td></td>

                    <td></td>

                    <td>{{ $sldata['quantity_in_kgltr'] }}</td>

                    <td>

                    <?php 

                     $tocl = (int)$sldata['quantity_in_kgltr'];

                     echo @$last_balance -= $tocl;

                     ?>

                     </td>

                    <td>{{ $sldata['bill_no'] }}</td>

                    <td>{{  date('d-m-Y', strtotime($sldata['bill_date'])) }}</td>

                    <td></td>

                    <td></td>

                   </tr>

                   @endif

                   @if (@$sldata['document_type'] == 'Purchase Invoice')

                   <tr>

                    <td></td>

                    <td>{{  date('d-m-Y', strtotime($sldata['bill_date'])) }}</td>

                    <td>{{ $sldata['vendor_name'] }}</td>

                    <td></td>

                    <td>{{ @$sldata['batch_number'] }}</td>

                    <td>{{ $sldata['mfg_date'] }}</td>

                    <td>{{ $sldata['exp_date'] }}</td>

                    <td>{{ $sldata['vendor_invoice_no'] }}</td>

                    <td>{{ $sldata['vendor_invoice_date'] }}</td>

                    <td>{{ $sldata['quantity_in_kgltr'] }}</td>

                    <td>{{ $last_balance }}</td>

                    <td>{{ $sldata['quantity_in_kgltr'] }}</td>

                    <td></td>

                    <td></td>

                    <td></td>

                    <td>

                    <?php 

                     $tocl = (int)$sldata['quantity_in_kgltr'];

                     echo @$last_balance += $tocl;

                     ?></td>

                    <td></td>

                    <td></td>

                    <td></td>

                    <td></td>

                   </tr>

                   @endif

                   @if (@$sldata['document_type'] == 'PurchCreditMemo')

                   <tr>

                    <td></td>

                    <td></td>

                    <td></td>

                    <td></td>

                    <td>{{ $sldata['batch_number'] }}</td>

                    <td>{{ $sldata['mfg_date'] }}</td>

                    <td>{{ $sldata['exp_date'] }}</td>

                    <td></td>

                    <td></td>

                    <td></td>

                    <td>{{ $last_balance }}</td>

                    <td></td>

                    <td></td>

                    <td>{{ $sldata['quantity_in_kgltr'] }}</td>

                    <td></td>

                    <td>

                     <?php 

                     $tocl = (int)$sldata['quantity_in_kgltr'];

                     echo @$last_balance -= $tocl;

                     ?></td>

                    <td>{{ $sldata['vendor_invoice_no'] }}</td>

                    <td>{{  date('d-m-Y', strtotime($sldata['vendor_invoice_date'])) }}</td>

                    <td>{{ $sldata['vendor_name'] }}</td>

                    <td></td>

                   </tr>

                   @endif

                   @if (@$sldata['document_type'] == 'TransferRcpt')

                   <tr>

                    <td></td>

                    <td>{{  date('d-m-Y', strtotime($sldata['bill_date'])) }}</td>

                    <td></td>

                    <td>{{ $sldata['batch_no'] }}</td>

                    <td>{{ $sldata['mfg_date'] }}</td>

                    <td>{{ $sldata['exp_date'] }}</td>

                    <td></td>

                    <td>{{ $sldata['bill_no'] }}</td>

                    <td>{{ $sldata['bill_date'] }}</td>

                    <td>{{ $sldata['quantity_in_kgltr'] }}</td>

                    <td>{{ $last_balance }}</td>

                    <td>{{ $sldata['quantity_in_kgltr'] }}</td>

                    <td></td>

                    <td></td>

                    <td></td>

                    <td>

                    <?php 

                     $tocl = (int)$sldata['quantity_in_kgltr'];

                     echo @$last_balance += $tocl;

                     ?>                        

                    </td>

                    <td></td>

                    <td></td>

                    <td></td>

                    <td></td>

                   </tr>

                   @endif

                   @endforeach
</tbody></table></body></html>