<?php
require_once('settings.php');
session_start();
$categories = [];
$errors = [];
$ads = [];
$is_auth = 0;

if (!$link) {
    $error = mysqli_connect_error();
    $page_content = include_template('error.php');
} else {
    $sql = 'SELECT title, character_code FROM categories';
    $result = mysqli_query($link, $sql);
    if ($result) {
        $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//Проверка, что все поля заполнены
        $required_fields = ['email', 'password', 'name', 'message'];
        foreach ($required_fields as $val) {
            if (empty($_POST[$val])) {
                $errors[$val] = 'Поле не заполнено';
            }
        }
// Проверка корректности email
        if(!validateEmail($_POST['email'])) {
            $errors['email'] = 'Введиде корректный email';
        }
// Проверка, что такой пользователь еще не зарегистрирован
        $email = $_POST['email'];
        $sql = 'SELECT email FROM users WHERE email = "' . $_POST['email'] . '"';
        $result = mysqli_query($link, $sql);
        $emails = mysqli_fetch_all($result, MYSQLI_ASSOC)[0];

        if($emails) {
            $errors['email'] = 'Пользователь с таким email уже есть';
        }

        if(count($errors) === 0) {
            $sql = 'INSERT INTO users(name, email, pass, contacts) VALUES (?, ?, ?, ?)';
            $stmt = mysqli_prepare($link, $sql);
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            mysqli_stmt_bind_param($stmt, 'ssss', $_POST['name'], $_POST['email'], $password, $_POST['message']);
            $res = mysqli_stmt_execute($stmt);
            if ($res) {
                header("Location: login.php");
            } else {
                $content = include_template('error.php', ['error' => mysqli_error($link)]);
            }

        }
    }

    else {
        $error = mysqli_error($link);
        $page_content = include_template('error.php');
    }
}

if (!isset($_SESSION['user'])) {
    $page_content = include_template('sign-up_template.php', ['categories' => $categories, 'errors' => $errors]);
} else {
    $page_content = include_template('error.php', ['error' => 'Вы уже зарегистрированы']);
}

$layout_content = include_template('layout.php', [
    'content' => $page_content,
    'categories' => $categories,
    'title' => 'Страница регистрации',
    'is_auth' => $is_auth,
    'user_name' => $user_name
]);

print($layout_content);

