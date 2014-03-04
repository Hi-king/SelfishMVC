<?PHP
class Model {
  public static  $repo_name = '';


  function __Construct(Doctrine\ORM\EntityManager $entity_manager) {
    $this->entity_manager = $entity_manager;
  }

  public function persist() {
    $this->entity_manager->persist($this);
    $this->entity_manager->flush();
  }

}
