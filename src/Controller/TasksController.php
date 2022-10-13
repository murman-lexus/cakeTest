<?php

namespace App\Controller;

use Cake\Http\Exception\ForbiddenException;

/**
 * Tasks Controller
 *
 * @property \App\Model\Table\TasksTable $Tasks
 *
 * @method \App\Model\Entity\Task[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TasksController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $user = $this->Authentication->getIdentity()->getOriginalData();

        $this->paginate = [
            'limit' => 5,
            'contain' => [
                'Author',
                'Executor',
                'Types',
                'Statuses'
            ],
        ];
        $tasks = $this->paginate($this->Tasks);
        $this->set(compact('tasks', 'user'));
    }

    /**
     * View method
     *
     * @param string|null $id Task id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $task = $this->Tasks->get($id, [
            'contain' => [
                'Types',
                'Statuses',
                'Author',
                'Executor'
            ],
        ]);
        $this->set('task', $task);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $task = $this->Tasks->newEntity();
        $user = $this->Authentication->getIdentity();

        $task->author_id = $user->id;
        if ($this->request->is('post')) {
            $task = $this->Tasks->patchEntity($task, $this->request->getData());
            if ($this->Tasks->save($task)) {
                $this->Flash->success(__('The task has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The task could not be saved. Please, try again.'));
        }
        $types = $this->Tasks->Types->find()->combine('id', 'label');
        $statuses = $this->Tasks->Statuses->find()->combine('id', 'label');
        $authors = $this->Tasks->Author->find()->combine('id', 'fullname');
        $executors = $this->Tasks->Executor->find()->combine('id', 'fullname');

        $this->set(compact('task', 'authors', 'executors', 'types', 'statuses'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Task id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $task = $this->Tasks->get($id, [
            'contain' => ['Statuses'],
        ]);
        $user = $this->Authentication->getIdentity()->getOriginalData();

        if (!$task->isAllowToEdit($user)){
            throw new ForbiddenException();
        }

        if ($this->request->is([
            'patch',
            'post',
            'put'
        ])) {
            $task = $this->Tasks->patchEntity($task, $this->request->getData());
            if ($this->Tasks->save($task)) {
                $this->Flash->success(__('The task has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The task could not be saved. Please, try again.'));
        }

        $types = $this->Tasks->Types->find()->combine('id', 'label');
        $statuses = $this->Tasks->Statuses->find()->combine('id', 'label');

        $authors = $this->Tasks->Author->find()->combine('id', 'fullname');
        $executors = $this->Tasks->Executor->find()->combine('id', 'fullname');

        $this->set(compact('task', 'authors', 'executors', 'types', 'statuses',));
    }

    /**
     * Delete method
     *
     * @param string|null $id Task id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod([
            'post',
            'delete'
        ]);
        $task = $this->Tasks->get($id);

        $user = $this->Authentication->getIdentity()->getOriginalData();
        if (!$task->isAllowToDelete($user)){
            throw new ForbiddenException();
        }

        if ($this->Tasks->delete($task)) {
            $this->Flash->success(__('The task has been deleted.'));
        } else {
            $this->Flash->error(__('The task could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
