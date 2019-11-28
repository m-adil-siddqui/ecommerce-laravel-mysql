<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Role;
use App\Profile;
class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role(){
       return $this->belongsTo('App\Role');
    }
    
    public function profile(){
         return $this->hasOne('App\Profile');
    }
    public function getRouteKeyName(){
        return 'slug';
    }
    public function getCountry(){
        return $this->profile->country->name;
    }
    public function getState(){
        return $this->profile->state->name;
    }
    public function getCity(){
        return $this->profile->city->name;
    }
   
    public function roles(){
        return $this->belongsTo(Role::class)->onlyTrashed();
    }
    public function profiles(){
        return $this->hasOne(Profile::class)->onlyTrashed();
    }
}











