<?php

namespace Http\Controllers;

class CommonController
{
    public function index(): void
    {
        view('home', []);
    }

    public function about(): void
    {
        view('about', []);
    }
}
