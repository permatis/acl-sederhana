<?php

if(!function_exists('breadcrumb'))
{
	/**
	 * Create breadcrumb to easy and simple.
	 * 
	 * @param  string $homebase Title for home page or dashboard page
	 * @param  string $separate Other symbols that are used for separatian, and default null]
	 * @return $breadcrumb 		Make breadcrumb combine into one]
	 */
	function breadcrumb($homebase = 'Home', $separate = '')
	{
		$page = explode('/', request()->path());
		$homepage = array_shift($page);
		$lastpage = array_keys($page);
		$breadcrumb = ["<li>".link_to($homepage, $homebase)."</li>"];

		foreach ($page as $key => $value) {
			if($key != end($lastpage)) {
				if(!is_numeric($value))
					$breadcrumb[] = "<li>".link_to($homepage.'/'.$value, ucwords($value))."</li>";
			} else {
				$breadcrumb[] = "<li class='active'>".ucwords($value)."</li>";
			}
		}
		return implode($separate, $breadcrumb);
	}
}

if(!function_exists('getAllModels'))
{
    /**
     * Get a list  all of model 
     * @param  string $path         Get all the files in the destination directory
     * @param  string $namespace    Set namespace model
     * @param  string $prefix       Variables will be added in the model class suffix
     * @return $models              Get all models with namespace
     */
    function getAllModels($path, $namespace = 'App\\', $prefix = '')
    {
        $models = array();
        foreach(scandir($path) as $file) {
            if ($file == '.' || $file == '..' ) continue;
            $models[] = $namespace . str_replace('.php', $prefix, $file);
        }

        return $models;
    }
}