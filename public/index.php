<?php

use App\Controllers\Backup;

// Use full hosting path
include "../vendor/autoload.php";
$config = include '../config.php';


new Backup($config);
