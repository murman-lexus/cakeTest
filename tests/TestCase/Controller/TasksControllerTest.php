<?php

namespace App\Test\TestCase\Controller;

use App\Model\Entity\Task;
use Cake\I18n\FrozenTime;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\TasksController Test Case
 *
 * @uses \App\Controller\TasksController
 */
class TasksControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Tasks',
        'app.Types',
        'app.Statuses',
        'app.Users',
    ];

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $addUrl = '/tasks/add';

        $userId = 1;
        $this->login($userId);
        $this->get($addUrl);
        $this->assertResponseOk();
        $data = [
            'label' => 'tasklabel1',
            'description' => 'taskdescription1',
            'comment' => 'taskcomment1',
            'status_id' => 1,
            'type_id' => 1,
        ];
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        $testNow = '2022-01-01 07:00:00';
        FrozenTime::setTestNow($testNow);

        $this->post($addUrl, $data);
        $this->assertResponseSuccess();
        $this->assertRedirect('/tasks');
        $tasksTable = TableRegistry::getTableLocator()->get('Tasks');
        $query = $tasksTable->find()->where(['label' => $data['label']]);
        $this->assertEquals(1, $query->count());
        /** @var $task Task */
        $task = $query->toArray()[0];

        // проверим, что все переданные данные сохранились
        foreach ($data as $key => $value) {
            $this->assertEquals($value, $task->$key);
        }

        // проверим, что подставилась дата создания и обновления
        $this->assertEquals($testNow, $task->created_at->toDateTimeString());
        $this->assertEquals($testNow, $task->updated_at->toDateTimeString());

        // проверим, что пользователь подставился как автор.
        $this->assertEquals($userId, $task->author_id, 'Incorrect Author autoselect');
    }


    /**
     * Test add method
     *
     * @return void
     */
    public function testAddWithStatusExecutorValidation()
    {
        $addUrl = '/tasks/add';
        $this->login();
        $this->get($addUrl);
        $this->assertResponseOk();
        $data = [
            'label' => 'tasklabel2',
            'status_id' => 2,    // статуc для которого обязательно налачие исполнителя
            'type_id'   => 1,
        ];
        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $this->post($addUrl, $data);
        $this->assertResponseSuccess();
        $this->assertNoRedirect();
        $tasksTable = TableRegistry::getTableLocator()->get('Tasks');
        $query = $tasksTable->find()->where(['label' => $data['label']]);
        $this->assertEquals(0, $query->count());

        // добавим в данные исполнителя
        $data['executor_id'] = 2;

        $this->post($addUrl, $data);
        $this->assertResponseSuccess();
        $this->assertRedirect('/tasks');
        $query = $tasksTable->find()->where(['label' => $data['label']]);
        $this->assertEquals(1, $query->count());
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $editUrl = '/tasks/edit/';

        $usersTable = TableRegistry::getTableLocator()->get('Users');
        $tasksTable = TableRegistry::getTableLocator()->get('Tasks');
        $users = $usersTable->find();

        foreach ($users as $user) {
            $userId = $user->id;
            $this->login($userId);

            $tasks = $tasksTable->find();
            foreach ($tasks as $task) {
                $this->get($editUrl . $task->id);
                if ($task->author_id === $userId || $task->executor_id === $userId) {
                    $this->assertResponseOk();
                } else {
                    $this->assertResponseCode(403);
                    $this->assertResponseContains('Forbidden');
                }

            }
        }
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEditChangeAuthor()
    {
        $editUrl = '/tasks/edit/';

        $userId = 1;
        $this->login($userId);
        $taskId = 1;

        $tasksTable = TableRegistry::getTableLocator()->get('Tasks');
        /** @var Task $oldTask */
        $oldTask = $tasksTable->get($taskId);
        $data = [
            'label' => 'newlabel',
            'author_id' => 2,
        ];

        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $this->post($editUrl.$taskId, $data);
        $this->assertResponseSuccess();

        $this->assertRedirect('/tasks');
        $this->getTableLocator()->clear();
        /** @var $task Task */
        $tasksTable = TableRegistry::getTableLocator()->get('Tasks');
        $updatedTask = $tasksTable->get($taskId);

        $this->assertEquals($data['label'], $updatedTask->label);
        // проверим, что старое значение сохранилось
        $this->assertEquals($oldTask->author_id, $updatedTask->author_id);
        $this->assertNotEquals($data['author_id'], $updatedTask->author_id);
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $deleteUrl = '/tasks/delete/';

        $usersTable = TableRegistry::getTableLocator()->get('Users');
        $tasksTable = TableRegistry::getTableLocator()->get('Tasks');
        $users = $usersTable->find();
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        foreach ($users as $user) {
            $userId = $user->id;
            $this->login($userId);
            $tasks = $tasksTable->find();
            foreach ($tasks as $task) {
                $this->delete($deleteUrl . $task->id);
                if ($task->author_id === $userId) {
                    $this->assertResponseSuccess();
                    $this->assertRedirect('/tasks');
                } else {
                    $this->assertResponseCode(403);
                    $this->assertResponseContains('Forbidden');
                }
            }
        }
    }

    protected function login($userId = 1)
    {
        $users = TableRegistry::getTableLocator()->get('Users');
        $user = $users->get($userId);
        $this->session(['Auth' => $user]);
    }
}
