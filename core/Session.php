<?php
class Session{
  function __Construct() {
    // TODO: one time session
    if(!isset($_SESSION)) {
      session_start();
    }
  }

  public function getId(){
    return session_id();
  }

  public function setAttr($attrName, $val) {
    $_SESSION[$attrName] = $val;
  }

  public function getAttr($attrName) {
    if (! array_key_exists($attrName, $_SESSION)) {
      throw new BadMethodCallException('key='.$attrName.' does not exist in $_SESSION');
    }
    return $_SESSION[$attrName];
  }

  public function deleteAttr($attrName) {
    if (! array_key_exists($attrName, $_SESSION)) {
      throw new BadMethodCallException('key='.$attrName.' does not exist in $_SESSION');
    }
    unset($_SESSION[$attrName]);
  }
}
