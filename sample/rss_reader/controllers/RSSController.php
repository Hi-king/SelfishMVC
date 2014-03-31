<?php
class RSSController extends Controller{
  function __Construct($smarty, \Doctrine\ORM\EntityManager $entityManager) {
    parent::__Construct($smarty, $entityManager);
  }

  function top() {
    $session = new Session();
    try {
      $uid = $session->getAttr('uid');
      $found = $this->entity_manager->getRepository('User')->findBy(array('name' => $uid));
      $user = $found[0];
      HttpResponse::redirect("./selfish/index.php/user/".$user->getName()."/");
    } catch (BadMethodCallException $e) {
      HttpResponse::redirect("./selfish/index.php/user/guest/");
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
