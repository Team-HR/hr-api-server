<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use Auth;

class DatabaseLogger
{
    public function handle($request, Closure $next, ...$guards)
    {
        DB::connection()->enableQueryLog();
        return $next($request);
    }

    public function terminate($request, $response)
    {
        $queries = DB::getQueryLog();
        $user = Auth::check() ? Auth::user() : null;
        $id = $user["id"];
        $username = $user["username"]; // Auth::check() ? Auth::username() : null;
        collect($queries)->each(function ($query) use ($id, $username) {
            DB::table("querylogtable")->insert(["user_id" => $id, "username" => $username, "query" => json_encode($query)]);
        });
    }
}
