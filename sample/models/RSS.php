<?php
class RSS{
  function __construct($url) {
    $this->url = $url;
  }

  public function get_recent($limit=5) {
    $rss = simplexml_load_file($this->url);
    //var_dump($rss->channel->item);
    //print_r($rss);
    for($i = 0; $i< $limit; $i++) {
      $article = $rss->channel->item[$i];
      print($article->title);
    }
  }
}

class NestedRSS {
  
}

class SimpleRSS {

}