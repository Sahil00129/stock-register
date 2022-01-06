<?php

// reference the Dompdf namespace

error_reporting(0);

require 'dompdf/autoload.inc.php';

//define("DOMPDF_ENABLE_HTML5PARSER", true);

use Dompdf\Dompdf;

$data = json_decode($_POST['data']);

function createPDF($pdf_content, $name) {

    $dompdf = new DOMPDF();

    $dompdf->load_html($pdf_content);

    $dompdf->render();

    $output = $dompdf->output();

    file_put_contents($name, $output);

}
$track = 0;
$array = json_decode(json_encode($data), true);
foreach ($array as $printPdf){

   // echo "<pre>";print_r($printPdf);die;

    $track = $track + 1;

    $pdf_content = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>Untitled Document</title></head><body style="font-size: 12px;"><table width="95%" border="0" cellspacing="0" cellpadding="0"><tr><td colspan="2" style="width:70%; border-top: 1px solid black; border-bottom: 1px solid black; border-left: 1px solid black; border-right: 1px solid black;"><h4 style="margin-top: 3px; padding: 3px;"><u>IQBAL HP GAS SERVICE</u></h4><p style="margin-bottom: 3px; margin-top: -15px; padding: 3px;">9 Square Building, Sohana Landran Road, Sector 77, Mohali <br>Phone No. +91 95920 27766 <br>GST No. 03AAIFI3598M1ZW</p></td><td style="width:30%; border-top: 1px solid black; border-bottom: 1px solid black; border-right: 1px solid black;"><h1 style=" font-style: italic; display: inline; margin-bottom: 2px; margin-left:10px;">PayHere</h1> <img src="code.jpg" width="80" height="70" /></td></tr><tr><td style="width:30%; border-left: 1px solid black; border-bottom: 1px solid black;"><p style="margin-top: 1px; margin-bottom: 2px; padding:3px;">Society: Park View Residency <br>Plot No.1, Sector 66 <br>Mohali</p></td><td style="width:35%; border-bottom: 1px solid black; "> <label for="username">Flat No.</label> <input style="border:hidden; outline:none;" type="text" value="'.$printPdf['Flat No'].'"></td><td style="width:30%; border-bottom: 1px solid black; border-right: 1px solid black; "><table><tr><td> <label for="username">Invoice No. :</label> <input style="border:hidden; outline:none; width: 45%;" type="text"></td></tr><tr><td> <label for="username">Invoice Date : <label> <input value="'.$printPdf['Inv Dt'].'" style="border:hidden; outline:none; width: 45%;" type="text"></tr></td></table></td></tr><tr><td style="width:35%; border-left: 1px solid black;"><table><tr><td> <label style="text-align:left; " for="username">Customer name:</label> <input style=" border:none; outline:none; width:50%;" type="text"></td></tr><tr><td> <label style="text-align:left;" for="username">Place:</label> <input style="border:none; outline:none; width:50%;" type="text"></td></tr><tr><td> <label style="text-align:left;" for="username">Cust. Email:</label> <input style="border:none; outline:none; width:50%;" type="text"></td></tr><tr><td> <label style="text-align:left;" for="username">Secondary No:</label> <input style="border:none; outline:none; width:50%;" type="text"></td></tr></table></td><td style="width:35%;"><table><tr><td> <label style="text-align:right;" for="username">Conversion Factor:</label> <input value="'.$printPdf['Conv Fac'].'" style="border:none; outline:none; width:25%;" type="text"></td></tr><tr><td> <label style="text-align:left;" for="username">Meter Reading:</label> <input value="'.$printPdf['Cur Rd'].'" style="border:none; outline:none; width:25%; " type="text"></td></tr><tr><td> <label style="text-align:left;" for="username">Units Consumed (Kg/SCM):</label> <input value="'.$printPdf['Con Uni'].'" style="border:none; outline:none; width:25%;" type="text"></td></tr><tr><td> <label style="text-align:left;" for="username">Rate Per Kg:</label> <input value="'.$printPdf['Gas Rt'].'" style="border:none; outline:none; width:25%;" type="text"></td></tr></table></td><td style="width:30%; border-right: 1px solid black; text-align: right;"><table><tr><td> <label style="text-align:left;" for="username">Usage Amount:</label> <input value="'.$printPdf['Amt'].'" style="border:none; outline:none; width:25%;" type="text"></td></tr><tr><td> <label style="text-align:left;" for="username">Maintenance Charges:</label> <input value="'.$printPdf['Main Char'].'" style="border:none; outline:none; width:25%;" type="text"></td></tr><tr><td> <label style="text-align:left;" for="username">Late Payment Charges:</label> <input value="0.0" style="border:none; outline:none; width:25%;" type="text"></td></tr><tr><td> <label style="text-align:left;" for="username">Cheque Bounce Charges:</label> <input value="0.0" style="border:none; outline:none; width:25%;" type="text"></td></tr></table></td></tr><tr><td colspan="2" style="border-left: 1px solid black; border-bottom: 1px solid black; text-align: left;"><table><tr><td> <label style="text-align:left;" for="username">Previous Reading:</label> <input value="'.$printPdf['Pr Rd'].'" style="border:none; outline:none; width:25%;" type="text"></td></tr><tr><td> <label style="text-align:left;" for="username">Previous Reading Date:</label> <input value="'.$printPdf['Pr Rd Dt'].'" style="border:none; outline:none; width:25%;" type="text"></td></tr><tr><td> <label style="text-align:left;" for="username">Current Reading:</label> <input value="'.$printPdf['Cur Rd'].'" style="border:none; outline:none; width:25%;" type="text"></td></tr><tr><td> <label style="text-align:left;" for="username">Current Reading Date</label> <input value="'.$printPdf['CRD'].'" style="border:none; outline:none; width:25%;" type="text"></td></tr></table></td><td style=" border-right: 1px solid black; border-bottom: 1px solid black; text-align: right;"><table><tr><td> <label style="text-align:left;" for="username">Last Payment:</label> <input value="0.0" style="border:none; outline:none; width:25%;" type="text"></td></tr><tr><td> <label style="text-align:left;" for="username">Total Invoice Amount:</label> <input value="'.$printPdf['bal'].'" style="border:none; outline:none; width:25%;" type="text"></td></tr><tr><td> <label style="text-align:left;" for="username">Credit Balance:</label> <input value="0.0" style="border:none; outline:none; width:25%;" type="text"></td></tr></table></td></tr><tr><td colspan="3" style="text-align:right; border-bottom: 1px solid black; border-right: 1px solid black; border-left: 1px solid black;"> <label style="text-align:right;" for="username">Net Payable Amount:</label> <input value="'.$printPdf['NPA'].'" style="border:none; outline:none; width:25%;" type="text"></td></tr><tr><td colspan="2" style="border-left:1px solid black; border-bottom: 1px solid black;"><table><ul><li>Late Payment Charges @ 2% per month</li><li>For Bill Payment call Mr. Sanjeev | Mob: +91 90229 78516</li><li>GST Inclusive of 5%</li></ul><p style="margin-left:25px"><u><b>NEFT / IMPS:</b></u> Bank Account No.: 152505500710 <br>Bank : ICICI Bank Limited | IFSC Code : ICIC0001525 <br>Cheques in favour of IQBAL HP GAS SERVICE <br></p></table></td><td style=" border-right: 1px solid black; border-bottom: 1px solid black;"><div class="box" style=" box-sizing: border-box; margin-left: 5px; border: 1px solid black; width: 250px; height: 90px;"><h3 style=" margin-top: 1px; margin-bottom: 45px; margin-left: 10px;">For IQBAL HP GAS SERVICE</h3><p style="text-align: end;">Authorized Signatory</p></div></td></tr></table></body></html>';

    //print_r($data);

    //die;

    $name = 'pdf/'.$printPdf['Flat No']. '.pdf';

    createPDF($pdf_content, $name);

}

if($track > 0){

    $zip = new ZipArchive();

    //$filename = 'archive/' . date("d-m-y") . '.zip';

    $t=time();

    $filename = 'archive/' . date("d-m-y") . '_'. rand(10,100) . '.zip';

    if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) {

      exit("cannot open <$filename>\n");

    }

    $dir = 'pdf/';

    // Create zip

    if (is_dir($dir)){

     if ($dh = opendir($dir)){

       while (($file = readdir($dh)) !== false){

         // If file

         if (is_file($dir.$file)) {

           if($file != '' && $file != '.' && $file != '..'){

             $zip->addFile($dir.$file);

           }

         }

       }

       closedir($dh);

      }

    }

    $zip->close();

    $folder_path = "pdf/";

    // List of name of files inside
    // specified folder

    $files = glob($folder_path.'/*'); 

      
    // Deleting all the files in the list

    foreach($files as $file) {


        if(is_file($file)) 

            // Delete the given file

            unlink($file); 

    }

    $data = array('message' => 'success', 'data' =>$filename);

    echo json_encode($data);

}

else{

    $data = array('message' => 'error', 'data' => 'No data selected.');

    echo json_encode($data);

}

?>