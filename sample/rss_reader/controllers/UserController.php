<?php
class UserController extends Controller{
  function login() {
    $session = new Session();
    $uid = 'guest';
    try {
      $uid = $session->getAttr('uid');
    } catch (BadMethodCallException $e) {
      $uid = 'guest';
    }

    $this->smarty->assign('uid', $uid);
    $this->smarty->assign('contents',
      $this->smarty->fetch('login.tpl')
    );
    $this->ok(
      $this->smarty->fetch('layout.tpl')
    );
  }

  function logged_in($name) {
    $session = new Session();
    try {
      $uid = $session->getAttr('uid');
      $found = $this->entity_manager->getRepository('User')->findBy(array('name' => $uid));
      $user = $found[0];
    } catch (BadMethodCallException $e) {
      $user = new User($name, $this->entity_manager);
    }

    $user->persist($this->entity_manager);
    $session->setAttr('uid', $user->getName());
  }

  function add_rss($name, $url) {
    //var_dump($name);
    $found = $this->entity_manager->getRepository('User')->findBy(array('name' => $name));
    $user = $found[0];
    var_dump($url);
    var_dump(new RSS($url, $this->entity_manager));
    $user->getFeeds()->add(new RSS($url, $this->entity_manager));
    $user->persist($this->entity_manager);
  }

  function show_rss_list($name) {
    $session = new Session();
    $uid = 'guest';
    try {
      $uid = $session->getAttr('uid');
    } catch (BadMethodCallException $e) {
      $uid = 'guest';
    }

    $found = $this->entity_manager->getRepository('User')->findBy(array('name' => $name));
    $user = $found[0];
    $this->smarty->assign('uid', $uid);
    $this->smarty->assign('feeds', $user->getFeeds());
    $this->smarty->assign('contents',
      $this->smarty->fetch('urllist.tpl')
    );
    $this->ok(
      $this->smarty->fetch('layout.tpl')
    );

  }
}
