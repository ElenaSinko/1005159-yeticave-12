<?php

function validateEmail ($email) {
    return filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
}
