<?php
require_once dirname(__FILE__).'/../../core/Router.php';
require_once dirname(__FILE__).'/../../core/Request.php';

class RouterTest extends PHPUnit_Framework_TestCase
{
  function setup() {
    global $route;
    $route = array('/test'=>array('controller'=>'Test'),
                   array('/param/:id/')=>array());
  }

  public function testGetAction() {
    /* basic rounting test */
    self::setup();

    $fakeparam = array('REQUEST_URI'=>'/test', 'SCRIPT_NAME'=>'');
    $fakerequest = new Request($fakeparam);
    $action = Router::getAction($fakerequest);
    $this->assertEquals($action['controller'], 'Test');
  }

  public function testGetPathParameters() {
    /* rounting and extract parameters */
    self::setup();

    $fakeparam = array('REQUEST_URI'=>'/param/1/', 'SCRIPT_NAME'=>'');
    $fakerequest = new Request($fakeparam);
    $action = Router::getAction($fakerequest);
    $this->assertEquals($action['id'], '1');
  }
}