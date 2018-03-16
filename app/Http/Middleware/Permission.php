
<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Session;
use Closure;

class Permission {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $permits = $this->getPermission($request);

        $admin = \App\Http\Middleware\Authenticate::getAuthUser();

        // 只要有一个有权限，就可以进入这个请求
        foreach ($permits as $permit) {
            if ($permit == '*') {
                return $next($request);
            }
            if ($admin->hasPermission($permit)) {
                return $next($request);
            }
        }

        echo "没有权限，请联系管理员";exit;
    }

    // 获取当前路由需要的权限
    public  function getPermission($request)
    {
        $actions = $request->route()->getAction();
        if (empty($actions['permissions'])) {
            echo "路由没有设置权限";exit;
        }
        return $actions['permissions'];
    }
}