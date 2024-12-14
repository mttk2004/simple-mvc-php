<?php

namespace Http\Controllers;

use Http\Models\User;

class UserController
{
    public function index(): void
    {
        $db = resolveDatabase();
        $userData = $db->select('users', '*');
        $users = [];

        foreach ($userData as $data) {
            $users[] = new User($data['id'], $data['name'], $data['email'], $data['password']);
        }

        view('users/index', ['users' => $users]);
    }
}