<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shopp extends Model
{
    //
    //和分类发生关系
    public function ShopCategory(){
        return $this->belongsTo(ShopCategory::class,"shop_category_id");
    }
public $fillable=["shop_category_id	","shop_name","shop_img","shop_rating","brand","on_time","fengniao",
    "bao","piao","zhun","start_send","send_cost","notice","discount","status"];

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

}
