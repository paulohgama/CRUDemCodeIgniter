<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.8.2.js"></script>
<script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $( "#calendar" ).datepicker({
            altFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true,
            dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
            dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
            dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
            monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
            monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
        });
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
        <label class="control-label col-sm-2" for="foto">Foto:</label>
        <div class="col-sm-10">
            <input class="form-control" name="foto" id="foto" placeholder="Foto"/>
        </div>
    </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="categoria">Categoria:</label>
        <div class="col-sm-10">
            <select class="form-control" name="categoria" id="categoria" placeholder="Categoria">
                
                
            </select>
        </div>
    </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="subcategori">Subcategoria:</label>
        <div class="col-sm-10">
            <select class="form-control" name="subcategoria" id="subcategoria" placeholder="Subcategoria"/>
            
            </select>
        </div>
    </div>
      <div class="form-group">
    <label class="control-label col-sm-2" for="area">Conteudo:</label>
    <div class="col-sm-10"> 
        <textarea type="text" name="textarea" class="form-control" id="area" placeholder="Coloque o conteudo"></textarea>
    </div>
  </div>
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Cadastrar</button>
    </div>
  </div>
</form>