<?php

namespace App\Http\Middleware;

use App\Services\Auth\AuthService;
use Closure;

class CheckAuth
{
    public function __construct(
        private AuthService $authService
    ) {
    }

    /**
     * 送出Token至CUA並取回權限清單
     *
     * @author Tim
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function handle($request, Closure $next, $uri = null)
    {
        if ($this->authService->checkPermission($request, $uri)) {
            return $next($request);
        }
    }
}
