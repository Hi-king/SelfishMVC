<?php

class Router {
  private $compiled_route;
  private $route;
  function __Construct($route, $smarty) {
    $this->route = $route;
    $this->smarty = $smarty;
  }

  public function resolve($request) {
    /* call controller::action using $request */
    $action = self::getAction($request);
    $controller = new $action['controller']($this->smarty);
    call_user_func_array(array($controller, $action['action']), $action['params']);
  }

  function getAction($request) {
    /* get action, controller, params from request */
    $this->compileRoutes();
    foreach($this->compiled_route as $routedef) {
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

  function compileRoutes() {
    /* compile routing definitions into Regexp */
    /* TODO: regexp escape */
    $this->compiled_route = array();

    foreach($this->route as $matcher => $action) {
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

      $this->compiled_route[] = $compiled_eachroute;
    }
  }
}