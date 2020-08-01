<?php

function format_price ($price) {
    $price = ceil($price);
    if ($price >= 1000) {
        $price = number_format($price, 0, '', ' ');
    }

    return $price . " " . "₽";
}

function calculate_time_to_expiration ($date_expiration) {
    $date_expiration = strtotime($date_expiration);
    $current_date = time();
    $diff = $date_expiration - $current_date;
    $hours_expiration = floor($diff / 3600);
    if ($hours_expiration < 10) {
        $hours_expiration = str_pad($hours_expiration, 2, "0", STR_PAD_LEFT);
    };
    $minutes_expiration = floor(($diff % 3600) / 60);

    return [$hours_expiration, $minutes_expiration];
}

function validate_lot_date ($input_date) {
    $input_date = strtotime($input_date);
    $current_date = time();
    $diff = $input_date - $current_date;
    if ($diff < 86400) {
       return false;
    }
    return $input_date;
    return true;
}

function translate($string)
{
    $replace = [
        'а' => 'a', 'б' => 'b',
        'в' => 'v', 'г' => 'g',
        'д' => 'd', 'е' => 'e',
        'ё' => 'yo', 'ж' => 'j',
        'з' => 'z', 'и' => 'i',
        'й' => 'y', 'к' => 'k',
        'л' => 'l', 'м' => 'm',
        'н' => 'n', 'о' => 'o',
        'п' => 'p', 'р' => 'r',
        'с' => 's', 'т' => 't',
        'у' => 'u', 'ф' => 'f',
        'х' => 'h', 'ц' => 'ts',
        'ч' => 'ch', 'ш' => 'sh',
        'щ' => 'sch', 'ъ' => '',
        'ы' => 'i', 'ь' => '',
        'э' => 'e', 'ю' => 'ju',
        'я' => 'ja', ' ' => '-'
    ];
    $string = mb_strtolower($string, 'utf-8');

    $string = strtr($string, $replace);

    return
        preg_replace('~[^a-z\-]~', null, $string);
}

function getPostVal($name) {
    return $_POST[$name] ? $_POST[$name] : "";
}
