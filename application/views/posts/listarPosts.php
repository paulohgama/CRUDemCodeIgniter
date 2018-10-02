<script src="https://code.jquery.com/jquery-3.3.1.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" type="text/javascript"></script>
<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript">
$(document).ready(function(){
   var dataTable = $('#tabelaPosts').DataTable({
           "processing": true,
           "serverSide": true,
           "order": [],
           "ajax": {
               "url": "<?= base_url().'posts/pega_dados'?>",
               "type": "POST"
           },
           "columnsDefs": [
                {
                    "target": [3, 4],
                    "orderable":false
                }
           ],
           "language": {
                "zeroRecords": "Nada encontrado - desculpe",
                "info": "Mostrando pagina _PAGE_ de _PAGES_",
                "infoEmpty": "Nenhum registro disponivel",
                "infoFiltered": "(filtrado do total de _MAX_ registros)",
                "paginate": {
                    "first":      "Primeira",
                    "last":       "Ultima",
                    "next":       "Proxima",
                    "previous":   "Anterior"
                },
                "search":         "Pesquisar:",
                "loadingRecords": "Carregando...",
                "processing":     "Processando..."
        },
            "lengthChange": false,
            "pageLength": 10
       });  
    });
</script>
<table id="tabelaPosts" class="table-responsive">
    <thead>
        <tr>
            <th>Autor</th>
            <th>Titulo</th>
            <th>Imagem</th>
            <th>Conteudo</th>
        </tr>
    </thead>
    <tbody>
        
    </tbody>
    <tfoot>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
    </tfoot>
</table>
