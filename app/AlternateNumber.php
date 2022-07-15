<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlternateNumber extends Model
{
    protected $table = 'mobile_numbers';
    protected $fillable = [
        'business_id','number','type','is_visible'    ];
}
