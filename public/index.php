<?php

use App\Controllers\Backup;


$config = include __DIR__.'/../config.php';
// Use full hosting path
include $config->root_dir."vendor/autoload.php";

new Backup($config);