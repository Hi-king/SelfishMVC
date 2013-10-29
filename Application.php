<?php
class Application {
  function __Construct() {
    require_once 'core/Request.php';
    require_once 'core/Router.php';

    $this->router = new Router($this->route());
  }

  function run($server) {
    $req = new Request($_SERVER);
    $this->router->resolve($req);
  }

  private function controller_loader() {

  }

  private function route() {

  }
}