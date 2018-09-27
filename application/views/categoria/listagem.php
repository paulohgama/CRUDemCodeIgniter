<table class="table-responsive">
    <caption>Categorias</caption>
    <thead>
        <tr>
            <th>ID</th>
            <th>Categoria</th>
            <th colspan="2">Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($categorias == FALSE): ?>
	<tr><td colspan="2">Nenhuma categoria encontrada</td></tr>
        <?php else: ?>
            <?php foreach ($categorias as $categoria): ?>
		<tr>
                    <td><?= $categoria['categoria_id'] ?></td>
                    <td><?= $categoria['categoria_nome'] ?></td>
                    <td><a href="<?= $categoria['editar_url'] ?>"  class="btn btn-warning" >Editar</a> 
                        <a href="<?= $categoria['excluir_url'] ?>"  class="btn btn-danger" >Excluir</a>
                    </td>
		</tr>
            <?php endforeach; ?>
	<?php endif; ?>
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