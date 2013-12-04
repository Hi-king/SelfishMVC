<?php
require_once '/usr/local/lib/Smarty-3.1.15/libs/Smarty.class.php';
require_once dirname(__FILE__).'/../../core/Controller.php';

class ControllerTest extends PHPUnit_Framework_TestCase
{
  function setup() {
    $dummy_smarty = new Smarty();
    $this->controller = new Controller($dummy_smarty);
  }

  public function testNotFound() {
    $this->controller->not_found("not found test");
    // TODO: check status code
  }
}
