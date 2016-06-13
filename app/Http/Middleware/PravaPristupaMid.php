<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Session;
use App\Funkcije;
class PravaPristupaMid{
    protected $auth;

    public function __construct(Guard $auth){
        $this->auth = $auth;
    }

    public function handle($request, Closure $next, $pravo, $strict){
        if ($this->auth->guest())
            if ($request->ajax())
                return response('Zabranjen pristup.', 401);
            else
                return redirect()->guest('/login');
        else{
            if($this->auth->user()->confirmed!=1) return redirect('/nepotvrdjen');
            if($strict ?
                $this->auth->user()->prava_pristupa_id==$pravo :
                $this->auth->user()->prava_pristupa_id>=$pravo )
                return $next($request);
            else
                return redirect('/login');
        }
    }
}




