<?php

use Core\Session;

$errors = Session::getFlash('errors');
$old = Session::getFlash('old');

view('login', ['errors' => $errors, 'old' => $old]);

Session::unFlash();
