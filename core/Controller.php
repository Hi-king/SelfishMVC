<?php
class Controller{
  function __Construct($smarty, \Doctrine\ORM\EntityManager $entity_manager) {
    $this->smarty = $smarty;
    $this->entity_manager = $entity_manager;
  }

  function not_found($contents) {
    header("HTTP/1.0 404 Not Found");
    //$this->smarty->display('string:'.$contents);
    //echo $contents;
    exit(0);
  }

  function ok($contents) {
    header("HTTP/1.0 200 OK");
    echo $contents;
    //$this->smarty->display('string:'.$contents);
    exit(0);
  }

  function bad_request($contents) {
    header("HTTP/1.0 404 Not Found");
    //$this->smarty->display('string:'.$contents);
    echo $contents;
    exit(0);
  }
}