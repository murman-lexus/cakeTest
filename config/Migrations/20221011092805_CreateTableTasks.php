<?php

use Migrations\AbstractMigration;

class CreateTableTasks extends AbstractMigration
{
    public function up()
    {
        $tasks = $this->table('tasks');
        $tasks
            ->addColumn('label', 'string', ['null' => false])
            ->addColumn('description', 'text', ['null' => true])
            ->addColumn('comment', 'string', ['null' => true])
            ->addColumn('type_id', 'integer', ['null' => false])
            ->addForeignKey('type_id', 'types', 'id', ['delete'=> 'RESTRICT', 'update'=> 'NO_ACTION'])
            ->addColumn('author_id', 'integer', ['null' => false])
            ->addForeignKey('author_id', 'users', 'id', ['delete'=> 'RESTRICT', 'update'=> 'NO_ACTION'])
            ->addColumn('executor_id', 'integer', ['null' => true])
            ->addForeignKey('executor_id', 'users', 'id', ['delete'=> 'RESTRICT', 'update'=> 'NO_ACTION'])
            ->addColumn('status_id', 'integer', ['null' => false])
            ->addForeignKey('status_id', 'statuses', 'id', ['delete'=> 'RESTRICT', 'update'=> 'NO_ACTION'])
            ->addTimestamps()
            ->save()
        ;

    }

    public function down()
    {
        $this->table('tasks')->drop()->save();
    }
}
