<?PHP
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require_once __DIR__.'/../../vendor/autoload.php';
require_once __DIR__.'/../../Application.php';
require_once __DIR__.'/../../core/Model.php';
require_once __DIR__.'/models/User.php';

class TestApplication extends Application {
  public function get_doctrine() {
    $isDevMode = true;
    $config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/models"), $isDevMode);
    $conn = array(
                  'driver' => 'pdo_sqlite',
                  'memory' => true
                  );
    return EntityManager::create($conn, $config);
  }
}

class ModelTest extends PHPUnit_Framework_TestCase {
  public function testPersist() {
    $app = new TestApplication();
    
    $em = $app->get_doctrine();

    $tool = new \Doctrine\ORM\Tools\SchemaTool($em);
    $tool->createSchema($em->getMetaDataFactory()->getAllMetaData());

    $test_user = new User("Alice", $em);
    $test_user->persist();
    $users = $em->getRepository('User')->findAll();
    var_dump($users[0]->getName());
  }
}