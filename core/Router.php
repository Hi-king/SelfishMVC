<?php
require_once 'conf/route.php'; /* TODO: Sophisticated Loader */
require_once 'controllers/RSSController.php'; /* TODO: Namespace... */

class Router {
  public static function resolve($request) {
    $action = self::getAction($request);
    
    $controller = new $action['controller'];
    $controller->$action['action'](); // Q: Any way to avoid variable variable ?
  }

  function getAction($request) {
    global $route; /* TODO: stop using global */
    foreach($route as $matcher => $action) {
      /* TODO: GET params with reqexp */
      if($matcher === $request->path_info) {
        return $action;
      }
    }
    return False; //TODO: raise error
  }
}