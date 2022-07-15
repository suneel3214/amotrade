<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Spatie\MediaLibrary\File;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\addMediaCollection;
use Spatie\MediaLibrary\HasMedia\addMediaConversion;
use Spatie\MediaLibrary\Models\Media;
use Spatie\Image\Manipulations;
use App\BusinessProfile;

class User extends Authenticatable implements HasMedia,JWTSubject
{
    use Notifiable, HasMediaTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mobile_number', 'code','business_type',
        'business_name','location','business_id',
  
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','verify_token'
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function setGenderAttribute($value)
    {
        return $this->attributes['gender'] = strtoupper($value);
    }
    public function getNameAttribute($value)
    {
        return ucwords($value);
    }

    public function getAuthPassword()
{
    return $this->code;
}


    // public function setPasswordAttribute($value)
    // {
    //     return $this->attributes['password'] = bcrypt($value);
    // }


    public function getArrayableAttributes()
    {
        foreach ($this->attributes as $key => $value) {
           
            if (is_null($value)) {
                $this->attributes[$key] = '';
            }
        }

        return $this->getArrayableItems($this->attributes);
    }

 public function getAvatarThumbAttribute($value)
 {

            if($value == "" || is_null($value)){
                return  url('assets/images/users/default-user.png');
            }
          return $value; 
 }

 public function getAvatarMediumAttribute($value)
 {

            if($value == "" || is_null($value)){
                return  url('assets/images/users/default-user-medium.png');
            }
         return $value;   
 }
 
 public function getAvatarBigAttribute($value)
 {

            if($value == "" || is_null($value)){
                return  url('assets/images/users/default-user-medium.png');
            }
         return $value;   
 }

    public function registerMediaCollections()
    {
        
        $this
            ->addMediaCollection('gallary')
           // ->acceptsFile(function (File $file) {
             //   return $file->mimeType === 'image/jpeg';
           // })
            ->registerMediaConversions(function (Media $media) {

                $this
                    ->addMediaConversion('big')
                    ->fit(Manipulations::FIT_STRETCH, 960, 1280)
                    ->nonQueued();
                $this
                    ->addMediaConversion('medium')
                    ->fit(Manipulations::FIT_STRETCH, 480, 640)
                    ->nonQueued();
                $this
                    ->addMediaConversion('thumb')
                    ->fit(Manipulations::FIT_STRETCH, 240, 320)
                    ->nonQueued();

            });


            $this->addMediaCollection('identity')
               ->registerMediaConversions(function (Media $media) {

                $this
                    ->addMediaConversion('big')
                    ->width(960)
                    ->height(1280)
                    ->nonQueued();
                     
            });

    }
    
public function shortlist()
    {
        return $this->hasMany('App\Shortlist');
    }


    public function preferences()
    {
        return $this->hasMany('App\Preference');
    }  


}
