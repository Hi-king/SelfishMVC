<?php
class Request {
  private $requestUri;
  function __Construct($SERVER) {
    $this->request_uri = $SERVER['REQUEST_URI'];
    $this->base_uri = $SERVER['SCRIPT_NAME'];
    $this->path_info = substr($this->request_uri, strlen($this->base_uri));
  }
}