<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ShopCategory
 *
 * @mixin \Eloquent
 * @property int $id
 * @property string|null $name 名称
 * @property int|null $status 状态:1显示 0隐藏
 * @property string|null $imh 图片
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShopCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShopCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShopCategory whereImh($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShopCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShopCategory whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShopCategory whereUpdatedAt($value)
 */
class ShopCategory extends Model
{
    //
    public $fillable=["name","status","imh"];

}
