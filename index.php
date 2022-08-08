<?php

use app\Core\Core;

require_once 'vendor/autoload.php';

$url = $_GET;

$core = new Core;
$content = $core->start($url);

echo $content;
