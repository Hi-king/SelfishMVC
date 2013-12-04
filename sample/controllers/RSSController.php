<?php
require_once dirname(__FILE__).'/../models/User.php';

class RSSController extends Controller{
  function __Construct($smarty) {
    parent::__Construct($smarty);
  }

  function hello($id) {
    /* $smarty = new Smarty(); */
    /* $smarty->template_dir = dirname(__FILE__).'/../view/templates/'; */
    /* $smarty->compile_dir  = dirname(__FILE__).'/../view/templates_c/'; */
    /* $smarty->config_dir   = dirname(__FILE__).'/../view/config/'; */
    /* $smarty->cache_dir    = dirname(__FILE__).'/../view/cache/'; */

    try{
      User::login($id);
    }catch (Exception $e){
      // TODO: NOT FOUND??
      $this->not_found("Wrong Username!");
    }
    
    $this->smarty->assign('name', $id);
    $this->smarty->assign('contents', 
      $this->smarty->fetch('hello.tpl')
    );
    $this->smarty->display('layout.tpl');
  }
  function top() {
    echo "<p>Top page?</p>";
  }
  function param($id) {
    echo sprintf("<h1>id = %s</h1", $id);  }
}