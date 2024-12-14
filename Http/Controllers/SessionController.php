<?php

namespace Http\Controllers;

use Core\Session;
use Http\Events\UserLoggedIn;
use Http\Listeners\UserLoggedInListener;
use Http\Models\User;
use Http\Validators\Form;
use League\Event\EventDispatcher;
use JetBrains\PhpStorm\NoReturn;

class SessionController
{
    public function create(): void
    {
        $old = Session::getFlash('old');
        $errors = Session::getFlash('errors');

        view('login', ['old' => $old, 'errors' => $errors]);

        Session::unFlash();
    }

    #[NoReturn] public function store(): void
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // 1. Validate the input
        $errors = Form::validateLoginForm($_POST);
        if (count($errors)) {
            flashAndRedirect($errors, ['email' => $email], '/login');
        }

        // 2. Find the user
        $user = User::findByEmail($email);
        if (!$user) {
            flashAndRedirect(['email' => 'User not found'], ['email' => $email], '/login');
        }

        // 3. Check the password
        if (!password_verify($password, $user->getPassword())) {
            flashAndRedirect(['password' => 'Password is incorrect'], ['email' => $email], '/login');
        }

        // 4. Perform the event
        $dispatcher = new EventDispatcher(); // Khởi tạo EventDispatcher

        $logger = resolveLogger('user_logged_in'); // Khởi tạo Logger

        // Đăng ký Listener với Logger
        $dispatcher->subscribeTo(UserLoggedIn::class, new UserLoggedInListener($logger));

        // Kích hoạt sự kiện sau khi người dùng đăng nhập thành công
        $dispatcher->dispatch(new UserLoggedIn($user->getId()));

        // 5. Set the user in the session and redirect to the home page
        Session::set('user', $user);
        redirect('/');
    }

    #[NoReturn] public function destroy(): void
    {
        Session::destroy();

        redirect('/');
    }
}
