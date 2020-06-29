<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class KiemTraQuyen
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $quyen)
    {

        $chucvu = Auth::guard('admin')->user()->chucvus()->get();
        $hopLe = false;  
        foreach($chucvu as $cv){
            
            if($cv->tenChucVu == 'ALL'){
                $hopLe=true;
                break;
            }
            foreach($cv->quyens()->get() as $q)
                if($q->maQuyen == $quyen){
                    $hopLe = true;
                    break;
                }
            
            if($hopLe)break;
        }
        if($hopLe)
           return $next($request);
        else
           return abort(401);    
    }
}
