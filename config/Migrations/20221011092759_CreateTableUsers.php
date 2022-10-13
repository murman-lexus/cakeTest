<?php

use Migrations\AbstractMigration;

class CreateTableUsers extends AbstractMigration
{
    public function up()
    {
        $users = $this->table('users');
        $users
            ->addColumn('firstname', 'string', ['null' => false])
            ->addColumn('lastname', 'string', ['null' => false])
            ->addColumn('email', 'string', ['null' => false])
            ->addColumn('password', 'string', ['null' => false])
            ->save()
        ;
    }

    public function down()
    {
        $this->table('users')->drop()->save();
    }
}
