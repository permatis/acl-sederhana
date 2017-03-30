<?php

if(!function_exists('breadcrumb'))
{
	/**
	 * Create breadcrumb to easy and simple.
	 *
	 * @param  string $homebase Title for home page or dashboard page
	 * @param  string $separate Other symbols that are used for separatian, and default null
	 * @return $breadcrumb 		Make breadcrumb combine into one
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

if(! function_exists('groupArrayByValueIsContains'))
{
	/**
	 * Mengelompokan nilai didalam array yang memiliki persamaan
	 * @param  array $array nilai array
	 * @param  boolean $multiple untuk menampilkan data pertama itu multiple array
	 * @return array
	 */
	function groupArrayByValueIsContains($objects)
	{

		// for ($i=0; $i < count($array); $i++) {
		// 	if(strpos($array[$i]['name'], '-')) {
		// 		$val = explode('-', $array[$i]['name']);
		//
		// 		if(isset($array[$i+1])) {
		// 			if (strpos($array[$i+1]['name'], $val[1]) || ( isset($array[$i-1]['name']) && strpos($array[$i-1]['name'], $val[1])) ) {
		// 				$newArray[$val[1]][$array[$i]['id']] = ucwords($val[0]);
		// 			}
		// 		} else {
		// 			$newArray[$val[1]][$array[$i]['id']] = ucwords($val[0]);
		// 		}
		// 	} else {
		// 		if($custom) {
		// 			$newArray[$array[$i]['name']] = [ $array[$i]['id'] => ucwords($array[$i]['name']) ];
		// 		} else {
		// 			$newArray[$array[$i]['id']] = ucwords($array[$i]['name']);
		// 		}
		// 	}
		// }
		$arrays = [];

		foreach ($objects as $key => $value) {
			if(strpos($value->name, '-')){
				$values = explode('-', $value->name);
				$arrays['crud'][$values[1]][] = ['id' => $value->id, 'name' => $values[0]];
			} else {
				$arrays[$value->name]['id'] =  $value->id;
			}
		}
		return $arrays;
	}
}

if(! function_exists('convertObjectToNestedList'))
{
	/**
	 * Merubah nilai object ke dalam html berupa tampilan nested list
	 * @param  array  $array    nilai array
	 * @param  string $attrName nama attribut pada input
	 * @return string           tampilkan dalam bentuk html
	 */
	function convertObjectToNestedList($arrays = [], $attrName = 'name')
	{
		// $arrays = [];
		$html = '';

		// foreach ($array as $key => $value) {
		// 	if(strpos($value->name, '-')){
		// 		$values = explode('-', $value->name);
		// 		$arrays['crud'][$values[1]][] = ['id' => $value->id, 'name' => $values[0]];
		// 	} else {
		// 		$arrays[$value->name]['id'] =  $value->id;
		// 	}
		// }

		foreach( $arrays as $key => $val) {
			if($key === 'crud') {
				foreach($val as $parent => $values)  {
					$html .= '<li><input type="checkbox" id="'.$parent.'"> <label>'.ucwords($parent).'</label><ul>';
					foreach($values as $child) {
						$html .= '<li><input type="checkbox" name="'.$attrName.'[]" id="'.$parent.'_'.$child['name'].'" value="'.$child['id'].'">
								<label>'.ucwords($child['name']).'</label></li>';
					}
					$html .= '</ul>';
				}
			} else {
				$html .= '<li><input type="checkbox" id="'.strtolower($key).'" name="'.$attrName.'[]" value="'.$val['id'].'">
							<label>'.ucwords($key).'</label></li>';
			}
		}

		return $html;
	}
}
