<h2 align="center"><?= $post[0]["post_titulo"] ?></h2>
<h6 align="right">Autor: <?= $post[0]['usuario_nome'] ?></h6>
<center><img align="center" src="<?= $post[0]['post_foto'] ?>" alt="<?= $post[0]['post_titulo'] ?>" style="width: 100px"/></center>
<br/>
<br/>
<div class="container-fluid" style="box-shadow: 0 1px 3px 1px rgba(0, 0, 0, 0.5)">
    <?= $post[0]['post_conteudo'] ?>
</div>
<div style="position: absolute; bottom: 15px"><a href="<?= base_url('posts/listarposts') ?>" role="button" class="btn btn-primary footer-a"><span class="glyphicon glyphicon-arrow-left"></span> Voltar</a></div>