<?php

use Phinx\Seed\AbstractSeed;

class UserSeeder extends AbstractSeed
{
    public function run(): void
    {
        $data = [
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => password_hash('password123', PASSWORD_BCRYPT),
            ],
            [
                'name' => 'Jane Doe',
                'email' => 'jane@example.com',
                'password' => password_hash('password123', PASSWORD_BCRYPT),
            ],
        ];

        $this->table('users')->insert($data)->saveData();
    }
} 