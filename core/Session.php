<?php
class Session{
  function __Construct() {
    // TODO: one time session
    session_start();
  }

  public function getId(){
    return session_id();
  }

  public function getAttr(string $attrName){
    throw new BadMethodCallException('Not Implemented');
    exit(1);
  }
}
