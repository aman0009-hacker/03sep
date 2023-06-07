<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Webpatser\Uuid\Uuid;
use App\Models\Comments;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Crypt;
use App\Models\Attachment;
// use Illuminate\Database\Eloquent\Concerns\HasUuids;
// use Illuminate\Contracts\Auth\MustVerifyEmail;



class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'last_name',
        'password',
        'email',
       'contact_number',
       'state'
        //'otp',
        //'otp_generated_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public function documents()
    // {
    //     return $this->hasOne(Document::class);
    // }

    public function attachment()
    {
        return $this->hasMany(Attachment::class);
    }

    public function comments()
    {
        return $this->hasMany(Comments::class);
    }

    protected $encryptable = [
     
        'name',
        'last_name',
        //'email',
        'contact_number'      
        
        
    ];

    
public function setNameAttribute($value)
{
    if (in_array('name', $this->encryptable)) {
        $this->attributes['name'] = ($value !== null && trim($value) !== '') ? Crypt::encryptString($value) : null;
    } else {
        $this->attributes['name'] = $value;
    }
}

public function getNameAttribute($value)
{
    if (in_array('name', $this->encryptable)) {
        return ($value !== null && trim($value) !== '') ? Crypt::decryptString($value) : null;
    }
    return $value;
}

public function setLastNameAttribute($value)
{
    if (in_array('last_name', $this->encryptable)) {
        $this->attributes['last_name'] = ($value !== null && trim($value) !== '') ? Crypt::encryptString($value) : null;
    } else {
        $this->attributes['last_name'] = $value;
    }
}

public function getLastNameAttribute($value)
{
    if (in_array('last_name', $this->encryptable)) {
        return ($value !== null && trim($value) !== '') ? Crypt::decryptString($value) : null;
    }
    return $value;
}

//     public function setEmailAttribute($value)
// {

//     if (in_array('email', $this->encryptable)) {
//         $this->attributes['email'] = ($value !== null && trim($value) !== '') ? Crypt::encryptString($value) : null;
//     } else {
//         $this->attributes['email'] = $value;
//     }
//     //$this->attributes['email'] = ($value !== null && trim($value) !== '') ? Crypt::encryptString($value) : null;
// }

// public function getEmailAttribute($value)
// {
//     if (in_array('email', $this->encryptable)) {
//         return ($value !== null && trim($value) !== '') ? Crypt::decryptString($value) : null;
//     }
//     return $value;
//     //return ($value !== null && trim($value) !== '') ? Crypt::decryptString($value) : null;
// }

public function setContactNumberAttribute($value)
{
    if (in_array('contact_number', $this->encryptable)) {
        $this->attributes['contact_number'] = ($value !== null && trim($value) !== '') ? Crypt::encryptString($value) : null;
    } else {
        $this->attributes['contact_number'] = $value;
    }
}

public function getContactNumberAttribute($value)
{
    if (in_array('contact_number', $this->encryptable)) {
        return ($value !== null && trim($value) !== '') ? Crypt::decryptString($value) : null;
    }
    return $value;
}



    protected static function boot(){
        parent::boot();
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Uuid::generate()->string;
        });
   
    }

    
}
