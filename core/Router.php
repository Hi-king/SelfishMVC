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
    self::compileRoutes();

    global $route; /* TODO: stop using global */
    foreach($route as $matcher => $action) {
      /* TODO: GET params with reqexp */
      if($matcher === $request->path_info) {
        return $action;
      }
    }
    return False; //TODO: raise error
  }

  function compileRoutes() {
    global $route; 
    $compiled_route = array();

    foreach($route as $matcher => $action) {
      $path_fragments = explode('/', $matcher);
      $compiled_fragments = array();
      foreach($path_fragments as $path_fragment) {
        echo $path_fragment;
        $compiled_fragments[] = $path_fragment;
      }
      print_r($compiled_fragments);
      print implode('/', $compiled_fragments);


      throw new Exception("Not Implemented");


    }
  }
}