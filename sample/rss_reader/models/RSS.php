<?php
class RSS{
  function __construct($url) {
    $this->url = $url;
    $this->rss = simplexml_load_file($this->url);
  }

  public function get_recent($limit=5) {
    return $this->rss->channel->item;
  }

  public function get_title() {
    return $this->rss->channel->description;
  }
}

class NestedRSS {
}

class SimpleRSS {
}