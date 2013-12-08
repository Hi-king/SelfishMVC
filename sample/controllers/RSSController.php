<?php
require_once dirname(__FILE__).'/../models/User.php';

class RSSController extends Controller{
  function __Construct($smarty) {
    parent::__Construct($smarty);
  }

  function hello($id) {
    try{
      User::login($id);
      //TODO: wrap smarty ?
      $this->smarty->assign('name', $id);
      $this->smarty->assign('contents',
        $this->smarty->fetch('hello.tpl')
      );
      $this->smarty->display('layout.tpl');
    }catch (Exception $e){
      $this->not_found("Wrong Username!");
    }
  }
  function top() {
    echo "<p>Top page?</p>";
  }

  function rssview($url) {
    RSS
    echo "<p>Top page?</p>";
  }

  function param($id) {
    echo sprintf("<h1>id = %s</h1", $id);  
  }
}