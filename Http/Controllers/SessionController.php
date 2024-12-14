<?php

namespace Http\Controllers;

use Core\Session;
use Http\Events\UserLoggedIn;
use Http\Listeners\UserLoggedInListener;
use Http\Models\User;
use League\Event\EventDispatcher;
use Respect\Validation\Validator as v;
use JetBrains\PhpStorm\NoReturn;

class SessionController
{
    public function create(): void
    {
        $errors = Session::getFlash('errors');
        $old = Session::getFlash('old');

        view('login', ['errors' => $errors, 'old' => $old]);

        Session::unFlash();
    }

    #[NoReturn] public function store(): void
    {
        // 1. get the data from the form
        $email = $_POST['email'];
        $password = $_POST['password'];

        // 2. validate the data
        $emailValidator = v::email();
        $passwordValidator = v::stringType()->length(8, 32);

        if (!$emailValidator->validate($email)) {
            flashAndRedirect(['email' => 'Email is invalid'], ['email' => $email], '/login');
        }

        if (!$passwordValidator->validate($password)) {
            flashAndRedirect(['password' => 'Password must be between 8 and 32 characters'], ['email' => $email], '/login');
        }

        // 3. check if the user exists
        $user = User::findByEmail($email);

        if (!$user) {
            flashAndRedirect(['email' => 'User not found'], ['email' => $email], '/login');
        }

        // 4. check if the password is correct
        if (!password_verify($password, $user->getPassword())) {
            flashAndRedirect(['password' => 'Password is incorrect'], ['email' => $email], '/login');
        }

        // 5. login the user
        Session::set('user', $user);

        // 6. emit the UserLoggedIn event
        // Khởi tạo EventDispatcher
        $dispatcher = new EventDispatcher();

        // Khởi tạo Logger
        $logger = require BASE_PATH . 'config/logger.php';

        // Đăng ký Listener với Logger
        $dispatcher->subscribeTo(UserLoggedIn::class, new UserLoggedInListener($logger));

        // Kích hoạt sự kiện sau khi người dùng đăng nhập thành công
        $dispatcher->dispatch(new UserLoggedIn($user->getId()));

        // 7. redirect to the home page
        redirect('/');
    }

    #[NoReturn] public function destroy(): void
    {
        Session::destroy();
        redirect('/');
    }
}
