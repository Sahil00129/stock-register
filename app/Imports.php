<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imports extends Model
{
    protected $table = 'imports';
    protected $fillable = [
        'dor','manufectrure','batch_no','dom','doe','invoice_no','invoice_date','qty','prv_blnc','received','sold_or_distributed','returns','stock_transfer','bal_stock','bill_no','bill_date','whom_to_sold','remarks'
    ];
}
