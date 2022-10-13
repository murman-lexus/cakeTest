<?php
namespace App\Test\TestCase\Controller;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\UsersController Test Case
 *
 * @uses \App\Controller\UsersController
 */
class UsersControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Users',
    ];

    public function testAuth()
    {
        $this->get('/users/login');
        $this->assertResponseOk();
        $this->get('/users/');
        $this->assertRedirect('/users/login?redirect=%2Fusers%2F');

        $this->login();
        $this->get('/users/');
        $this->assertResponseOk();
    }

    protected function login($userId = 1)
    {
        $users = TableRegistry::getTableLocator()->get('Users');
        $user = $users->get($userId);
        $this->session(['Auth' => $user]);
    }
}
