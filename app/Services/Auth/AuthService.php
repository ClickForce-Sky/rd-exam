<?php

namespace App\Services\Auth;

use App\Repositories\Auth\AuthRepository;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class AuthService
{
    // 因為未來會寫死 加上是核心部分，因此不導入資料夾外部的 Repository
    public function __construct() {
    }

    public function checkPermission($request, $uri)
    {
        $bearerToken = $request->bearerToken();
        $currentRoute = Route::getCurrentRoute();
        $auths = [];
        
        // 解析網址（群組, 行為）
        if($uri == 'none'){
            $group = 'none';
        }
        else{
            list($group, $action) = explode('|', $uri ?? $currentRoute->uri);
        }

        if($bearerToken = '1234567890'){
            $auths = ['admin'=>['test1' => 'test1', 
                                'test2' => 'test2',
                                'test3' => 'test3',]];

        }

        // 考試強制登入 使用者ID 1
        $user_id = 1;

        // 判斷行為是否被允許
        if ($group == 'none' || $this->isAvailable($auths, $group, $action)) {
            // 登入處理
            return $this->loginProcess($user_id, ['access' => $auths,
                                                  'token'  => $bearerToken]);

        } else {
            abort(response()->json(__('api_message.user_no_permission'), 403));
        }
    }

    // 驗證是否擁有該權限
    private function isAvailable($auths, $group, $action)
    {

        $result = array_key_exists($group, $auths) ? array_key_exists($action, $auths[$group]) : false;
        return $result;
    }

    // 登入處理
    private function loginProcess($user_id, $params)
    {
        // 登入使用者
        Auth::loginUsingId($user_id);

        // 登入成功
        if (Auth::check()) {
            // 新增部分快速存取數據
            if(!empty($params)){
                foreach($params as $key => $vlaue)
                    auth()->user()->{$key} = $vlaue;
            }

            return true;
    
        } else {
            return abort(response()->error(__('api_message.user_no_permission'), 403));
        }

    }
}
