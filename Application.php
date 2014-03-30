<?php
class Application {
  function __Construct() {
    $this->coreBootLoader();
    // Load pathes
    $this->boot_loader();
    // avoid require using relative path
    // TODO: avoid that using absolute path ...
    ini_set('include_path', '');
  }

  public function run($server) {
    // set router here because this depends on get_smarty()
    $this->router = new Router($this->route(), $this->get_smarty(), $this->get_doctrine());
    $req = new Request($_SERVER);
    $this->router->resolve($req);
  }

  protected function coreBootLoader() {
    require_once 'core/CoreBootLoader.php';
  }

  protected function controller_loader() {}
  //Application specific boot loader
  protected function boot_loader() {}
  protected function route() {}
  protected function get_smarty() {}
  protected function get_doctrine() {}
}