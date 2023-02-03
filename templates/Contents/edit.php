<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Content $content
 * @var string[]|\Cake\Collection\CollectionInterface $playlists
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Ações') ?></h4>
            <?= $this->Form->postLink(
                __('Deletar'),
                ['action' => 'delete', $content->id],
                ['confirm' => __('Tem certeza de que deseja excluir?', $content->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('Lista de Conteúdo'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="contents form content">
            <?= $this->Form->create($content, ['id' => 'form']) ?>
            <fieldset>
                <legend><?= __('Atualizar Conteúdo') ?></legend>
                <?php
                    echo $this->Form->control('playlist_id', ['options' => $playlists]);
                    echo $this->Form->control('title', ['label' => 'Título']);
                    echo $this->Form->control('url', ['label' => 'URL']);
                    echo $this->Form->control('author', ['label' => 'Autor']);
                ?>
            </fieldset>
            <button type="button" class="btn-action">Salvar</button>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.1.js"></script>
<script>
    var token = <?= json_encode($this->request->getAttribute('csrfToken')); ?>
    
    $('.btn-action').on('click', function(e) {
        $('#form').removeAttr('method')
        $('#form input[name="_method"]').remove()
      
        sendForm()
    })
   
    function sendForm() {
        
        $.ajax({
            url: $('#form').attr('action'),
            method: 'PUT',
            dataType: 'json',
            data: $('#form').serialize(),
            beforeSend: function(xhr){
               //loading
            },
            success: function(response) {
                
                if (response.status) {
                    alert(response.message)
                    window.location.href = "<?= $this->Url->build(['controller' => 'Contents', 'action' => 'index']) ?>"
                } else {
                    alert(response.message)
                    window.location.reload()
                }
       
            }, 
            error: function(){

            }
        })
    }
</script>