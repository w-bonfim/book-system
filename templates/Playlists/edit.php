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
            <?= $this->Form->postLink(
                __('Deletar'),
                ['action' => 'delete', $playlist->id],
                ['confirm' => __('Tem certeza de que deseja excluir?', $playlist->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('Lista da Playlists'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="playlists form content">
            <?= $this->Form->create($playlist, ['id' => 'form']) ?>
            <fieldset>
                <legend><?= __('Atualizar Playlist') ?></legend>
                <?php
                    echo $this->Form->control('title', ['label' => 'Tìtulo']);
                    echo $this->Form->control('description', ['label' => 'Descrição']);
                    echo $this->Form->control('author', ['label' => 'Autor']);
                ?>
            </fieldset>
            <button type="button" class="btn-action">Salvar</button>
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
                    window.location.href = "<?= $this->Url->build(['controller' => 'Playlists', 'action' => 'index']) ?>"
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