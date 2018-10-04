<!DOCTYPE html>
<html>
    <head>
        
    </head>
    <body>
        <h2 align="center"><?= $titulo ?></h2>
        <h6 align="right">Autor: <?= $nome ?></h6>
        <center><img align="center" src="cid:<?= $imagem ?>" alt="<?= $titulo ?>" style="width: 100px"/></center>
        <br/>
        <br/>
        <div class="container-fluid" style="box-shadow: 0 1px 3px 1px rgba(0, 0, 0, 0.5)">
            <?= $conteudo ?>
        </div>
    </body>
</html>