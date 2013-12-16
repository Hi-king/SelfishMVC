<?php
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
    $this->smarty->assign('contents',
      $this->smarty->fetch('top.tpl')
    );
    $this->smarty->display('layout.tpl');
  }

  function rssview($url) {
    $rss = new RSS($url);
    $entries = $rss->get_recent();

    $this->smarty->assign('entries', $entries);
    $this->smarty->assign('title', $rss->get_title());
    $this->smarty->assign('contents',
      $this->smarty->fetch('rsslist.tpl')
    );
    $this->smarty->display('layout.tpl');
  }

  function param($id) {
    echo sprintf("<h1>id = %s</h1", $id);  
  }
}