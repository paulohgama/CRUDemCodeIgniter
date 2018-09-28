<table class="table-responsive">
    <caption>Subcategorias</caption>
    <thead>
        <tr>
            <th>ID</th>
            <th>Subcategoria</th>
            <th>Categoria</th>
            <th colspan="2">Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($subcategoria == FALSE): ?>
        <tr><td colspan="5" style="color: red; font: bold">Nenhuma subcategoria encontrada</td></tr>
        <?php else: ?>
            <?php foreach ($subcategoria as $subcategorias): ?>
		<tr>
                    <td><?= $subcategorias['subcategoria_id'] ?></td>
                    <td><?= $subcategorias['subcategoria_nome'] ?></td>                   
                    <td><?= $subcategorias['categoria_nome'] ?></td>                   
                    <td><a href="<?= $subcategorias['editar_url'] ?>"  class="btn btn-warning" >Editar</a> 
                        <a href="<?= $subcategorias['excluir_url'] ?>"  class="btn btn-danger" >Excluir</a>
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