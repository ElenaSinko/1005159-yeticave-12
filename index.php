<?php
require_once('helpers.php');
require_once('functions/functions.php');
date_default_timezone_set("Africa/Libreville");
$categories = [];
$ads = [];

$link = mysqli_connect("localhost", "root", "root","YetiCave");
mysqli_set_charset($link, "utf8");

if (!$link) {
    $error = mysqli_connect_error();
    print($error);
    $page_content = include_template('error.php');
}
else {
    $sql = 'SELECT title, character_code FROM categories';
    $result = mysqli_query($link, $sql);
    if ($result) {
        $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    else {
        $error = mysqli_error($link);
        $page_content = include_template('error.php');
    }

    $sql = 'SELECT lots.title, base_price, img, closing_date as date_expiration, categories.title, IFNULL(MAX(amount), lots.base_price) as price FROM lots
            LEFT JOIN bets ON lots.id = bets.lotID
            JOIN categories ON lots.categoryID = categories.id
            WHERE closing_date > CURRENT_TIMESTAMP
            GROUP BY lots.id
            ORDER BY lots.date_time DESC';

    $result = mysqli_query($link, $sql);

    if ($result) {
        $ads = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $page_content = include_template('main.php', ['ads' => $ads, 'categories' => $categories]);
    }
    else {
        $error = mysqli_error($link);
        $page_content = include_template('error.php');
    }
}


$is_auth = rand(0, 1);

$user_name = 'Elena Sinko';

$layout_content = include_template('layout.php', [
    'content' => $page_content,
    'categories' => $categories,
    'title' => 'Главная',
    'is_auth' => $is_auth,
    'user_name' => $user_name
]);

print($layout_content);

