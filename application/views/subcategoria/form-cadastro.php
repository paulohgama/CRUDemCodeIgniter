<div class="container-fluid">
    <?php
        if(!isset($subcategoria))
        {
            $subcategoria = [
                'subcategoria_nome' => '',
                'subcategoria_id' => ''
            ];
        }
            
    ?>
    <?php if($subcategoria['subcategoria_id'] === (string) ''): ?>
        <form method="POST" action="<?= base_url().'subcategoria/salvar' ?>">
    <?php else: ?>
        <form method="POST" action="<?= base_url().'subcategoria/atualizar' ?>">
    <?php endif; ?>
    <div class="form-group">
        <label for="categoria">Nome:</label>
        <input type="text" name="subcategoria_nome" class="form-control" id="categoria" 
           value="<?=$subcategoria['subcategoria_nome']?>" placeholder="Coloque uma subcategoria">
    </div>
    <div class="form-group">
        <select class="form-control" name="categoria_fk">
            <option value="">Escolha uma categoria</option>
            <?php foreach ($categoria as $categorias): ?>
                <?php   if($categorias['categoria_id']==$subcategoria['categoria_fk']) : 
                            $selected = 'selected'; 
                        else:  
                            $selected = '';
                        endif;?>
                <option value="<?= $categorias['categoria_id'] ?>" <?=$selected?>><?= $categorias['categoria_nome'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
  <div class="form-group"> 
        <input type="hidden" name="subcategoria_id" value="<?=$subcategoria['subcategoria_id']?>">
        <?php if($subcategoria['subcategoria_id'] === (string) ''): ?>
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