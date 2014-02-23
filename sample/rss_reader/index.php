<?php
/*
  Application definition class
 */
require_once 'vendor/autoload.php'; //composer
require_once '../../Application.php';

use Doctorine\ORM\Tools\Setup;
use Doctorine\ORM\EntityManager;

class RSSApplication extends Application {
  protected function route() {
    return array(
      '/hello/:id/' => array(
        'controller' => 'RSSController',
        'action' => 'hello',
        'argnames' => array('id')
      ),
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
      '/login/' => array(
        'controller' => 'UserController',
        'action' => 'login'
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

  protected function get_doctrine() {
    $config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/src"), $isDevMode);
    $conn = array(
                  'driver'   => 'pdo_mysql',
                  'user'     => 'root',
                  'password' => '',
                  'dbname'   => 'rss_reader'
                  );
    return EntityManager::create($conn, $config);
  }
}

// start Applitcation
(new RSSApplication())->run($_SERVER);

