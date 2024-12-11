<?php

use Models\User;

$db = resolveDatabase();

$userData = $db->query('SELECT * FROM users')->findAll();
$users = [];


foreach ($userData as $data) {
    $users[] = new User($data['id'], $data['name'], $data['email'], $data['password']);
}

//view('users/index', ['users' => $users]);
$twig = require_once BASE_PATH . 'config/twig.php';
// dd($twig);
echo $twig->render('users/index.html.twig', ['users' => $userData]);
