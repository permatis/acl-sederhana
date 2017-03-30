<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Task;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;

class AjaxController extends Controller
{
	private $task;
	private $datatables;
    private $user;
    private $role;
    private $permission;
    private $routes;

	public function __construct(
        Task $task,
        Datatables $datatables,
        User $user,
        Role $role,
        Permission $permission,
        Request $request)
	{
		$this->task = $task;
		$this->datatables = $datatables;
        $this->user = $user;
        $this->role = $role;
        $this->permission = $permission;
        $this->routes = $this->getActions($request->route());
	}


    public function tasks()
    {
        $tasks = $this->task->select(['id', 'name', 'description', 'updated_at']);
        return $this->datatables($tasks, 'task');
    }

    public function users()
    {
        $users = $this->user->select(['id', 'name', 'email', 'updated_at']);
        return $this->datatables($users, 'user');
    }

    public function roles()
    {
        $roles = $this->role->select(['id', 'name', 'description', 'updated_at']);
        return $this->datatables($roles, 'role');
    }

    public function permissions()
    {
        $permissions = $this->permission->select(['id', 'name', 'display_name', 'updated_at']);
        return $this->datatables($permissions, 'permission');
    }

    private function datatables($models, $name)
    {
    	return $this->datatables->of($models)
    		->addColumn('action', function ($model) {
			    // if(!auth()->guest() && (auth()->user()->can('update-'.$name) || auth()->user()->can('destroy-'.$name))) {

	    			$action = '<div class="btn-group">
	    						<button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
	    							Choose Action <span class="caret"></span>
	    						</button>';

	    				$action .= '<ul class="dropdown-menu" role="menu">
		    						<li><a data-value="'.$model->id.'" class="btn-edit"><i class="fa fa-pencil-square-o"></i> Edit</a></li>
		    						<li><a data-value="'.$model->id.'" class="btn-delete"><i class="fa fa-trash"></i> Delete</a></li>
	    						</ul>';
	    			$action .= '</div>';
	    			return $action;
				// }

    		})
    		->removeColumn('id')
            ->editColumn('updated_at', function ($model) {
                return $model->updated_at ? $model->updated_at->diffForHumans() : '';
            })
    		->make(true);
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
}
