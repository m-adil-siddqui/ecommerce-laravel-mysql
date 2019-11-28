<?php

namespace App;
use App\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    //
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $guarded = [];
    protected $fillable = ['id','title', 'description', 'slug'];

    public function products(){
    	return $this->belongsToMany('App\Product');
    	//ManyToMany == belongsToMany
    }    

    public function childrens(){
    	return $this->belongsToMany(Category::class, 'category_parent', 'category_id', 'parent_id');
    }

    public function getRouteKeyName(){
        return 'id';
    }
}
