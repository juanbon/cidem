<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class AdminMiddleware {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        $status = User::where('email', $request->email)->pluck('status')->first();
        if ($status != User::STATUS_ACCEPTED) {
            return redirect(backpack_url('login'));
        }
        return $next($request);
    }
}
