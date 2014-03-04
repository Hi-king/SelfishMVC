<?PHP
require_once __DIR__.'/../../../core/Model.php';

/**
 * @Entity @Table(name="users")
 **/
class User extends Model {
  /** @Id @Column(type="integer") @GeneratedValue **/
  protected $id;

  /** @Column(type="string") **/
  protected $name;

  function __Construct($name, $entity_manager) {
    parent::__Construct($entity_manager);
    $this->name = $name;
  }

  public function getId()
  {
    return $this->id;
  }

  public function getName()
  {
    return $this->name;
  }

  public function setName($name)
  {
    $this->name = $name;
  }
}