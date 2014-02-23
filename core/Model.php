<?PHP
class Model {
  protected applicateion_class = Application;
  protected persist() {
    applicateion_class->get_doctrine()->persist($this);
    applicateion_class->get_doctrine()->flush();
  }
}