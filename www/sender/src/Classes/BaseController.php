<?php

namespace App\Classes;

use App\Classes\View;

abstract class BaseController {

  public $view;

  public function __construct() {
      print "In ParentClass constructor\n";
      $this->view = new View();
  }
 
   
}