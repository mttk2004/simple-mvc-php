<?php

use Core\Session;
use Respect\Validation\Validator as v;
use League\Event\EventDispatcher;
use Events\UserLoggedIn;
use Listeners\UserLoggedInListener;

/**
 * 1. get the data from the form
 * 2. validate the data
 * 3. check if the user exists
 * 4. check if the password is correct
 * 5. login the user
 * 6. emit the UserLoggedIn event
 * 7. redirect to the home page
 */

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
    Session::flash('old', ['email' => $email]);
    redirect('/login');
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
    Session::flash('old', ['email' => $email]);
    redirect('/login');
}

// check if the password is correct
if (!password_verify($password, $user['password'])) {
    Session::flash('errors', [
        'password' => 'Password is incorrect'
    ]);
    Session::flash('old', ['email' => $email]);
    redirect('/login');
}

// login the user
Session::set('user', $user);

// Khởi tạo EventDispatcher
$dispatcher = new EventDispatcher();

// Khởi tạo Logger
$logger = require BASE_PATH . 'config/logger.php';

// Đăng ký Listener với Logger
$dispatcher->subscribeTo(UserLoggedIn::class, new UserLoggedInListener($logger));

// Kích hoạt sự kiện sau khi người dùng đăng nhập thành công
$dispatcher->dispatch(new UserLoggedIn($user['id']));

redirect('/');
