<?php

namespace App\Http\Middleware;

use Closure;

class AclMiddleware
{
    private $restfull = [
        'index'     => ['index', 'manage', 'view', 'show'],
        'create'    => ['create', 'store'],
        'store'     => ['create', 'store'],
        'show'      => ['show', 'index', 'view', 'manage', 'delete'],
        'edit'      => ['edit', 'update'],
        'update'    => ['update', 'edit'],
        'delete'    => ['delete', 'show']
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
        if (auth()->guest()) 
           return redirect()->guest('login');
           
        $routes = $this->getActions($request->route());

        if($routes)  {
            $route = explode('-', $routes);
            $getPermission = (count($route) > 1) ? $this->arrayFilter($this->restfull[$route[0]], $route[1]) : $route[0];
            
            if (auth()->user()->can($getPermission))
                return $next($request);
        }

        return  response([
            'error' => [
                'code' => 'INSUFFICIENT_ROLE',
                'description' => 'You are not authorized to access this resource.'
            ]
        ], 401);
    }

    private function getActions($route)
    {
        $actions = $route->getAction();
        return isset($actions['as']) ? $this->getNameByAs($actions['as']) : null;
    }

    private function getNameByAs($actions)
    {
        $as = explode('.', $actions);
        return (count($as) > 1) ? $as[1].'-'.rtrim($as[0], 's') : rtrim($as[0], 's');
    }

    private function arrayFilter($array, $key)
    {
        return array_filter($this->getAllPermission($key), function ($r) use ($array) {
            foreach ($array as $value ) {
                if (strpos($r, $value) !== false) 
                    return $r;
            }
        });
    }    

    private function getAllPermission($route)
    {
        $permissions = Permission::where('name', $route)->orWhere('name', 'like', '%'.$route.'%')->get();
        foreach ($permissions as $p) {
            $permission[] = $p->name;
        }

        return $permission;
    }
}
