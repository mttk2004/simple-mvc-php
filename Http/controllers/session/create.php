<?php

use Core\Session;

// check if there are any errors in the flash session
$errors = Session::getFlash('errors');

view('login', [
    'errors' => $errors
]);
