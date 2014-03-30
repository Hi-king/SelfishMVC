<?php
/**
 * @Entity @Table(name="rss")
 **/
class RSS extends Model{
  function __Construct($url, $entity_manager) {
    parent::__Construct($entity_manager);
    $this->url = $url;
  }

  /** @Id @Column(type="integer") @GeneratedValue **/
  protected $id;

  /** @ManyToMany(targetEntity="User", mappedBy="feeds")
  private $users;

  /** @Column(type="string", name="url", unique=false, nullable=false) **/
  private $url;

  public function getURL() {
    return $this->url;
  }

  public function getPage() {
    return new Page($this->url);
  }

  /* function __construct($url) { */
  /*   $this->url = $url; */
  /*   $this->rss = simplexml_load_file($this->url); */
  /* } */

  /* public function get_recent($limit=5) { */
  /*   return $this->rss->channel->item; */
  /* } */

  /* public function get_title() { */
  /*   return $this->rss->channel->description; */
  /* } */
}
