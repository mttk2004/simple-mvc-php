<?php

use Core\Session;

$user = Session::get('user');

view('home', [
    'user' => $user
]);
