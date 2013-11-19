<?php
class RSSController{
  function hello() {
    echo "<p>Hello, World</p>";
  }
  function top() {
    echo "<p>Top page?</p>";
  }
  function param($id) {
    echo sprintf("<h1>id = %s</h1", $id);  }
}