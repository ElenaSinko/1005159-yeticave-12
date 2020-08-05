<?php
require_once('settings.php');
$categories = [];
$ads = [];

$lot_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);

if (!$link) {
    $error = mysqli_connect_error();
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

    $sql = 'SELECT lots.title as lot_title, lots.id, base_price, img, description, step_price, closing_date as date_expiration, categories.title as lot_category, IFNULL(MAX(amount), lots.base_price) as price FROM lots
            LEFT JOIN bets ON lots.id = bets.lotID
            JOIN categories ON lots.categoryID = categories.id
            WHERE lots.id = ' . $lot_id . '
            GROUP BY lots.id';

    $result = mysqli_query($link, $sql);

    if ($result) {
        $lot = mysqli_fetch_all($result, MYSQLI_ASSOC)[0];
        $page_content = include_template('lot_content.php', [
            'categories' => $categories,
            'lot' => $lot
        ]);
        if (!$lot) {
            $page_content = include_template('error.php');
        }
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
    'title' => 'Лот',
    'is_auth' => $is_auth,
    'user_name' => $user_name
]);

print($layout_content);
