<?php
require_once('helpers.php');
require_once('functions/functions.php');
require_once('database.php');
require_once('validation.php');
date_default_timezone_set("Africa/Libreville");

$is_auth = rand(0, 1);
$user_name = 'Elena Sinko';

$link = mysqli_connect($database['host'], $database['user'], $database['password'],$database['database']);
mysqli_set_charset($link, "utf8");


