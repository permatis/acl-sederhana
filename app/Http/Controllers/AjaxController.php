<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Yajra\Datatables\Datatables;
use App\Models\Task;

class AjaxController extends Controller
{
	private $task;
	private $datatables;

	public function __construct(Task $task, Datatables $datatables)
	{
		$this->task = $task;
		$this->datatables = $datatables;
	}


    public function tasks()
    {
        $tasks = $this->task->select(['id', 'name', 'description', 'updated_at']);

        return $this->datatables($tasks);
    }

    private function datatables($models)
    {
    	return $this->datatables->of($models)
    		->addColumn('action', function ($model) {
    			$action = '<div class="btn-group">
    						<button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown"> 
    							Choose Action <span class="caret"></span>
    						</button>';

    			if(!auth()->guest())
    			{
    				$action .= '<ul class="dropdown-menu" role="menu">
	    						<li><a data-value="'.$model->id.'" class="btn-edit"><i class="fa fa-pencil-square-o"></i> Edit</a></li>
	    						<li><a data-value="'.$model->id.'" class="btn-delete"><i class="fa fa-trash"></i> Delete</a></li>
    						</ul>';
    			}
    			
    			$action .= '</div>';
    			return $action;
    		})
    		->removeColumn('id')
            ->editColumn('updated_at', function ($model) {
                return $model->updated_at ? $model->updated_at->diffForHumans() : '';
            })
    		->make(true);
    }
}
