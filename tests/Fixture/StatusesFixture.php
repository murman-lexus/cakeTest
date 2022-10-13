<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * StatusesFixture
 */
class StatusesFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer'],
        'label' => ['type' => 'string', 'length' => 255, 'null' => false],
        'is_allowed_no_executor' => ['type' => 'boolean'],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id']],
        ],
    ];
    // @codingStandardsIgnoreEnd
    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [];
        for ($i = 1; $i <= 4; $i++) {
            $this->records[] = [
                'id' => $i,
                'label' => 'label'.$i,
                'is_allowed_no_executor' => $i === 1 || $i === 4,
            ];
        }
        parent::init();
    }
}
