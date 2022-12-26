<?php

use App\Controllers\Backup;
use App\Controllers\Email\EmailController;
use App\Controllers\Database\DatabaseController;

include "../vendor/autoload.php";
$config = include '../config.php';


new Backup($config);
