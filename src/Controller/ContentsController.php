<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\ORM\TableRegistry;
/**
 * Content Controller
 *
 * @method \App\Model\Entity\Content[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ContentsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        if ($this->request->getData('p')) {
            $contents = $this->Contents->find('all')->contain(['Playlists']);

            $limit = 10;
            $pages = $contents->count() > $limit ? ($contents->count() / $limit) : 1;
            $pagination = $this->paginate($contents, ['limit' => $limit]);
            $response = ['contents' => $pagination, 'pages' => $pages];

            return $this->response->withStatus(200)
                        ->withType('json')
                        ->withStringBody(json_encode($response));
        }
       
        return $this->render('/Contents/index');
    }

    /**
     * View method
     *
     * @param string|null $id Content id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $content = $this->Contents->get($id, [
            'contain' => ['Playlists'],
        ]);

        $this->set(compact('content'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $content = $this->Contents->newEmptyEntity();
        if ($this->request->is('post')) {
            $content = $this->Contents->patchEntity($content, $this->request->getData());
            $content->created_at = new \DateTime();
            $content->updated_at = new \DateTime();

            if ($this->Contents->save($content)) {
                $response = ['status' => true, 'message' =>'Conteúdo cadastrado com sucesso'];
            } else {
                $response = ['status' => false, 'message' => 'O conteúdo não foi salvo. Por favor, tente novamente.'];
            }

            return $this->response->withStatus(200)
                    ->withType('json')
                    ->withStringBody(json_encode($response));
        }
      
        $playlists = $this->Contents->Playlists->find('list');
          
        $this->set(compact('content', 'playlists'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Content id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $content = $this->Contents->get($id, [
            'contain' => [],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $content = $this->Contents->patchEntity($content, $this->request->getData());
            $content->updated_at = new \DateTime();

            if ($this->Contents->save($content)) {
                $response = ['status' => true, 'message' =>'Conteúdo atualizado com sucesso'];
            } else {
                $response = ['status' => false, 'message' => 'O conteúdo não foi salvo. Por favor, tente novamente.'];
            }

            return $this->response->withStatus(200)
                    ->withType('json')
                    ->withStringBody(json_encode($response));
        }

        $playlists = $this->Contents->Playlists->find('list');

        $this->set(compact('content', 'playlists'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Content id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $content = $this->Contents->get($id);
        if ($this->Contents->delete($content)) {
            $this->Flash->success(__('Conteúdo deletado com sucesso.'));
        } else {
            $this->Flash->error(__('O conteúdo não foi excluído. Por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
