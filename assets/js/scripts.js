$(document).ready(function(){
    $("#foto").change(function(){
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#visulizar').attr('src', e.target.result);
                $('#visulizar').Jcrop({
                    aspectRatio: 1,
                    onSelect: atualizaCoordenadas,
                    onChange: atualizaCoordenadas
                });
            defineTamanhoImagem(e.target.result,$('#visulizar'));
            };
            reader.readAsDataURL(this.files[0]);
        }
    });

function atualizaCoordenadas(c)
{
  $('#x').val(c.x);
  $('#y').val(c.y);
  $('#wcrop').val(c.w);
  $('#hcrop').val(c.h);
};
 
function defineTamanhoImagem(imgOriginal, imgVisualizacao) {
  var image = new Image();
  image.src = imgOriginal;
 
  image.onload = function() {
    $('#wvisualizacao').val(imgVisualizacao.width());
    $('#hvisualizacao').val(imgVisualizacao.height());
    $('#woriginal').val(this.width);
    $('#horiginal').val(this.height);
  };
}
});