<?php require_once "validador_acesso.php"//Extensão require para validar o direito de acesso a pagina ?>
<html>
  <head>
    <meta charset="utf-8" />
    <title>App Help Desk</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
      .card-consultar-chamado {
        padding: 30px 0 0 0;
        width: 100%;
        margin: 0 auto;
      }
    </style>
  </head>

  <body>

     <?php require_once "BarraNavegacao.php" //Extensão require para inclusão da barra de navegação por require. ?>
    <div class="container">  

    <div class="mt-2">
      <ul class="nav nav-tabs">
        <li class="nav-item col-6">
          <a class="nav-link text-success" href="consultar_chamado.php">Chamado Em Aberto</a>
        </li>
        <li class="nav-item col-6">
          <a class="nav-link active text-warning" href="#"><h5>Chamado Encerrado</h5></a>
        </li>
      </ul>
     </div>  

      <div class="row">
        <div class="card-consultar-chamado">
          <div class="card">
            <div class="card-header">
              Consulta de chamado
            </div>
            
            <div class="card-body">

              <?php 
              $_SESSION;
              $listaFinal = [];
              $resp = 0;

              $listaFinal = $_SESSION['DadosBanco'];
              $listaFinal["acesso"] = $_SESSION["acesso"];

                if (isset($listaFinal["numChamado"])) {
                  for ($i=1; $i <= $listaFinal["numChamado"]; $i++) {//percorrendo o array com os chamados
                   if ($listaFinal[$i]["statusChamada"] != 0) { 
              ?>

              <div class="card mb-3 bg-light">
                <div class="card-body">
                  <h5 class="card-title"><?= $listaFinal[$i]["titulo"] ?></h5>
                  <h6 class="card-subtitle mb-2 text-muted"><?=  $listaFinal[$i]["categoria"] ?></h6>
                  <p class="card-text"><?= $listaFinal[$i]["descricao"] ?></p>
                  <?php 
                  if($listaFinal[$i]["statusChamada"] == 0){ ?>
                    <p class="card-text" >Status: <font color="green" face="arial">ABERTO</font></p>
                  <?php }else{ ?>
                    <p class="card-text" >Status: <font color="red" face="arial">FECHADO</font></p>
                  <?php } ?>
                </div>
              </div>
            <?php 
                }
              } 
            }?>
               
            </div>
          </div>
        </div>
      </div>
          <div class=" row col-8 mt-2">
              <a href="home.php" class="btn btn-lg btn-warning btn-block" >Voltar</a>
          </div>
    </div>
  </body>
</html>