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

        $dateTime = new FrozenTime();
        $this->post($addUrl, $data);
        $this->assertResponseSuccess();
        $this->assertRedirect('/tasks');
        $tasksTable = TableRegistry::getTableLocator()->get('Tasks');
        $query = $tasksTable->find()->where(['label' => $data['label']]);
        $this->assertEquals(1, $query->count());
        /** @var $task Task */
        $task = $query->toArray()[0];

        // проверим, что все переданные данные сохранились
        foreach( $data as $key=>$value){
            $this->assertEquals($value, $task->$key);
        }

        // проверим, что подставилась дата создания и обновления
        $this->assertGreaterThanOrEqual($dateTime->format('Y-m-d H:i:s'), $task->created_at->format('Y-m-d H:i:s'));
        $this->assertGreaterThanOrEqual($dateTime->format('Y-m-d H:i:s'), $task->updated_at->format('Y-m-d H:i:s'));

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

        $tasksTable = TableRegistry::getTableLocator()->get('Tasks');
        $usersTable = TableRegistry::getTableLocator()->get('Users');
        $users = $usersTable->find();

        foreach ($users as $user){
            $userId = $user->id;
            $this->login($userId);

            $allowedTasks = $tasksTable->find()->where(['OR' => [['author_id' => $userId], ['executor_id' => $userId]]]);
            foreach ($allowedTasks as $allowedTask) {
                $this->get($editUrl.$allowedTask->id);
                $this->assertResponseOk();
            }

            $forbiddenTasks = $tasksTable->find()
                ->where(['tasks.author_id != :author_id AND tasks.executor_id != :executor_id'])
                ->bind(':author_id', $userId, 'integer')
                ->bind(':executor_id', $userId, 'integer')
            ;
            foreach ($forbiddenTasks as $forbiddenTask) {
                $this->get($editUrl.$forbiddenTask->id);
                $this->assertResponseCode(403);
                $this->assertResponseContains('Forbidden');
            }
        }
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $deleteUrl = '/tasks/delete/';

        $tasksTable = TableRegistry::getTableLocator()->get('Tasks');
        $usersTable = TableRegistry::getTableLocator()->get('Users');
        $users = $usersTable->find();
        $this->enableCsrfToken();
        $this->enableSecurityToken();
        foreach ($users as $user){
            $userId = $user->id;
            $this->login($userId);

            $allowedTasks = $tasksTable->find()->where(['author_id' => $userId]);
            foreach ($allowedTasks as $allowedTask) {
                $this->delete($deleteUrl.$allowedTask->id);
                $this->assertResponseSuccess();
                $this->assertRedirect('/tasks');
            }

            $forbiddenTasks = $tasksTable->find()->where(['NOT' => ['author_id' => $userId]]);
            foreach ($forbiddenTasks as $forbiddenTask) {
                $this->delete($deleteUrl.$forbiddenTask->id);
                $this->assertResponseCode(403);
                $this->assertResponseContains('Forbidden');
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
