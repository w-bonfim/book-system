<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Playlist Controller
 *
 * @method \App\Model\Entity\Playlist[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PlaylistsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {   
        if ($this->request->getData('p')) {
            $playlists = $this->Playlists->find('all');

            $limit = 10;
            $pages = $playlists->count() > $limit ? ($playlists->count() / $limit) : 1;
            $pagination = $this->paginate($playlists, ['limit' => $limit]);
            $response = ['playlists' => $pagination, 'pages' => $pages];

            return $this->response->withStatus(200)
                        ->withType('json')
                        ->withStringBody(json_encode($response));
        } 
        
        return $this->render('/Playlists/index');
    }

    /**
     * View method
     *
     * @param string|null $id Playlist id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $playlist = $this->Playlists->get($id, [
            'contain' => ['Contents']
        ]);

        $this->set(compact('playlist'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $playlist = $this->Playlists->newEmptyEntity();
        if ($this->request->is('post')) {
            $playlist = $this->Playlists->patchEntity($playlist, $this->request->getData());

            $playlist->created_at = new \DateTime();
            $playlist->updated_at = new \DateTime();

            if ($this->Playlists->save($playlist)) {
                $response = ['status' => true, 'message' =>'Playlist salva com sucesso'];
            } else {
                $response = ['status' => false, 'message' => 'A Playlist não foi salva. Por favor, tente novamente.'];
            }
    
            return $this->response->withStatus(200)
                        ->withType('json')
                        ->withStringBody(json_encode($response));
        }

        $this->set(compact('playlist'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Playlist id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $playlist = $this->Playlists->get($id, [
            'contain' => [],
        ]);
  
        if ($this->request->is(['patch', 'post', 'put'])) {
            $playlist = $this->Playlists->patchEntity($playlist, $this->request->getData());

            $playlist->updated_at = new \DateTime();
            
            if ($this->Playlists->save($playlist)) {
                $response = ['status' => true, 'message' =>'Playlist salva com sucesso'];
            } else {
                $response = ['status' => false, 'message' => 'A Playlist não foi salva. Por favor, tente novamente.'];
            }

            return $this->response->withStatus(200)
                        ->withType('json')
                        ->withStringBody(json_encode($response));
           
        }

        $this->set(compact('playlist'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Playlist id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        
        $playlist = $this->Playlists->get($id, [
            'contain' => ['Contents'],
        ]);
    
        $list_content = '';
        if (count($playlist->contents) > 0 ) {
            foreach ($playlist->contents as $key => $content) {
                if ($key == 0) {
                    $list_content .= $content->title;
                } else {
                    $list_content .= ', ' . $content->title;
                }
            }

            if ($list_content) {
                $this->Flash->error(__("A Playlist não pode ser excluída. Por favor, desvincule a playlist dos conteúdos: {$list_content}")); 
            }

        } else {
            if ($this->Playlists->delete($playlist)) {
                $this->Flash->success(__('Playlist deletada com sucesso'));
            } else {
                $this->Flash->error(__('A Playlist não pode ser excluída. Por favor, tente novamente.'));
            }
        }
     
        return $this->redirect(['action' => 'index']);
    }
}
