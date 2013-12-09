<?php
/*
  Application definition class
 */
require_once '../Application.php';

class RSSApplication extends Application {
  protected function route() {
    // load controllers
    require_once dirname(__FILE__).'/controllers/RSSController.php'; /* TODO: Namespace... */
     
    // routing definition
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
    );
  }
  
  protected function boot_loader() {
    require_once __DIR__.'/models/User.php';
    require_once __DIR__.'/models/RSS.php';
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
}


// start Applitcation
(new RSSApplication())->run($_SERVER);

