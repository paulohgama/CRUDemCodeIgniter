<script src="https://code.jquery.com/jquery-3.3.1.js" type="text/javascript"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" type="text/javascript"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="http://jqueryui.com/resources/demos/style.css">
<script type="text/javascript">
$(document).ready(function(){
    $("#calendar").datepicker({
            altFormat: 'dd-mm-yy',
            dataFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true,
            dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
            dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
            dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
            monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
            monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
        });

    $.getJSON("<?= base_url().'usuario/categoria'?>", function(dados){
            if (dados.length > 0){
                var option = "<option value=''>Selecione categoria</option>"; 
                $.each(dados, function(i, obj){
                    if(<?= $usuario['categoria_id'] ?> == obj.categoria_id)
                    {
                        option += "<option value='"+obj.categoria_id+"' selected>"+obj.categoria_nome+"</option>";
                    }
                    else
                    {
                        option += "<option value='"+obj.categoria_id+"'>"+obj.categoria_nome+"</option>";
                    }
                });
            }
            else {
                Reset();
            }
            $("#categoria").html(option).show();
            var categoria = $("#categoria").val();
            $.getJSON("<?= base_url().'usuario/subcategoria/'?>"+categoria, function(dados){
            var option = "<option value=''>Selecione subcategoria</option>"; 
            if (dados.length > 0){
                $.each(dados, function(i, obj){
                    if(<?= $usuario['subcategoria_id'] ?> == obj.subcategoria_id)
                    {
                        option += "<option value='"+obj.subcategoria_id+"' selected>"+obj.subcategoria_nome+"</option>";
                    }
                    else
                    {
                        option += "<option value='"+obj.subcategoria_id+"'>"+obj.subcategoria_nome+'</option>';
                    }
                });
            }
            else {
                Reset();
            }
            $("#subcategoria").html(option).show();
        });
        });
    
    function Reset()
    {
        $("subcategoria").empty().append('<option>Carregar subcategorias</option>');
    }
    });
</script>
<form class="form-horizontal" method="POST" action="<?= base_url('usuario/atualizar')?>">
  <div class="form-group">
    <label class="control-label col-sm-2" for="nome">Nome:</label>
    <div class="col-sm-10">
        <?php //return var_dump($usuario); ?>
        <input type="text" value="<?= $usuario["usuario_nome"] ?>" name="usuario_nome" class="form-control" id="nome" placeholder="Coloque seu nome">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="email">Email:</label>
    <div class="col-sm-10"> 
        <input type="text" value="<?= $usuario['usuario_email'] ?>" name="usuario_email" class="form-control" id="email" placeholder="Coloque seu email">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="calendar">Data de nascimento:</label>
    <div class="col-sm-10"> 
        <input type="text" value="<?= $usuario['usuario_data'] ?>" name="usuario_data" class="form-control" id="calendar" placeholder="Coloque sua data de nascimento">
    </div>
  </div>
  <div class="form-group">
        <label class="control-label col-sm-2" for="categoria">Categoria:</label>
        <div class="col-sm-10">
            <select class="form-control" id="categoria" placeholder="Categoria">
                <option value="">Carregar uma categoria</option>
                
            </select>
    </div>
    </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="subcategoria">Subcategoria:</label>
        <div class="col-sm-10">
            <select class="form-control" name="subcategoria_fk" id="subcategoria" placeholder="Subcategoria"/>
                <option value="">Carregar a subcategoria</option>
            
            </select>
        </div>
    </div>
    <input type="hidden" name="usuario_id" value="<?= $usuario['usuario_id'] ?>"/>
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-refresh"></span> Atualizar</button>
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
