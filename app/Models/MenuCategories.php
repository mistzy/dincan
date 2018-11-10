<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\MenuCategories
 *
 * @property int $id
 * @property string|null $name 分类名
 * @property string|null $type_accumulation 菜品编号
 * @property int|null $shop_id 所属商家id
 * @property string|null $description 描述
 * @property string|null $is_selected 是否是默认分类
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Menu $cate
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Menu[] $goods
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MenuCategories whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MenuCategories whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MenuCategories whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MenuCategories whereIsSelected($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MenuCategories whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MenuCategories whereShopId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MenuCategories whereTypeAccumulation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MenuCategories whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
