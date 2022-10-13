<?php

use Migrations\AbstractSeed;

/**
 * Statuses seed.
 */
class StatusesSeed extends AbstractSeed
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
                'label'=>'Создана',
                'is_allowed_no_executor'=>true,
            ],
            [
                'label'=>'В работе',
                'is_allowed_no_executor'=>false,
            ],
            [
                'label'=>'Выполнена',
                'is_allowed_no_executor'=>false,
            ],
            [
                'label'=>'Отменена',
                'is_allowed_no_executor'=>true,
            ],
        ];

        $table = $this->table('statuses');
        $table->insert($data)->save();
    }
}
