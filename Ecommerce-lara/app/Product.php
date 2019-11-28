<?php

namespace App;
use App\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Product extends Model
{
    //
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $guarded = [];

    public function categories(){
    	return $this->belongsToMany('App\Category');
    	//ManyToMany == belongsToMany
    }
    
    public function getRouteKeyName(){
        return 'id';
    }

}
