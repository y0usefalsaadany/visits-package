<?php

namespace Yousefpackage\Visits\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Yousefpackage\Visits\Models\Visit;
use Illuminate\Support\Facades\Http;
class VistsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $api = Http::get('http://ipwho.is/'. $request->ip());
        $data = json_decode($api, true);
        $visitTable =  new Visit;
        $visitTable->ip = $request->ip();
        if(isset($data['city'])){
            $visitTable->city = $data['city'];
        }
        $visitTable->save();
        return $next($request);
    }
}
