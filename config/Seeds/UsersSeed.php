<?php

use Authentication\PasswordHasher\DefaultPasswordHasher;
use Migrations\AbstractSeed;

/**
 * Users seed.
 */
class UsersSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $hasher = new DefaultPasswordHasher();

        $data = [
            [
                'firstname'=>'Иван',
                'lastname'=>'Иванов',
                'email'=>'ivanov@mail.ru',
                'password'=>$hasher->hash('ivanov'),
            ],
            [
                'firstname'=>'Петр',
                'lastname'=>'Петров',
                'email'=>'petrov@mail.ru',
                'password'=>$hasher->hash('petrov'),
            ],
            [
                'firstname'=>'Сидор',
                'lastname'=>'Сидоров',
                'email'=>'sidorov@mail.ru',
                'password'=>$hasher->hash('sidorov'),
            ],
        ];

        $table = $this->table('users');
        $table->insert($data)->save();
    }
}
