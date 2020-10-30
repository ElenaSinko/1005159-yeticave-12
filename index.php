<?php
session_start();
require_once('settings.php');
$categories = [];
$ads = [];
$is_auth = 0;

$user_name = '';

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

//    $sql = 'SELECT lots.title as lot_title, lots.id, base_price, img, closing_date as date_expiration, categories.title as lot_category, IFNULL(MAX(amount), lots.base_price) as price FROM lots
//            LEFT JOIN bets ON lots.id = bets.lotID
//            JOIN categories ON lots.categoryID = categories.id
//            WHERE closing_date > CURRENT_TIMESTAMP
//            GROUP BY lots.id
//            ORDER BY lots.date_time DESC';
    $sql = 'SELECT lots.title as lot_title, lots.id, base_price, img, closing_date as date_expiration, categories.title as lot_category, IFNULL(MAX(amount), lots.base_price) as price FROM lots
            LEFT JOIN bets ON lots.id = bets.lotID
            JOIN categories ON lots.categoryID = categories.id

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


$layout_content = include_template('layout.php', [
    'content' => $page_content,
    'categories' => $categories,
    'title' => 'Главная',
    'is_auth' => $is_auth,
    'user_name' => $user_name
]);

print($layout_content);

