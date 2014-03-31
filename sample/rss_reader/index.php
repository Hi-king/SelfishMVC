<?php
/*
  Application definition class
 */
require_once '../../Application.php';
require_once __DIR__.'/vendor/autoload.php'; //composer

//require_once __DIR__.'/vendor/doctrine/orm/lib/Doctrine/ORM/Tools/Setup.php';
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

class RSSApplication extends Application {
  protected function route() {
    return array(
      '/top/' => array(
        'controller' => 'RSSController', 
        'action' => 'top'
      ),
      '/param/:id/' => array(
        'controller' => 'RSSController', 
        'action' => 'param', 
        'argnames' => array('id')
      ),
      '/show/' => array(
        'method' => 'GET',
        'params' => 'url',
        'controller' => 'RSSController',
        'action' => 'rssview',
        'argnames' => array('url')
      ),

      //User
      '/user/:name/' => array(
        'controller' => 'UserController',
        'action' => 'show_rss_list',
        'argnames' => array('name')
      ),
      '/feeds/add/' => array(
        'method' => 'GET',
        'params' => array('name', 'url'),
        'controller' => 'UserController',
        'action' => 'add_rss',
        'argnames' => array('name', 'url')
      ),
      '/login/' => array(
        'controller' => 'UserController',
        'action' => 'login'
      ),
      '/logout/' => array(
        'controller' => 'UserController',
        'action' => 'logout'
      ),
      '/logged_in' => array(
        'controller' => 'UserController',
        'action' => 'logged_in',
        'argnames' => array('name')
      )
    );
  }

  protected function boot_loader() {
    require_once __DIR__.'/models/User.php';
    require_once __DIR__.'/models/RSS.php';
    require_once __DIR__.'/models/Page.php';
    require_once __DIR__.'/controllers/UserController.php';
    require_once __DIR__.'/controllers/RSSController.php';
  }

  // smarty config
  protected function get_smarty() {
    $smarty = new Smarty();
    $smarty->template_dir = dirname(__FILE__).'/view/templates/';
    $smarty->compile_dir  = dirname(__FILE__).'/view/templates_c/';
    $smarty->config_dir   = dirname(__FILE__).'/view/config/';
    $smarty->cache_dir    = dirname(__FILE__).'/view/cache/';
    return $smarty;
  }

  public function get_doctrine() {
    $isDevMode = true;
    $config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration(array(__DIR__."/models"), $isDevMode);
    $conn = array(
                  'driver'   => 'pdo_mysql',
                  'user'     => 'root',
                  'password' => '',
                  'dbname'   => 'rss_reader'
                  );
    $entity_manager = EntityManager::create($conn, $config);
    //$tool = new \Doctrine\ORM\Tools\SchemaTool($entity_manager);
    //$tool->createSchema($entity_manager->getMetaDataFactory()->getAllMetaData());
    return $entity_manager;
  }
}

// start Applitcation
$app = new RSSApplication();
$app->run($_SERVER);

