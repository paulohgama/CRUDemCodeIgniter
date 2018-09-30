<script src="assets/jquery.js" type="text/javascript"></script>
<script src="assets/dataTable.js" type="text/javascript"></script>
<link href="assets/css.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript"> 
    $(document).ready(function (){
       var dataTable = $('#tabelaCategoria').DataTable({
           "processing": true,
           "serverSide": true,
           "order": [],
           "ajax": {
               "url": "<?= base_url().'categoria/pega_dados'?>",
               "type": "POST"
           },
           "columnsDefs": [
                {
                    "target": [2, 3],
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
            "pageLength": 15
       }); 
    });
</script>

<table id="tabelaCategoria" class="table-responsive">
    <thead>
        <tr>
            <th>#</th>
            <th>Categoria</th>
            <th>Editar</th>
            <th>Deletar</th>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>
<?php if ($this->session->flashdata('error') == TRUE): ?>
    <div class="alert alert-danger alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong><?php echo $this->session->flashdata('error'); ?></strong>
    </div>
<?php endif; ?>
<?php if ($this->session->flashdata('success') == TRUE): ?>
	<div class="alert alert-success alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong><?php echo $this->session->flashdata('success'); ?></strong>
    </div>
<?php endif;?>