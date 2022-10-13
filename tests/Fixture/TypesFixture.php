<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TypesFixture
 */
class TypesFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'null' => false],
        'label' => ['type' => 'string', 'length' => 255, 'null' => false],
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
        for ($i = 1; $i <= 3; $i++) {
            $this->records[] = [
                'id' => $i,
                'label' => 'label'.$i,
            ];
        }

        parent::init();
    }
}
