<?php
require_once 'conf/route.php'; /* TODO: Sophisticated Loader */
require_once 'controllers/RSSController.php'; /* TODO: Namespace... */

class Router {
  static $compiled_route;

  public static function resolve($request) {
    /* call controller::action using $request */
    $action = self::getAction($request);
    
    echo "controller:".$action['controller']."<br/>";
    $controller = new $action['controller'];
    call_user_func_array(array($controller, $action['action']), $action['params']);
  }

  static function getAction($request) {
    /* get action, controller, params from request */
    self::compileRoutes();
    foreach(self::$compiled_route as $routedef) {
      if(preg_match($routedef['matcher'], $request->path_info, $matches)) {
        $params = array();
        if(array_key_exists('argnames', $routedef)) {
          foreach($routedef['argnames'] as $argname) {
            $params[] = $matches[$argname];
          }
        }

        $retdict = $routedef;
        $retdict['params'] = $params;
        return $retdict;
      }
    }

    return False; //TODO: raise error
  }

  static function compileRoutes() {
    /* compile routing definitions into Regexp */
    /* TODO: regexp escape */
    global $route; 
    self::$compiled_route = array();

    foreach($route as $matcher => $action) {
      $path_fragments = explode('/', $matcher);
      $compiled_fragments = array();
      $compiled_groupnames = array();

      foreach($path_fragments as $path_fragment) {
        if(substr($path_fragment, 0, 1) === ":") {
          $compiled_groupnames[]= substr($path_fragment, 1, strlen($path_fragment));
          $path_fragment = sprintf("(?P<%s>.*)", substr($path_fragment, 1, strlen($path_fragment)));
        }
        $compiled_fragments[] = $path_fragment;
      }

      $compiled_matcher = implode('\/', $compiled_fragments);
      $compiled_matcher = "/".$compiled_matcher."/";

      $compiled_eachroute = $action;
      $compiled_eachroute['paramname'] = $compiled_groupnames;
      $compiled_eachroute['matcher'] = $compiled_matcher;

      self::$compiled_route[] = $compiled_eachroute;
    }
  }
}