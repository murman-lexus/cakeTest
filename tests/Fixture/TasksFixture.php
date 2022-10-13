<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TasksFixture
 */
class TasksFixture extends TestFixture
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
        'description' => ['type' => 'text'],
        'comment' => ['type' => 'string', 'length' => 255],
        'type_id' => ['type' => 'integer', 'null' => false],
        'author_id' => ['type' => 'integer', 'null' => false],
        'executor_id' => ['type' => 'integer'],
        'status_id' => ['type' => 'integer', 'null' => false],
        'created_at' => ['type' => 'timestamp', 'null' => false, 'default' => 'CURRENT_TIMESTAMP'],
        'updated_at' => ['type' => 'timestamp'],
        '_indexes' => [
            'type_id' => ['type' => 'index', 'columns' => ['type_id']],
            'author_id' => ['type' => 'index', 'columns' => ['author_id']],
            'executor_id' => ['type' => 'index', 'columns' => ['executor_id']],
            'status_id' => ['type' => 'index', 'columns' => ['status_id']],
        ],
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
        $this->records = [
            [
                'id' => 1,
                'label' => 'label1',
                'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'comment' => 'Lorem ipsum dolor sit amet',
                'type_id' => 1,
                'author_id' => 1,
                'executor_id' => 1,
                'status_id' => 1,
                'created_at' => 1665664997,
                'updated_at' => 1665664997,
            ],
            [
                'id' => 2,
                'label' => 'label2',
                'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'comment' => 'Lorem ipsum dolor sit amet',
                'type_id' => 1,
                'author_id' => 1,
                'executor_id' => 2,
                'status_id' => 1,
                'created_at' => 1665664997,
                'updated_at' => 1665664997,
            ],
            [
                'id' => 3,
                'label' => 'label3',
                'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'comment' => 'Lorem ipsum dolor sit amet',
                'type_id' => 1,
                'author_id' => 1,
                'executor_id' => null,
                'status_id' => 1,
                'created_at' => 1665664997,
                'updated_at' => 1665664997,
            ],
            [
                'id' => 4,
                'label' => 'label4',
                'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'comment' => 'Lorem ipsum dolor sit amet',
                'type_id' => 1,
                'author_id' => 2,
                'executor_id' => 2,
                'status_id' => 1,
                'created_at' => 1665664997,
                'updated_at' => 1665664997,
            ],
        ];
        parent::init();
    }
}
