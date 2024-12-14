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
        view('login', []);
    }

    #[NoReturn] public function store(): void
    {
        // 1. get the data from the form
        $email = $_POST['email'];
        $password = $_POST['password'];

        // 2. validate the data
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

        // 3. check if the user exists
        $user = User::findByEmail($email);

        if (!$user) {
            Session::flash('errors', [
                    'email' => 'User not found'
            ]);
            Session::flash('old', ['email' => $email]);
            redirect('/login');
        }

        // 4. check if the password is correct
        if (!password_verify($password, $user->getPassword())) {
            Session::flash('errors', [
                    'password' => 'Password is incorrect'
            ]);
            Session::flash('old', ['email' => $email]);
            redirect('/login');
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
