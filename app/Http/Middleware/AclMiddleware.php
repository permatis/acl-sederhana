<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Permission;

class AclMiddleware
{

    /**
     * Mendefinisikan nilai restfull untuk memfilter permission
     * @var array
     */
    private $restfull = [
        'index'     => ['index', 'manage', 'view', 'show'],
        'create'    => ['create', 'store'],
        'store'     => ['create', 'store'],
        'show'      => ['show', 'index', 'view', 'manage', 'destroy'],
        'edit'      => ['edit', 'update'],
        'update'    => ['update', 'edit'],
        'destroy'   => ['destroy', 'show', 'delete']
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

        $routes = ($this->getActions($request->route()) ?
            $this->getActions($request->route()) : $request->route()->getUri());

        if($routes)  {
            if(strpos($routes, '-')) {
                $route = explode('-', $routes);
                $getPermission = (count($route) > 1) ?
                    $this->arrayFilter($this->restfull[$route[0]], $route[1]) : $route[0];
            } else {
                $getPermission = [ $routes ];
            }

            if (auth()->user()->can(implode('', $getPermission)))
                return $next($request);
        }

        return  response([
            'error' => [
                'code' => 'INSUFFICIENT_ROLE',
                'description' => 'You are not authorized to access this resource.'
            ]
        ], 401);
    }

    /**
     * Mendapatkan nama action pada route
     * @param  string $route    nama route
     * @return string
     */
    private function getActions($route)
    {
        $actions = $route->getAction();
        return isset($actions['as']) ? $this->getNameByAs($actions['as']) : null;
    }

    /**
     * Mendapatkan nama route dengan alias
     * @param  string $actions   nama route
     * @return string
     */
    private function getNameByAs($actions)
    {
        $as = explode('.', $actions);
        return (count($as) > 1) ? $as[1].'-'.rtrim($as[0], 's') : rtrim($as[0], 's');
    }

    /**
     * Untuk memfilter nilai array dengan key untuk menampilkan nilai yang sesuai
     * @param  array $array     nilai array restfull yang telah didefiniskan
     * @param  string $key      nama route
     * @return array
     */
    private function arrayFilter($array, $key)
    {
        return array_filter($this->getAllPermission($key), function ($r) use ($array) {
            foreach ($array as $value ) {
                if (strpos($r, $value) !== false)
                    return $r;
            }
        });
    }

    /**
     * Mencari data  permission berdasarkan route
     * @param  string $route    nama route
     * @return $permission
     */
    private function getAllPermission($route)
    {
        $permissions = Permission::where('name', $route)->orWhere('name', 'like', '%'.$route.'%')->get();
        // dd($route);
        foreach ($permissions as $p) {
            $permission[] = $p->name;
        }

        return $permission;
    }
}
