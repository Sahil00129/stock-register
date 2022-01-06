<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sites extends Model
{
    protected $table = 'warehouse_sites';
    protected $fillable = [
        'site_id','site_name'
    ];
}
