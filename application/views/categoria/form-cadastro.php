<div class="container-fluid">
    <?php
        if(!isset($categoria))
        {
            $categoria = [
                'categoria_nome' => '',
                'categoria_id' => ''
            ];
        }
            
    ?>
    <?php if($categoria['categoria_id'] === (string) ''): ?>
        <form method="POST" action="<?= base_url().'categoria/salvar' ?>">
    <?php else: ?>
        <form method="POST" action="<?= base_url().'categoria/atualizar' ?>">
    <?php endif; ?>
  <div class="form-group">
    <label for="categoria">Nome:</label>
    <input type="text" name="categoria_nome" class="form-control" id="categoria" 
           value="<?=$categoria['categoria_nome']?>" placeholder="Coloque uma categoria">
  </div>
  <div class="form-group"> 
        <input type="hidden" name="categoria_id" value="<?=$categoria['categoria_id']?>">
        <?php if($categoria['categoria_id'] === (string) ''): ?>
            <button type="submit" class="btn btn-success">Cadastrar</button>
        <?php else: ?>
            <button type="submit" class="btn btn-success">Atualizar</button>
        <?php endif; ?>
  </div>
</form>
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
</div>