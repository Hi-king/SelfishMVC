<?php
class Request {
  private $requestUri;
  function __Construct($SERVER) {
    $this->requestUri = $SERVER['REQUEST_URI'];
    $this->baseUri = $SERVER['SCRIPT_NAME'];
    $this->pathInfo = substr($this->requestUri, strlen($this->baseUri));
    echo $this->baseUri."<br/>";
    echo $this->requestUri."<br/>";
    echo $this->pathInfo."<br/>";    
  }
}