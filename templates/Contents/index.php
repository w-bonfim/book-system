<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Content[]|\Cake\Collection\CollectionInterface $contents
 */
?>
<div class="contents index content">
    <?= $this->Html->link(__('Novo Conteúdo'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Conteúdos') ?></h3>
    <div class="table-responsive">
        <table id="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Playlist</th>
                    <!-- <th>URL</th> -->
                    <th>Autor</th>
                    <!-- <th>Criado em</th> -->
                    <!-- <th>Atualizado em</th> -->
                    <th class="actions" colspan="3"><?= __('Ações') ?></th>
                </tr>
            </thead>
            <tbody id="load-contents">
                <!-- Loading contents -->
            </tbody>
        </table>
    </div>

    <ul class="pagination">
        <!-- Loading item -->
    </ul>
    
</div>

<script src="https://code.jquery.com/jquery-3.6.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/paginationjs/2.1.5/pagination.min.js"></script>
<script>
$(document).ready(function () {
    var token = <?= json_encode($this->request->getAttribute('csrfToken')); ?>
    
    loadContents(1)

    function loadContents(n) {
        var load_contents = $('#load-contents')
        var pagination = $('.pagination')

        $.ajax({
            url: "<?= $this->Url->build(['controller' => 'Contents', 'action' => 'index']) ?>?page=" + n,
            method: 'POST',
            dataType: 'json',
            data: {'p': true},
            beforeSend: function(xhr){
                xhr.setRequestHeader(
                    'X-CSRF-Token',
                    token
                )

                load_contents.html('<tr><td colspan="10" class="text-center">Carregando...</td></tr>')
                pagination = $('.pagination').html('')
            },
            success: function(data) {
                var response = data.contents
                var pages = Math.ceil(data.pages)
                load_contents.html('')
                            
                if (response.length > 0 ) {
                    for (var i = 0; i < response.length; i++) {
                        load_contents.append('<tr>' +
                            '<td>' + response[i].id + '</td>' +
                            '<td>' + response[i].title + '</td>' +
                            '<td>' + response[i].playlist.title + '</td>' +
                            //'<td>' + response[i].url + '</td>' +
                            '<td>' + response[i].author + '</td>' +
                            // '<td>' + response[i].created_at + '</td>' +
                            //'<td>' + response[i].updated_at + '</td>' +
                            '<td class="actions">' +
                                '<a href="/contents/view/' + response[i].id + '" class="btn-success">Visualizar</a>' +
                            '</td>' +
                            '<td class="actions">' +
                                '<a href="/contents/edit/' + response[i].id + '" class="btn-warning">Atualizar</a>' +     
                            '</td>' +
                            '<td class="actions">' +                  
                                '<form style="display:none;" id="form-'+ response[i].id +'" method="post" action="/contents/delete/' + response[i].id + '">'+
                                    '<input type="hidden" name="_method" value="POST">' + 
                                    '<input type="hidden" name="_csrfToken" autocomplete="off" value="'+ token +'">' +
                                '</form>' +
                                '<a href="#" class="btn-danger" data-confirm-message="Tem certeza de que deseja excluir?" onclick="if (confirm(this.dataset.confirmMessage)) { document.getElementById(\'form-'+ response[i].id +'\').submit(); } event.returnValue = false; return false;">Deletar</a>' +                             
                            '</td>' +
                        '</tr>')
                    }


                    if (pages > 0 ) {
                        for (var c = 1; c <= pages; c++) {
                            var active = c == n ? 'page-active' : ''
                            pagination.append('<li class="'+ active +'">' + c + '</li>')
                        }
                    }

                    $('.pagination li').on('click', function(e) {
                        var n = $(this).text()
                        loadContents(n)
                    })

                } else {
                    load_contents.html('<tr><td colspan="10" class="text-result">Nenhum conteúdo cadastrado</td></tr>')
                }
            }, 
            error: function(){

            }
        })
    }

});
    

</script>
