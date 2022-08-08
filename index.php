<?php

use app\Core\Core;

require('vendor/autoload.php');

$url = $_GET;

$core = new Core;
$content = $core->start($url);