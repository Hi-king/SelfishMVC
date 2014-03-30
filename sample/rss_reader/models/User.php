<?php
/**
 * @Entity @Table(name="users")
 **/
class User extends Model{
  /** @Id @Column(type="integer") @GeneratedValue **/
  protected $id;

  /** @Column(type="string") **/
  protected $name;

  function __Construct($name, $entity_manager) {
    parent::__Construct($entity_manager);
    $this->name = $name;
    $this->name2 = $name;
    $this->feeds = new \Doctrine\Common\Collections\ArrayCollection();
  }

  public function getName() {
    return $this->name;
  }

  public function getFeeds() {
    return $this->feeds;
  }

  /** 
      @ManyToMany(targetEntity="RSS", cascade={"persist"})
      @JoinTable(name="usersfeeds",
      joinColumns={@JoinColumn(name="feeds_id", referencedColumnName="id")},
      inverseJoinColumns={@JoinColumn(name="users_id", referencedColumnName="id")})
  **/
  private $feeds;

  private static $VALID_USER = array('anonymous', 'hiking');
  public static function login($username) {
    if(!in_array($username, self::$VALID_USER)) {
      throw new Exception($username." is not a valid user.");
    }
  }
}