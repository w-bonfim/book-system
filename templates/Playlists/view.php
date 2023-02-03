<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Playlist $playlist
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Ações') ?></h4>
            <?= $this->Html->link(__('Atualizar Playlist'), ['action' => 'edit', $playlist->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Deletar Playlist'), ['action' => 'delete', $playlist->id], ['confirm' => __('Tem certeza de que deseja excluir?', $playlist->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Lista da Playlists'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Nova Playlist'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="playlists view content">
            <h3><?= h($playlist->title) ?></h3>
            <table>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($playlist->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Título') ?></th>
                    <td><?= h($playlist->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Descrição') ?></th>
                    <td><?= h($playlist->description) ?></td>
                </tr>
                <tr>
                    <th><?= __('Autor') ?></th>
                    <td><?= h($playlist->author) ?></td>
                </tr>
                <tr>
                    <th><?= __('Criado em') ?></th>
                    <td><?= h($playlist->created_at) ?></td>
                </tr>
                <tr>
                    <th><?= __('Atualizado em') ?></th>
                    <td><?= h($playlist->updated_at) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Conteúdos relacionados') ?></h4>
                <?php if (!empty($playlist->contents)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Título') ?></th>
                            <th><?= __('URL') ?></th>
                            <th><?= __('Autor') ?></th>
                            
                            <th class="actions" colspan="3"><?= __('Ações') ?></th>
                        </tr>
                        <?php foreach ($playlist->contents as $contents) : ?>
                        <tr>
                            <td><?= h($contents->id) ?></td>
                            <td><?= h($contents->title) ?></td>
                            <td><?= h($contents->url) ?></td>
                            <td><?= h($contents->author) ?></td>
                           
                            <td class="actions">
                                <?= $this->Html->link(__('Visualizar'), ['controller' => 'Contents', 'action' => 'view', $contents->id], array('class' => 'btn-success')) ?>
                            </td>  
                            <td class="actions">
                                <?= $this->Html->link(__('Atualizar'), ['controller' => 'Contents', 'action' => 'edit', $contents->id], array('class' => 'btn-warning')) ?>
                            </td>
                            <td class="actions">
                                <?= $this->Form->postLink(__('Deletar'), ['controller' => 'Contents', 'action' => 'delete', $contents->id], array('class' => 'btn-danger'), ['confirm' => __('Tem certeza de que deseja excluir?', $contents->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
