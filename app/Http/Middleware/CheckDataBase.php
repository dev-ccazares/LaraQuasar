<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class CheckDataBase
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if(Config::get('app.env') === 'production'){
            Config::set('database.connections.sugar.host',env('DB_SUGAR_HOST'));
            Config::set('database.connections.sugar.port',env('DB_SUGAR_PORT'));
            Config::set('database.connections.sugar.database',env('DB_SUGAR_DATABASE'));
            Config::set('database.connections.sugar.username',env('DB_SUGAR_USERNAME'));
            Config::set('database.connections.sugar.password',env('DB_SUGAR_PASSWORD'));
            DB::connection('sugar'); //Asigno la nueva conexión al sistema.
        }

        return $next($request);
        return $next($request);
    }
}
