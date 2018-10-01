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
});
</script>
<form class="form-horizontal" action="/action_page.php">
<div class="form-group">
    <label class="control-label col-sm-2" for="titulo">Titulo:</label>
    <div class="col-sm-10">
        <input type="text" name="titulo" class="form-control" id="titulo" placeholder="Coloque o titulo">
    </div>
  </div>
<div class="form-group">
        <label class="control-label col-sm-2" for="foto">Foto:</label>
        <div class="col-sm-10">
            <input type="file" class="form-control" name="foto" id="seleciona-imagem" placeholder="Foto"/>
        </div>
</div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="foto">Preview:</label>
        <div class="col-sm-10" id="imagem-box">
            
        </div>
    </div>
    <div class="form-group">
    <label class="control-label col-sm-2" for="area">Conteudo:</label>
    <div class="col-sm-10"> 
        <textarea type="text" name="textarea" class="form-control" style="height: 200px" id="editor" placeholder="Coloque o conteudo">
             &lt;p&gt;This is some sample content.&lt;/p&gt;
        </textarea>
    </div>
</div>
<div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Cadastrar</button>
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

</form>