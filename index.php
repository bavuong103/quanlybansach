<?php

//echo "<h1> Heloo MVC</h1>";
// Xu ly controller va action tren URL
require_once('libs/Boostrap.php');

require_once('libs/Controller.php');
require_once('libs/View.php');
require_once('libs/Model.php');

require_once('libs/Template.php');

require_once('libs/Validate.php');

require_once('libs/Session.php');

require_once('libs/HTML.php');

require_once('libs/Helper.php');

require_once('libs/URL.php');

require_once('libs/Pagination.php');

require_once('define.php');

//session_start()
Session::init();

$boostrap = new Boostrap();

