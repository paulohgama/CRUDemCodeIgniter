<script src="<?=base_url('assets/js/scripts.js')?>" type="text/javascript"></script>
<script src="<?=base_url('assets/js/jquery.Jcrop.js')?>"></script>
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
            <input type="file" class="form-control" name="foto" id="foto" placeholder="Foto"/>
        </div>
</div>
<div id="imagem-box">
            <img src="" style="display:none;width:30%; height: 30%" id="visualizar" />
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
<div class="form-group">
    <label class="control-label col-sm-2" for="area">Conteudo:</label>
    <div class="col-sm-10"> 
        <textarea type="text" name="textarea" class="form-control" id="area" placeholder="Coloque o conteudo"></textarea>
    </div>
</div>
</form>