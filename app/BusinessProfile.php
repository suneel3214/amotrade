<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class BusinessProfile extends Model
{
    protected  $fillable = [
        'business_sub_type','contact_person',
        'establishment','nature_of_business','employees_number','turnover',
        'bio','email','website'
    ];

    public function businessPro(){
        return $this->belongsTo(User::class , 'user_id','id');
    }
    
}
