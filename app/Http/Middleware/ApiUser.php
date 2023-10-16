<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiUser
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
        $UserRoles = DB::table('user_mgts')->where('user_id', '=', Auth::user()->id)->lists('admin');
    // vérifier si cet utilisateur  a le role d'admin
    $isAdmin = false;
    foreach($UserRoles as $role)
    {
        if($role == 'admin')
        {
            $isAdmin = true;
        }
    }

    // snippet ci-dessous selon doc de Laravel
    if( ! $isAdmin )
    {
        if ($request->ajax()) {
            return response('Unauthorized.', 401);
        } else {
            return redirect()->back(); //todo h peut-etre une fenetre modale pour dire acces refusé ici...
        }
    }

    return $next($request);
    }
}
