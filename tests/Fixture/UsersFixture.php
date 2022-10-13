<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 */
class UsersFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'null' => false],
        'firstname' => ['type' => 'string', 'length' => 255, 'null' => false],
        'lastname' => ['type' => 'string', 'length' => 255, 'null' => false],
        'username' => ['type' => 'string', 'length' => 255, 'null' => false],
        'email' => ['type' => 'string', 'length' => 255, 'null' => false],
        'password' => ['type' => 'string', 'length' => 255, 'null' => false],
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
                    'firstname' => 'firstname'.$i,
                    'lastname' => 'lastname'.$i,
                    'username' => 'username'.$i,
                    'email' => 'email'.$i,
                    'password' => 'password'.$i,
                ];
        }

        parent::init();
    }
}
