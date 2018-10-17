<?php

namespace App\Http\Controllers\SmallRoutine\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use WeiXin;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function getOpenId(Request $request)
    {
//        openssl_public_decrypt($base,$data,Storage::get("ssl/public_key.pem"));
        $code = $request->input("code");
        $res = WeiXin::getOpenId($code);

        if (isset($res['openid'])) {
            $userInfo = User::getUserInfo($res["openid"]);
            $response['code'] = empty($userInfo) ? false : true;
            openssl_private_encrypt($res['openid'],$token, Storage::get("ssl/private_key.pem"));
            Redis::set($token, json_encode($res));
            $a = Redis::get($token);
            echo $a;
        }

    }
}
