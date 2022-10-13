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

        $this->login();
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
        $articles = TableRegistry::getTableLocator()->get('Tasks');
        $query = $articles->find()->where(['label' => $data['label']]);
        $this->assertEquals(1, $query->count());
        /** @var $task Task */
        $task = $query->toArray()[0];

        // проверим, что все переданные данные сохранились
        foreach( $data as $key=>$value){
            $this->assertEquals($value, $task->$key);
        }

        // проверим, что подставилась дата создания и обновления
        $this->assertEquals($dateTime->format('Y-m-d H:i:s'), $task->created_at->format('Y-m-d H:i:s'));
        $this->assertEquals($dateTime->format('Y-m-d H:i:s'), $task->updated_at->format('Y-m-d H:i:s'));

        // проверим, что пользователь подставился как автор.
        $this->assertEquals(1, $task->author_id, 'Incorrect Author autoselect');
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
        $articles = TableRegistry::getTableLocator()->get('Tasks');
        $query = $articles->find()->where(['label' => $data['label']]);
        $this->assertEquals(0, $query->count());

        // добавим в данные исполнителя
        $data['executor_id'] = 2;

        $this->post($addUrl, $data);
        $this->assertResponseSuccess();
        $this->assertRedirect('/tasks');
        $query = $articles->find()->where(['label' => $data['label']]);
        $this->assertEquals(1, $query->count());
    }

        /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }


    protected function login($userId = 1)
    {
        $users = TableRegistry::getTableLocator()->get('Users');
        $user = $users->get($userId);
        $this->session(['Auth' => $user]);
    }
}
