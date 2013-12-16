<?php
class User{
  private static $VALID_USER = array('anonymous', 'hiking');
  public static function login($username) {
    if(!in_array($username, self::$VALID_USER)) {
      throw new Exception($username." is not a valid user.");
    }
  }
}