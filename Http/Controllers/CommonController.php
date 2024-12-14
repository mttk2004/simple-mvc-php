<?php

namespace Http\Controllers;

use Core\Session;

class CommonController
{
    public function home(): void
    {
        $user = Session::get('user');
        view('home', ['user' => $user]);
    }

    public function about(): void
    {
        view('about', []);
    }
}
