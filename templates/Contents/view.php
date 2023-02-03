<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Content $content
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Ações') ?></h4>
            <?= $this->Html->link(__('Atualizar Conteúdo'), ['action' => 'edit', $content->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Deletar Conteúdo'), ['action' => 'delete', $content->id], ['confirm' => __('Tem certeza de que deseja excluir?', $content->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Lista de Conteúdo'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('Novo Conteúdo'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="contents view content">
            <h3><?= h($content->title) ?></h3>
            <table>
                <tr>
                    <th><?= __('Playlist') ?></th>
                    <td><?= $content->has('playlist') ? $this->Html->link($content->playlist->title, ['controller' => 'Playlists', 'action' => 'view', $content->playlist->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Título') ?></th>
                    <td><?= h($content->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('URL') ?></th>
                    <td><?= h($content->url) ?></td>
                </tr>
                <tr>
                    <th><?= __('Autor') ?></th>
                    <td><?= h($content->author) ?></td>
                </tr>
                <tr>
                    <th><?= __('ID') ?></th>
                    <td><?= $this->Number->format($content->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Criado em') ?></th>
                    <td><?= h($content->created_at) ?></td>
                </tr>
                <tr>
                    <th><?= __('Atualizado em') ?></th>
                    <td><?= h($content->updated_at) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
