<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Shopp
 *
 * @property int $id
 * @property int|null $shop_category_id 店铺分类ID
 * @property string|null $shop_name 名称
 * @property string|null $shop_img 店铺图片
 * @property float|null $shop_rating 评分
 * @property int|null $brand 是否是品牌
 * @property int|null $on_time 是否准时送达
 * @property int|null $fengniao 是否蜂鸟配送
 * @property int|null $bao 是否保标记
 * @property int|null $piao 是否票标记
 * @property int|null $zhun 是否准标记
 * @property float|null $start_send 起送金额
 * @property float|null $send_cost 配送费
 * @property string|null $notice 店公告
 * @property string|null $discount 优惠信息
 * @property int|null $status 状态:1正常,0待审核,-1禁用
 * @property int|null $user_id user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ShopCategory|null $ShopCategory
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shopp whereBao($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shopp whereBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shopp whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shopp whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shopp whereFengniao($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shopp whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shopp whereNotice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shopp whereOnTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shopp wherePiao($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shopp whereSendCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shopp whereShopCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shopp whereShopImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shopp whereShopName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shopp whereShopRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shopp whereStartSend($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shopp whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shopp whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shopp whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Shopp whereZhun($value)
 * @mixin \Eloquent
 */
class Shopp extends Model
{
    //
    //和分类发生关系
    public function cate(){
        return $this->belongsTo(ShopCategory::class,"shop_category_id");
    }
public $fillable=["shop_category_id	","shop_name","shop_img","shop_rating","brand","on_time","fengniao",
    "bao","piao","zhun","start_send","send_cost","notice","discount","status","user_id"];

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }

}
