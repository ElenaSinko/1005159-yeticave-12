<?php
session_start();
require_once('settings.php');
$categories = [];
$errors = [];


if (!$link) {
    $error = mysqli_connect_error();
    $page_content = include_template('error.php');
}
else {
    $sql = 'SELECT title, id, character_code FROM categories';
    $result = mysqli_query($link, $sql);
    if ($result) {
        $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
//        $page_content = include_template('search_template.php', ['categories' => $categories]);

        if($_SERVER['REQUEST_METHOD'] == 'GET') {
            $search = $_GET['search'];

            $sql = 'SELECT * FROM lots WHERE MATCH(title,description) AGAINST("' . $search . '")';


            $result = mysqli_query($link, $sql);

            if ($result) {
                $lots = mysqli_fetch_all($result, MYSQLI_ASSOC);
                $page_content = include_template('search_template.php', ['lots' => $lots, 'search' => $search, 'categories' => $categories]);
            }
            else {
                $error = mysqli_error($link);
                $page_content = include_template('error.php');
            }
        }

    }
    else {
        $error = mysqli_error($link);
        $page_content = include_template('error.php');
    }
}


$layout_content = include_template('layout.php', [
    'content' => $page_content,
    'categories' => $categories,
    'search' => $search,
    'lots' => $lots,
    'title' => 'Поиск',
    'is_auth' => $is_auth,
    'user_name' => $user_name
]);

print($layout_content);
