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
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $required_fields = ['email', 'password'];
        foreach ($required_fields as $val) {
            if (empty($_POST[$val])) {
                $errors[$val] = 'Поле не заполнено';
            }
        }



            if(count($errors) === 0) {
                $sql = 'SELECT * FROM users WHERE email = "' . $_POST['email'] . '"';
                $res = mysqli_query($link, $sql);
                $user = $res ? mysqli_fetch_array($res, MYSQLI_ASSOC) : null;
                if($user) {
                    if (password_verify($_POST['password'], $user['pass'])) {
                        $_SESSION['user'] = $user;
                        header("Location: index.php");
                        exit();
                    } else {
                        $errors['password'] = 'Неверный пароль';
                    }
                } else {
                    $errors['email'] = 'Такой пользователь не найден';
                }
            }

    }
}

$page_content = include_template('login_template.php', ['categories' => $categories, 'errors' => $errors]);

$layout_content = include_template('layout.php', [
    'content' => $page_content,
    'categories' => $categories,
    'title' => 'Страница авторизации',
    'is_auth' => $is_auth,
    'user_name' => $user_name
]);

print($layout_content);
