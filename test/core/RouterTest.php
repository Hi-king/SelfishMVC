<?php
require_once dirname(__FILE__).'/../../core/Router.php';
require_once dirname(__FILE__).'/../../core/Request.php';

class RouterTest extends PHPUnit_Framework_TestCase
{
  function setup() {
    $this->router = new Router(
      array('/test'=>array('controller'=>'Test'),
            '/param/:id/:name/'=>array('argnames' => array('name', 'id')))
    );
  }

  public function testGetAction() {
    /* basic rounting test */
    self::setup();

    $fakeparam = array('REQUEST_URI'=>'/test', 'SCRIPT_NAME'=>'');
    $fakerequest = new Request($fakeparam);
    $action = $this->router->getAction($fakerequest);
    $this->assertEquals('Test', $action['controller']);
  }

  public function testGetPathParameters() {
    /* rounting and extract parameters */
    self::setup();

    $fakeparam = array('REQUEST_URI'=>'/param/1/me/', 'SCRIPT_NAME'=>'');
    $fakerequest = new Request($fakeparam);
    $action = $this->router->getAction($fakerequest);
    $this->assertEquals(array('me', '1'), $action['params']);
  }
}