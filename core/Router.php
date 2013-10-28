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
      $compiled_groupnames = array();
      

      foreach($path_fragments as $path_fragment) {
        if($path_fragment[0] === ":") {
          $compiled_groupnames[]= substr($path_fragment, 1, strlen($path_fragment));
          $path_fragment = "(.*)";
        }
        

        $compiled_fragments[] = $path_fragment;
      }

      $compiled_matcher = implode('/', $compiled_fragments);      
      $compiled_eachroute = array(
                                  'matcher' => $compiled_matcher,
                                  'name' => $compiled_groupnames,
                                 );

      $compiled_route[] = $compiled_eachroute;
      

    }
    print_r($compiled_route);
  }
}