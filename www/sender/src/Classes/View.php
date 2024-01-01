<?php
namespace App\Classes;

/**
 * render html
 */
class View {


	//////
	/**
	 * @param mixed $view
	 * @param mixed $data
	 * 
	 * @return [type]
	 */
	public function render($view, $data): void
	{

        include_once "./view/main.php";		
	}

	
}