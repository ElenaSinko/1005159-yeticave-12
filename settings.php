<?php
require_once('helpers.php');
require_once('functions/functions.php');
require_once('database.php');
date_default_timezone_set("Africa/Libreville");

$link = mysqli_connect($database['host'], $database['user'], $database['password'],$database['database']);
mysqli_set_charset($link, "utf8");
