<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = "user";
    public $timestamps = false;

    public static function getUserInfo($openId)
    {
        $userInfo = self::select(["usr_phone", "usr_id"])->where("usr_open_id", $openId)->get()->toArray();
        return $userInfo;
    }
}
