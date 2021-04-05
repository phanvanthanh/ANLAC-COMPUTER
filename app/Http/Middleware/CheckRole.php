<?php
/*
    Chú ý: Check role này phải khai báo trong kernel.php
    protected $routeMiddleware = [
        'check-role' => \App\Http\Middleware\CheckRole::class,
    ];
*/

namespace App\Http\Middleware;
 
use Closure;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use DB;
use App\AdminResource;

class CheckRole
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
        $userId = Auth::id();
        $currentAction=Route::getCurrentRoute()->getActionName();
        $currentMethods=Route::getCurrentRoute()->methods()[0];

        $checkPermissionResource = AdminResource::where('admin_resource.action', '=', $currentAction)
        ->where('admin_resource.method','=',$currentMethods)
        ->where('users.id','=',$userId)
        ->join('admin_rule', 'admin_resource.id', '=', 'admin_rule.resource_id')
        ->join('users', 'admin_rule.role_id', '=', 'users.role_id')
        ->get()->toArray();
        if(count($checkPermissionResource)<=0){
            if(!Auth::check()){
                die(var_dump(Auth::check()));
                return redirect()->intended('/');    
            }         
            echo '<p>Chức năng không khả dụng. Bạn sẽ <b>quay lại trang chủ</b>  sau <b><span id="counter">5</span> giây(s).</p></b>
            <script type="text/javascript">
            function countdown() {
                var i = document.getElementById("counter");
                if (parseInt(i.innerHTML)<=0) {
                    location.href = "/";
                }
            if (parseInt(i.innerHTML)!=0) {
                i.innerHTML = parseInt(i.innerHTML)-1;
            }
            }
            setInterval(function(){ countdown(); },1000);
            </script>';
            exit();
        }
        return $next($request);
    }
    
}

