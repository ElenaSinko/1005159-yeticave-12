<?php
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

//        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
////Проверка, что все поля заполнены
//            $required_fields = ['lot-name', 'message', 'lot-rate', 'lot-step', 'lot-date'];
//            foreach ($required_fields as $val) {
//                if(empty($_POST[$val])) {
//                    $errors[$val] = 'Поле не заполнено';
//                }
//            }
//            if($_POST['category'] == 0) {
//                $errors['category'] = 'Поле не заполнено';
//            }
//
////Проверка валидации конкретных полей
//            if(!filter_input(INPUT_POST, 'lot-rate', FILTER_VALIDATE_FLOAT, ["options" => ["min_range" => 0]])) {
//                $errors['lot-rate'] = 'Цена должна быть больше нуля';
//            }
//            if(!filter_input(INPUT_POST, 'lot-step', FILTER_VALIDATE_INT, ["options" => ["min_range" => 0]])) {
//                $errors['lot-step'] = 'Шаг ставки должен быть больше нуля';
//            }
//            if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $_POST['lot-date'])) {
//                $errors['lot-date'] = 'Дата должна быть записана в формате: ГГГГ-ММ-ДД';
//            }
//            if (!validate_lot_date($_POST['lot-date'])) {
//                $errors['lot-date'] = 'Торги могут быть завершены не ранее, чем через один день';
//            }
//
////Данные лота
//            $lot = $_POST;
//
//            if(!empty($_FILES['lot-img']['name'])) {
//                $allowed_types = ['image/jpeg','image/png','image/gif'];
//                $img_name = stristr($_FILES['lot-img']['name'], '.', true);
//                $img_extension = stristr($_FILES['lot-img']['name'], '.');
//                $img_name = translate($img_name);
//                $_FILES['lot-img']['name'] = $img_name . $img_extension;
////                $_FILES['lot-img']['name'] = translate( $_FILES['lot-img']['name']);
//                $file_name = uniqid() . $_FILES['lot-img']['name'];
//                $file_path = __DIR__ . '/uploads/';
//                $file_url = '/uploads/' . $file_name;
//                $file_type = mime_content_type($_FILES['lot-img']['tmp_name']);
//                if(!($file_type == 'image/png' || $file_type == 'image/jpeg' || $file_type == 'image/jpg')) {
//                    $errors['lot-img'] = 'Изображение может быть только PNG, JPEG или JPG форматов';
//                } else {
//                    if(move_uploaded_file($_FILES['lot-img']['tmp_name'], $file_path . $file_name)) {
//                        $lot['img'] = 'uploads/' . $file_name;
//                    } else {
//                        echo "Ошибка";
//                    }
//                }
//
//            } else {
//                $errors['lot-img'] = 'Загрузите, пожалуйста, фотографию';
//            }
//
//            if(count($errors) === 0) {
//                $sql = 'INSERT INTO lots(userID, title, categoryID, description, img, base_price, step_price, closing_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
//                $stmt = mysqli_prepare($link, $sql);
//                $userID = 1;
//                mysqli_stmt_bind_param($stmt, 'isissiis', $userID, $lot['lot-name'], $lot['category'], $lot['message'], $img = $lot['img'], $lot['lot-rate'], $lot['lot-step'],  $lot['lot-date']);
//                $res = mysqli_stmt_execute($stmt);
//                if ($res) {
//                    $lot_id = mysqli_insert_id($link);
//                    header("Location: lot.php?id=" . $lot_id);
//                } else {
//                    $content = include_template('error.php', ['error' => mysqli_error($link)]);
//                }
//
//            }
//        }
    }
    else {
        $error = mysqli_error($link);
        $page_content = include_template('error.php');
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
