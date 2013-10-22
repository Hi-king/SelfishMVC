<p>hello</p>
<?php
require 'core/Request.php';
require 'core/Router.php';
$req = new Request($_SERVER);
Router::resolve($req);

