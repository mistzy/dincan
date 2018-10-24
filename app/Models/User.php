<?php

namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\User
 *
 * @property int $id
 * @property string $name 名称
 * @property string $email 邮箱
 * @property string $password 密码
 * @property int $shop_id
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\\App\Models\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\\App\Models\User whereShopId($value)
 * @method static \Illuminate\Database\Eloquent\\App\Models\User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable;


    protected $fillable = [
        'name', 'email', 'password','shop_id'
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];
    public function shopp(){
        return $this->hasOne(Shopp::class,"user_id");
    }
}
