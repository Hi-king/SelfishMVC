<?php
class Controller{
  function __Construct($smarty) {
    $this->smarty = $smarty;
  }

  function not_found($contents) {
    header("HTTP/1.0 404 Not Found");
    $this->smarty->display('string:'.$contents);
    exit(0); //TODO: best practice to finish ...
  }

  function bad_request($contents) {
    header("HTTP/1.0 404 Not Found");
    $this->smarty->display('string:'.$contents);
    exit(0); //TODO: best practice to finish ...
  }
}