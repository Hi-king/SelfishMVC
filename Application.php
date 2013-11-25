<?php
class Application {
  function __Construct() {
    // Load pathes
    require_once 'core/CoreBootLoader.php';
    $this->boot_loader();
    // avoid require using relative path
    // TODO: avoid that using absolute path ...
    ini_set('include_path', '');

    $this->router = new Router($this->route());
  }

  public function run($server) {
    $req = new Request($_SERVER);
    $this->router->resolve($req);
  }

  protected function controller_loader() {

  }

  protected function boot_loader() {

  }

  protected function route() {

  }
}