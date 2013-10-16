<?php
require '../conf/route.php' /* TODO: Sophisticated Loader */

class Request {
  private $requestUri;
  function __Construct($SERVER) {
    $this->requestUri = $SERVER['REQUEST_URI'];
  }
}