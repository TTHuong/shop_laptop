<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = "post";
 	protected $primaryKey = 'id_post';
    protected $fillable = [
          'sp_vi',  'sp_en', 'product_slug'
    ];
    // public function product(){
    // 	return $this->hasMany('App\Product','id_post', 'id_post');
    // }
}
