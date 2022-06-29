<?php

namespace Yousefpackage\Visits\Http\Middleware;

use Closure;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
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
        $page = explode('/',$request->server('REQUEST_URI'));
        RateLimiter::for('visit', function (Request $request) {
            return Limit::perMinute(10)->response(function (){
                    return abort("403",'TOO MANY REQUESTS');
            });
        });

        $api = Http::get('http://ipwho.is/'. $request->ip());
        $data = json_decode($api, true);
        $visitTable =  new Visit;
        $visitTable->ip = $request->ip();
        if(isset($data['city'])){
            $visitTable->city = $data['city'];
        }
        $visitTable->page = $page[1];
        $visitTable->os = $this->getOS();
        $visitTable->save();
        return $next($request);
    }



    function getOS() { 

        $user_agent = $_SERVER['HTTP_USER_AGENT'];
    
        $os_platform =   "Bilinmeyen İşletim Sistemi";
        $os_array =   array(
            '/windows nt 10/i'      =>  'Windows 10',
            '/windows nt 6.3/i'     =>  'Windows 8.1',
            '/windows nt 6.2/i'     =>  'Windows 8',
            '/windows nt 6.1/i'     =>  'Windows 7',
            '/windows nt 6.0/i'     =>  'Windows Vista',
            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
            '/windows nt 5.1/i'     =>  'Windows XP',
            '/windows xp/i'         =>  'Windows XP',
            '/windows nt 5.0/i'     =>  'Windows 2000',
            '/windows me/i'         =>  'Windows ME',
            '/win98/i'              =>  'Windows 98',
            '/win95/i'              =>  'Windows 95',
            '/win16/i'              =>  'Windows 3.11',
            '/macintosh|mac os x/i' =>  'Mac OS X',
            '/mac_powerpc/i'        =>  'Mac OS 9',
            '/linux/i'              =>  'Linux',
            '/ubuntu/i'             =>  'Ubuntu',
            '/iphone/i'             =>  'iPhone',
            '/ipod/i'               =>  'iPod',
            '/ipad/i'               =>  'iPad',
            '/android/i'            =>  'Android',
            '/blackberry/i'         =>  'BlackBerry',
            '/webos/i'              =>  'Mobile'
        );
    
        foreach ( $os_array as $regex => $value ) { 
            if ( preg_match($regex, $user_agent ) ) {
                $os_platform = $value;
            }
        }   
        return $os_platform;
    }
}
