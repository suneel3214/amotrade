<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'business_id','doc_type','doc_id','image','verified_status'
    ];
}
