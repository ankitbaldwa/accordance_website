<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * PackageBenefits Controller
 *
 * @method \App\Model\Entity\PackageBenefit[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PackageBenefitsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $packageBenefits = $this->paginate($this->PackageBenefits);

        $this->set(compact('packageBenefits'));
    }

    /**
     * View method
     *
     * @param string|null $id Package Benefit id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $packageBenefit = $this->PackageBenefits->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('packageBenefit'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $packageBenefit = $this->PackageBenefits->newEmptyEntity();
        if ($this->request->is('post')) {
            $packageBenefit = $this->PackageBenefits->patchEntity($packageBenefit, $this->request->getData());
            if ($this->PackageBenefits->save($packageBenefit)) {
                $this->Flash->success(__('The package benefit has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The package benefit could not be saved. Please, try again.'));
        }
        $this->set(compact('packageBenefit'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Package Benefit id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $packageBenefit = $this->PackageBenefits->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $packageBenefit = $this->PackageBenefits->patchEntity($packageBenefit, $this->request->getData());
            if ($this->PackageBenefits->save($packageBenefit)) {
                $this->Flash->success(__('The package benefit has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The package benefit could not be saved. Please, try again.'));
        }
        $this->set(compact('packageBenefit'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Package Benefit id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $packageBenefit = $this->PackageBenefits->get($id);
        if ($this->PackageBenefits->delete($packageBenefit)) {
            $this->Flash->success(__('The package benefit has been deleted.'));
        } else {
            $this->Flash->error(__('The package benefit could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
