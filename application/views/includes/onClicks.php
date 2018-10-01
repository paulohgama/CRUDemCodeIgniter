<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script type="text/javascript">
    $("#formCadastro").click(function(){
        $.ajax({
            url: 'usuarios/form-cadastro'
            success: function(data){//}
            });
    });
</script>