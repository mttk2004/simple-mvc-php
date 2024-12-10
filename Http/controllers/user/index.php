<?php

use Models\User;

$db = resolveDatabase();

$userData = $db->query('SELECT * FROM users')->findAll();
$users = [];

foreach ($userData as $data) {
    $users[] = new User($data['id'], $data['name'], $data['email'], $data['password']);
}

view('users/index', compact('users'));
