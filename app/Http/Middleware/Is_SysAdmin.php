<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Is_SysAdmin
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */

    // Override handle method
    public function handle($request, Closure $next, ...$guards)
    {
        $user = Auth::user();
        if (!in_array("sys_admin", $user["roles"])) {
            return response()->json(['error' => 'Unauthorized']);
        }
        return $next($request);
    }
}
