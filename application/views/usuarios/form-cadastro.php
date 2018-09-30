<script src="https://code.jquery.com/jquery-3.3.1.js" type="text/javascript"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" type="text/javascript"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="http://jqueryui.com/resources/demos/style.css">
<script type="text/javascript">
$(document).ready(function(){
    $("#calendar").datepicker({
            altFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true,
            dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
            dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
            dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
            monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
            monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
        });

    $.getJSON("<?= base_url().'usuario/categoria'?>", function(dados){
            var option = "<option value=''>Selecione categoria</option>"; 
            if (dados.length > 0){
                $.each(dados, function(i, obj){
                    option += "<option value='"+obj.categoria_id+"'>"+
                        obj.categoria_nome+"</option>";
                });
            }
            else {
                Reset();
            }
            $("#categoria").html(option).show();
        });
    
    $("#categoria").change(function(s){
        var categoria = $("#categoria").val();
        $.getJSON("<?= base_url().'usuario/subcategoria/'?>"+categoria, function(dados){
            var option = "<option value=''>Selecione subcategoria</option>"; 
            if (dados.length > 0){
                $.each(dados, function(i, obj){
                    option += '<option value=">'+obj.subcategoria_id+'">'+
                        obj.subcategoria_nome+'</option>';
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
<form class="form-horizontal" action="/action_page.php">
  <div class="form-group">
    <label class="control-label col-sm-2" for="nome">Nome:</label>
    <div class="col-sm-10">
        <input type="text" name="nome" class="form-control" id="nome" placeholder="Coloque seu nome">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="email">Email:</label>
    <div class="col-sm-10"> 
        <input type="text" name="email" class="form-control" id="email" placeholder="Coloque seu email">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="calendar">Data de nascimento:</label>
    <div class="col-sm-10"> 
        <input type="text" name="data" class="form-control" id="calendar" placeholder="Coloque sua data de nascimento">
    </div>
  </div>
  <div class="form-group">
        <label class="control-label col-sm-2" for="categoria">Categoria:</label>
        <div class="col-sm-10">
            <select class="form-control" name="categoria" id="categoria" placeholder="Categoria">
                <option value="">Carregar uma categoria</option>
                
            </select>
    </div>
    </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="subcategori">Subcategoria:</label>
        <div class="col-sm-10">
            <select class="form-control" name="subcategoria" id="subcategoria" placeholder="Subcategoria"/>
                <option value="">Carregar a subcategoria</option>
            
            </select>
        </div>
    </div>

  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Cadastrar</button>
    </div>
  </div>
</form>
