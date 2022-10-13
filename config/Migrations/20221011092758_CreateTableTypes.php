<?php

use Migrations\AbstractMigration;

class CreateTableTypes extends AbstractMigration
{
    public function up()
    {
        $table = $this->table('types');
        $table
            ->addColumn('label', 'string', ['null' => false])
            ->save()
        ;

    }

    public function down()
    {
        $this->table('types')->drop()->save();
    }

}
