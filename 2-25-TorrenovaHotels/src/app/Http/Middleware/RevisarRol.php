<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use function PHPUnit\Framework\isNull;

class RevisarRol
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(empty($request->user())){
            return redirect("/");
        }else{
            if ($request->user()->rol==="administrador") {
                return $next($request);
            }
            elseif ($request->user()->rol === "recepcionista") {
              return redirect("/rooms/roomManagment");
            }else{
              return redirect(to: "/");
            }
        }
    }
}
