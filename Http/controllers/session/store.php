<?php

use Core\Session;
use Respect\Validation\Validator as v;

// get the data from the form
$email = $_POST['email'];
$password = $_POST['password'];

// validate the data
$emailValidator = v::email();
$passwordValidator = v::stringType()->length(8, 32);

if (!$emailValidator->validate($email) || !$passwordValidator->validate($password)) {
    Session::flash('errors', [
        'email' => 'Email is invalid',
        'password' => 'Password is invalid'
    ]);
    return redirect('/login');
}

// check if the user exists
$db = resolveDatabase();
$user = $db->query('SELECT * FROM users WHERE email = :email', [
    'email' => $email
])->find();

if (!$user) {
    Session::flash('errors', [
        'email' => 'User not found'
    ]);
    return redirect('/login');
}

// check if the password is correct
if (!password_verify($password, $user['password'])) {
    Session::flash('errors', [
        'password' => 'Password is incorrect'
    ]);
    return redirect('/login');
}

// login the user
Session::set('user', $user);
return redirect('/');
