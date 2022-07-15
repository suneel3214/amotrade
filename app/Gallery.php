<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{

    protected $table = 'gallery';
    protected $fillable = [
        'business_id','title','image','description','is_active'
    ];

  
}
