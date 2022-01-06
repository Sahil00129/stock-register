<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemMaster extends Model
{
    protected $table = 'item_master';
    protected $fillable = [
        'item_name','item_number','pack','group','poi','regis_no'
    ];
}
