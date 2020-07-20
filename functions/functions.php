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
