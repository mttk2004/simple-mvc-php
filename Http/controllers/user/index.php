<?php

$db = resolveDatabase();

$users = $db->query('SELECT * FROM user')->findAll();
dd($users);
