<?php
require_once '../Application.php';

class RSSApplication extends Application {
  protected function route() {
     require_once dirname(__FILE__).'/controllers/RSSController.php'; /* TODO: Namespace... */
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

(new RSSApplication())->run($_SERVER);


/* require 'core/Request.php'; */
/* require 'core/Router.php'; */
/* $req = new Request($_SERVER); */
/* Router::resolve($req); */

