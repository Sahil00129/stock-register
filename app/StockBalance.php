<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockBalance extends Model
{
    protected $table = 'stock_opening';
    protected $fillable = [
        'item_name','site_id','opening_balance','fy'
    ];
}
