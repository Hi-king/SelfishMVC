<?PHP
require_once __DIR__.'/../../vendor/autoload.php';
require_once __DIR__.'/../../../../Application.php';
class TestApplication extends Application {
  private static $em = null;

  public function get_doctrine() {
    if (is_null(self::$em)) {
      self::$em = $this->get_doctrine_instance();
      $tool = new \Doctrine\ORM\Tools\SchemaTool(self::$em);
      $tool->createSchema(self::$em->getMetaDataFactory()->getAllMetaData());
    }
    return self::$em;
  }

  public function get_doctrine_instance() {
    $isDevMode = true;
    $config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration(array(__DIR__."/../../models"), $isDevMode);
    $conn = array(
                  'driver' => 'pdo_sqlite',
                  'memory' => true
                  );
    return \Doctrine\ORM\EntityManager::create($conn, $config);
  }

  public function get_smarty() {
    $smarty = new Smarty();
    $smarty->template_dir = __DIR__.'/../../view/templates/';
    $smarty->compile_dir  = __DIR__.'/../../view/templates_c/';
    $smarty->config_dir   = __DIR__.'/../../view/config/';
    $smarty->cache_dir    = __DIR__.'/../../view/cache/';
    return $smarty;
  }

  protected function coreBootLoader() {
    require_once __DIR__.'/../../../../core/Request.php';
    require_once __DIR__.'/../../../../core/Router.php';
    require_once __DIR__.'/../../../../core/Controller.php';
    require_once __DIR__.'/../../../../core/Model.php';
    require_once '/usr/local/lib/Smarty-3.1.15/libs/Smarty.class.php';
    require_once __DIR__.'/../../controllers/UserController.php';
  }
}

class Session {
  private static $arr = array();

  public function setAttr($attrName, $val) {
    self::$arr[$attrName] = $val;
  }

  public function getAttr($attrName) {
    if (array_key_exists($attrName, self::$arr)) {
      return self::$arr[$attrName];
    } else {
      throw new BadMethodCallException();
    }
  }
}

class UserControllerTest extends PHPUnit_Framework_TestCase {
  function Setup() {
    $this->app = new TestApplication();
    $this->controller = new UserController($this->app->get_smarty(), $this->app->get_doctrine());
  }
  public function testLoggedIn() {
    $this->controller->logged_in("Alice");

    // User saved?
    $em = $this->app->get_doctrine();
    $users = $em->getRepository('User')->findAll();
    $this->assertEquals($users[0]->getName(), "Alice");
  }
}

