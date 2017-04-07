<?php

namespace App\Http\Middleware;

use Closure;

class RegionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // echo "<pre>"; print_r($request); die;
        // echo "I am from RegionMiddleware";
        // echo "<pre>"; print_r($next); die;
        // perform some IP logic on $request
        // and redirect to appropriate
        // page based on results
 
        // everything went well
        // this will resume normal flow
        return $next($request);
    }
}
