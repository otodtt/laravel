<?php

namespace odbh\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class Sanitary
{
    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($this->auth->user()->fsk != 1){
            return back()->with('message', 'Нямате право за досъп до тази страница! Обърнете се към Администратора ако е необходимо!');
        }
        return $next($request);
    }
}
