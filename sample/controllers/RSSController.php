<?php
class RSSController{
  function hello() {
    $smarty = new Smarty();
    $smarty->template_dir = dirname(__FILE__).'/../view/templates/';
    $smarty->compile_dir  = dirname(__FILE__).'/../view/templates_c/';
    $smarty->config_dir   = dirname(__FILE__).'/../view/config/';
    $smarty->cache_dir    = dirname(__FILE__).'/../view/cache/';


    $smarty->assign('name', 'Anonymous');
    $smarty->assign('contents', 
      $smarty->fetch('hello.tpl')
    );
    $smarty->display('layout.tpl');
    //echo "<p>Hello, World</p>";
  }
  function top() {
    echo "<p>Top page?</p>";
  }
  function param($id) {
    echo sprintf("<h1>id = %s</h1", $id);  }
}