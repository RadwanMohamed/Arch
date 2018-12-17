<?php

namespace App\Http\Middleware;

use App\Building;
use Closure;

class ProductStatus
{
    /**
     * checks the status of the building if avialable or not
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->route('building')->status ==0)
            return redirect()->back()->with('flash','this product is not activated' );
        return $next($request);
    }
}
