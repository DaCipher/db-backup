<?php

use App\Controllers\Backup;

// Load Config file
$config = require_once __DIR__.'/../config.php';

// Composer Autoload
require_once $config->root_dir."vendor/autoload.php";

// Initialise App
new Backup($config);