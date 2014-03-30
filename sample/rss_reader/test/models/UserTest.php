<?PHP
require_once __DIR__.'/../../vendor/autoload.php';
require_once __DIR__.'/../../../../Application.php';

class TestApplication extends Application {
  public function get_doctrine() {
    $isDevMode = true;
    $config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration(array(__DIR__."/../../models"), $isDevMode);
    $conn = array(
                  'driver' => 'pdo_sqlite',
                  'memory' => true
                  );
    return \Doctrine\ORM\EntityManager::create($conn, $config);
  }
}

class UserTest extends PHPUnit_Framework_TestCase {
  public function testPersist() {
    $app = new TestApplication();
    $em = $app->get_doctrine();

    $tool = new \Doctrine\ORM\Tools\SchemaTool($em);
    $tool->createSchema($em->getMetaDataFactory()->getAllMetaData());

    $test_user = new User("Alice", $em);
    $test_user->persist($em);
    $users = $em->getRepository('User')->findAll();

    $this->assertEquals($users[0]->getName(), "Alice");
  }

  public function testGetRelatedFeeds() {
    $app = new TestApplication();
    $em = $app->get_doctrine();

    $tool = new \Doctrine\ORM\Tools\SchemaTool($em);
    $tool->createSchema($em->getMetaDataFactory()->getAllMetaData());

    // define sample user
    $test_user = new User("Alice", $em);
    $test_user->persist($em);

    // get user from repository
    $users = $em->getRepository('User')->findAll();
    $test_user = $users[0];
    $test_user->getFeeds()->add(new RSS("http://dummy.uri", $em));
    $test_user->persist($em);

    // get from repository
    $users = $em->getRepository('User')->findAll();
    $feeds = $users[0]->getFeeds();

    $this->assertEquals($feeds[0]->getURL(), "http://dummy.uri");
  }
}
