<script src="<?=base_url('assets/js/scripts.js')?>" type="text/javascript"></script>
<script src="<?=base_url('assets/js/jquery.Jcrop.js')?>"></script>
<script src="<?=base_url('assets/ckeditor/ckeditor.js')?>"></script>
<script type="text/javascript">
$(document).ready( function (){
       CKEDITOR.replace( 'editor', {
	width: '100%',
	height: 338,
        resize_enabled: false,
        language: 'pt',
        customConfig: "<?= base_url().'assets/ckeditor/config.js' ?>",
        extraPlugins: 'image,uploadimage'
    });
    $.getJSON("<?= base_url().'posts/usuario'?>", function(dados){
            if (dados.length > 0){
                var option = "<option value=''>Selecione autor</option>"; 
                $.each(dados, function(i, obj){
                    option += "<option value='"+obj.usuario_id+"'>"+
                        obj.usuario_nome+"</option>";
                });
            }
            else {
                Reset();
            }
            $("#pessoa").html(option).show();
        });
        function Reset()
        {
            $("pessoa").empty().append('<option>Carregando Autores</option>');
        }
});
</script>
<form class="form-horizontal" method="GET" action="<?= base_url('posts/salvar')?>" enctype="multipart/form-data">
<div class="form-group">
    <label class="control-label col-sm-2" for="pessoa">Autor:</label>
    <div class="col-sm-10">
        <select name="usuario_fk" class="form-control" id="pessoa">
            <option value="">Carregando Autores</option>
        </select>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-sm-2" for="titulo">Titulo:</label>
    <div class="col-sm-10">
        <input type="text" name="post_titulo" class="form-control" id="titulo" placeholder="Coloque o titulo">
    </div>
  </div>
<div class="form-group">
        <label class="control-label col-sm-2" for="foto">Foto do Post:</label>
        <div class="col-sm-10">
            <input type="file" class="form-control" name="post_foto" id="seleciona-imagem"/>
        </div>
</div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="foto">Preview da Imagem:</label>
        <div class="col-sm-10" id="imagem-box">
            <h6>Escolha a imagem para recortar</h6>
        </div>
    </div>
    <div class="form-group">
    <label class="control-label col-sm-2" for="area">Conteudo:</label>
    <div class="col-sm-10"> 
        <textarea type="text" name="post_conteudo" class="form-control" style="height: 200px" id="editor" placeholder="Coloque o conteudo">
             &lt;p&gt;This is some sample content.&lt;/p&gt;
        </textarea>
    </div>
</div>
<input type="hidden" id="x" name="x" />
<input type="hidden" id="y" name="y" />
<input type="hidden" id="wcrop" name="wcrop" />
<input type="hidden" id="hcrop" name="hcrop" />
<input type="hidden" id="wvisualizacao" name="wvisualizacao" />
<input type="hidden" id="hvisualizacao" name="hvisualizacao" />
<input type="hidden" id="woriginal" name="woriginal" />
<input type="hidden" id="horiginal" name="horiginal" />
<div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Cadastrar</button>
    </div>  
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