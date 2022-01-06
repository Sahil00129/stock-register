<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockTransfer extends Model
{
    protected $table = 'stock_transfer';
    protected $fillable = [
        'item_name','bill_no','bill_date','quantity_in_kgltr','batch_no','mfg_date','exp_date', 'trf_frm_site_id','trf_to_site_id','site_id','document_type'
    ];
}
