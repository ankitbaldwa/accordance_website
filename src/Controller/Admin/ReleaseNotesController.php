<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * ReleaseNotes Controller
 *
 * @method \App\Model\Entity\ReleaseNote[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ReleaseNotesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $releaseNotes = $this->paginate($this->ReleaseNotes);

        $this->set(compact('releaseNotes'));
    }

    /**
     * View method
     *
     * @param string|null $id Release Note id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $releaseNote = $this->ReleaseNotes->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('releaseNote'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $releaseNote = $this->ReleaseNotes->newEmptyEntity();
        if ($this->request->is('post')) {
            $releaseNote = $this->ReleaseNotes->patchEntity($releaseNote, $this->request->getData());
            if ($this->ReleaseNotes->save($releaseNote)) {
                $this->Flash->success(__('The release note has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The release note could not be saved. Please, try again.'));
        }
        $this->set(compact('releaseNote'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Release Note id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $releaseNote = $this->ReleaseNotes->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $releaseNote = $this->ReleaseNotes->patchEntity($releaseNote, $this->request->getData());
            if ($this->ReleaseNotes->save($releaseNote)) {
                $this->Flash->success(__('The release note has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The release note could not be saved. Please, try again.'));
        }
        $this->set(compact('releaseNote'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Release Note id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $releaseNote = $this->ReleaseNotes->get($id);
        if ($this->ReleaseNotes->delete($releaseNote)) {
            $this->Flash->success(__('The release note has been deleted.'));
        } else {
            $this->Flash->error(__('The release note could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
