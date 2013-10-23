<?php
/* TODO: Stop using global variable */
    $route = array(
      '/hello' => array('controller' => 'RSSController', 'action' => 'hello'),
      '/top' => array('controller' => 'RSSController', 'action' => 'top'), 
      '/param/:id/' => array('controller' => 'RSSController', 'action' => 'param'), 
   );
