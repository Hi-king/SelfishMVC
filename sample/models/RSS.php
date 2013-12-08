<?php
class RSS{
  public static function get_recent($url, $limit=5) {
    $rss = simplexml_load_file($url);
    for($i = 0; $i< $limit; $i++) {
      $article = $rss->item[$i];
      var_dump($article);
    }

  }
}