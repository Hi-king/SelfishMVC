<?php
require 'conf/route.php'; /* TODO: Sophisticated Loader */

class Router {
  public static function resolve($request) {
    echo $request->pathInfo."<br/>";
    return NULL;
  }
}