<?php

require_once 'connect.php';


require_once 'navbar.php';

// var_dump($_SESSION);
// echo phpinfo();

echo ($Team->getId(198)['team']);

require_once 'footer.php';
