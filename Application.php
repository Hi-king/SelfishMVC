<?php
class Application {
  function __Construct() {
    require_once 'core/Request.php';
    require_once 'core/Router.php';
    $this->router = new Router($this->route());
    
  }

  public function run($server) {
    $req = new Request($_SERVER);
    $this->router->resolve($req);
  }

  protected function controller_loader() {

  }

  protected function route() {

  }
}