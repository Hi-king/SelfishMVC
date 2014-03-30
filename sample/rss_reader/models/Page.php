<?php
class Page{
  function __construct($url) {
    $this->url = $url;
    $this->rss = simplexml_load_file($this->url);
  }

  public function get_recent($limit=5) {
    return $this->rss->channel->item;
  }

  public function is_valid() {
    return ($this->rss != False);
  }

  public function get_title() {
    if($this->is_valid()){
      return $this->rss->channel->description;
    }else{
      return "invalid url";
    }
  }
}
