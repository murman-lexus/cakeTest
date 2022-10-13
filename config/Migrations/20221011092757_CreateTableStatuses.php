<?php

use Migrations\AbstractMigration;

class CreateTableStatuses extends AbstractMigration
{
    public function up()
    {
        $table = $this->table('statuses');
        $table
            ->addColumn('label', 'string', ['null' => false])
            ->addColumn('is_allowed_no_executor', 'boolean', ['default' => true])
            ->save()
        ;
    }

    public function down()
    {
        $this->table('statuses')->drop()->save();
    }
}
