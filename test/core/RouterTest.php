<?php
require_once dirname(__FILE__).'/../../core/Router.php';
require_once dirname(__FILE__).'/../../core/Request.php';

class RouterTest extends PHPUnit_Framework_TestCase
{
  function setup() {
    global $route;
    $route = array('/test'=>array('controller'=>'Test'),);
    $fakeparam = array('REQUEST_URI'=>'/test', 'SCRIPT_NAME'=>'');
    $this->fakerequest = new Request($fakeparam);
  }

  public function testGetAction()
  {
    self::setup();

    $action = Router::getAction($this->fakerequest);
    $this->assertEquals($action['controller'], 'Test');
  }
}