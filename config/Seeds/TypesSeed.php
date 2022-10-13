<?php

use Migrations\AbstractSeed;

/**
 * Types seed.
 */
class TypesSeed extends AbstractSeed
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
        $data = [
            [
                'label'=>'Срочный баг',
            ],
            [
                'label'=>'Несрочный баг',
            ],
            [
                'label'=>'Незначительное улучшение',
            ],
        ];
        $table = $this->table('types');
        $table->insert($data)->save();
    }
}
