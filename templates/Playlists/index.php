<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Playlist[]|\Cake\Collection\CollectionInterface $playlists
 */
?>
<div class="playlists index content">
    <?= $this->Html->link(__('Nova Playlist'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Playlists') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Descrição</th>
                    <th>Autor</th>
                    <!-- <th>Criado Em</th> -->
                    <!-- <th>Atualizado Em</th> -->
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody id="load-playlist">
              
            </tbody>
        </table>
    </div>
    <ul class="pagination">
        <!-- Loading item -->
    </ul>
</div>

<script src="https://code.jquery.com/jquery-3.6.1.js"></script>
<script>
    var token = <?= json_encode($this->request->getAttribute('csrfToken')); ?>
    
    loadPlaylist(1)

    function loadPlaylist(n) {
        var load_playlist = $('#load-playlist')
        var pagination = $('.pagination')

        $.ajax({
            url: "<?= $this->Url->build(['controller' => 'Playlists', 'action' => 'index']) ?>?page=" + n,
            method: 'POST',
            dataType: 'json',
            data: {'p': true},
            beforeSend: function(xhr){
                xhr.setRequestHeader(
                    'X-CSRF-Token',
                    token
                );

                load_playlist.html('<tr><td colspan="9" class="text-center">Carregando...</td></tr>')
                pagination.html('')
            },
            success: function(data) {
                var response = data.playlists
                var pages = Math.ceil(data.pages)
                load_playlist.html('')
                               
                if (response.length > 0 ) {
                    for (var i = 0; i < response.length; i++) {
                      
                        load_playlist.append('<tr>' +
                            '<td>' + response[i].id + '</td>' +
                            '<td>' + response[i].title + '</td>' +
                            '<td>' + response[i].description + '</td>' +
                            '<td>' + response[i].author + '</td>' +
                            // '<td>' + response[i].created_at + '</td>' +
                            //'<td>' + response[i].updated_at + '</td>' +
                            '<td class="actions">' +
                                '<a href="/playlists/view/'+ response[i].id +'" class="btn-success">Visualizar</a>' +
                            '</td>' +
                            '<td class="actions">' +
                                '<a href="/playlists/edit/'+ response[i].id +'" class="btn-warning">Atualizar</a>' +
                            '</td>' +
                            '<td class="actions">' +
                                '<form id="form-'+ response[i].id +'" style="display:none;" method="post" action="/playlists/delete/'+ response[i].id +'">' +
                                    '<input type="hidden" name="_method" value="POST">' +
                                    '<input type="hidden" name="_csrfToken" autocomplete="off" value="'+ token +'">'+
                                '</form>' +
                                '<a href="#" class="btn-danger" data-confirm-message="Tem certeza de que deseja excluir?" onclick="if (confirm(this.dataset.confirmMessage)) { document.getElementById(\'form-'+ response[i].id +'\').submit(); } event.returnValue = false; return false;">Delete</a>' +
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
                        loadPlaylist(n)
                    })

                } else {
                    load_playlist.html('<tr><td colspan="9" class="text-result">Nenhuma playlist cadastrada</td></tr>')
                }

            }, 
            error: function(){

            }
        })
    }

</script>

