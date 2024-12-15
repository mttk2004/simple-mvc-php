<?php

namespace Http\Controllers;

use Http\Models\User;

class UserController
{
    public function index(): void
    {
        $db = resolveDatabase();
        $userData = $db->select('users', '*', ['ORDER' => ['id' => 'ASC']]);
        $users = [];

        foreach ($userData as $data) {
            $users[] = new User($data['id'], $data['name'], $data['email'], $data['password']);
        }

        view('users/index', ['users' => $users]);
    }

    public function show(array $params): void
    {
        if (!isset($params['id'])) {
            view('errors/500', ['error' => 'User ID not provided']);
            exit();
        }

        $db = resolveDatabase();
        $userData = $db->get('users', '*', ['id' => $params['id']]);

        if (!$userData) {
            view('errors/500', ['error' => 'User not found']);
            exit();
        }

        $user = new User($userData['id'], $userData['name'], $userData['email'], $userData['password']);
        view('users/show', ['user' => $user]);
    }
}
