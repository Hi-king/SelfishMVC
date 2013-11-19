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
      '/hello/' => array(
        'controller' => 'RSSController', 
        'action' => 'hello'
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
    );
  }
}


// start Applitcation
(new RSSApplication())->run($_SERVER);


