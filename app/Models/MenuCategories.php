<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuCategories extends Model
{

    protected $fillable=["name","type_accumulation","description","is_selected","shop_id"];


    public function goods(){
        return $this->hasMany(Menu::class,"category_id");
    }
    //所属分类
    public function cate(){
        return $this->hasOne(Menu::class,"category_id");
    }
}
