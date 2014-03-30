<?php
class RSSController extends Controller{
  function __Construct($smarty, \Doctrine\ORM\EntityManager $entityManager) {
    parent::__Construct($smarty, $entityManager);
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
    
    $session = new Session();
    try {
      $uid = $session->getAttr('uid');
      $found = $this->entity_manager->getRepository('User')->findBy(array('name' => $uid)nn);
      $user = $found[0];
    } catch (BadMethodCallException $e) {
      $user = new User($name, $this->entity_manager);
    }

    $this->smarty->assign('contents',
      $this->smarty->fetch('top.tpl')
    );
    $this->smarty->display('layout.tpl');
  }

  function rssview($url) {
    $session = new Session();
    $uid = 'guest';
    try {
      $uid = $session->getAttr('uid');
    } catch (BadMethodCallException $e) {
      $uid = 'guest';
    }

    $page = new Page($url);
    $entries = $page->get_recent();

    $this->smarty->assign('entries', $entries);
    $this->smarty->assign('title', $page->get_title());
    $session = new Session();
    $this->smarty->assign('uid', $uid);

    $this->smarty->assign('contents',
      $this->smarty->fetch('rsslist.tpl')
    );
    $this->smarty->display('layout.tpl');
  }

  function param($id) {
    echo sprintf("<h1>id = %s</h1", $id);  
  }
}
