<?php
require_once '../../Application.php';

class FirstApplication extends Application {
  protected function route() {
    return array(
      '/hello/:id' => array(
        'controller' => 'FirstController',
        'action' => 'hello',
        'argnames' => array('id')
      )
    );
  }
}

class FirstController extends Controller {
  public function hello($id) {
    $this->ok("Hello, ".$id.".");
  }
}

(new FirstApplication())->run($_SERVER);
