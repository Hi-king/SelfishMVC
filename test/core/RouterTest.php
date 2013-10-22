<?php
require_once dirname(__FILE__).'/../../core/Router.php';
require_once dirname(__FILE__).'/../../core/Request.php';

class RouterTest extends PHPUnit_Framework_TestCase
{
  function setup() {
    global $route;
    global $fakerequest;
    $fakeparam = array('REQUEST_URI'=>'/test', 'SCRIPT_NAME'=>'');
    $fakerequest = new Request($fakeparam);
    $route = array('/test'=>array('controller'=>'Test'),);
  }

  public function testGetAction()
  {
    self::setup();
    global $fakerequest;

    $action = Router::getAction($fakerequest);
    $this->assertEquals($action['controller'], 'Test');
  }
}