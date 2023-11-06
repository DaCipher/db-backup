<?php

use App\Controllers\Backup;


$config = include '../config.php';
// Use full hosting path
include "$config->root_dir.vendor/autoload.php";

new Backup($config);