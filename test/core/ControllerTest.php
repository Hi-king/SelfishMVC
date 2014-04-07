<?php
require_once '/usr/local/lib/Smarty-3.1.15/libs/Smarty.class.php';
require_once __DIR__.'/../../vendor/autoload.php';
require_once __DIR__.'/../../Application.php';
require_once dirname(__FILE__).'/../../core/Controller.php';

class TestApplication extends Application {
  public function get_doctrine() {
    $isDevMode = true;
    $config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration(array(__DIR__."/models"), $isDevMode);
    $conn = array(
                  'driver' => 'pdo_sqlite',
                  'memory' => true
                  );
    return \Doctrine\ORM\EntityManager::create($conn, $config);
  }
}

class ControllerTest extends PHPUnit_Framework_TestCase
{
  
  function setup() {
    $app = new TestApplication();
    $em = $app->get_doctrine();
    $dummy_smarty = new Smarty();
    $this->controller = new Controller($dummy_smarty, $em);
  }

  /**
   * @runInSeparateProcess
   */
  public function testNotFound() {
    $this->expectOutputString('not found test');
    $this->controller->not_found("not found test");
  }
}
