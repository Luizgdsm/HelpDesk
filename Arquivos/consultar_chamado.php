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
          <a class="nav-link active text-success" href="#"><h5>Chamado Em Aberto</h5></a>
        </li>
        <li class="nav-item col-6">
          <a class="nav-link text-warning" href="Consultar_chamado_Fechado.php"><span>Chamado Encerrado</span></a>
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

              $listaFinal = $_SESSION['DadosBanco'];
              $listaFinal["acesso"] = $_SESSION["acesso"]; 
              $_POST = $listaFinal;
              $resp = 0;
            
                if(isset($listaFinal["numChamado"])){
                  for ($i=1; $i <= $listaFinal["numChamado"]; $i++) {//percorrendo o array com os chamados
                    if ($listaFinal[$i]["statusChamada"] == 0) { 
                      $dadosChamado["titulo"] = $listaFinal[$i]["titulo"];
                      $dadosChamado["categoria"] = $listaFinal[$i]["categoria"];
                      $dadosChamado["descricao"] = $listaFinal[$i]["descricao"];
                      $dadosChamado["statusChamada"] = $listaFinal[$i]["statusChamada"];
                      $dadosChamado["idChamado"] = $listaFinal[$i]["idChamado"];
                      $dadosChamado["numChamado"] = $listaFinal[$i]["numChamado"];
                      $dadosChamado["email"] = $listaFinal[$i]["email"];
              ?>
              <form method="post" action="fecharChamado.php">
              <div class="card mb-3 bg-light">
                <div class="card-body">
                  <h5 class="card-title"><?= $listaFinal[$i]["titulo"] ?></h5>
                  <h6 class="card-subtitle mb-2 text-muted"><?=  $listaFinal[$i]["categoria"] ?></h6>
                  <p class="card-text"><?= $listaFinal[$i]["descricao"] ?></p>
                  <h6 class="card-subtitle mb-2 text-muted"><?=  $listaFinal[$i]["email"] ?></h6>
                  <?php 
                  if($listaFinal[$i]["statusChamada"] == 0){ ?>
                    <p class="card-text" >Status: <font color="green" face="arial">ABERTO</font></p>
                  <?php }else{ ?>
                    <p class="card-text"><font color="red" face="arial">FECHADO</font></p>
                  <?php } ?>
                </div>
                
                <input type="hidden" name="titulo" value="<?php print_r($dadosChamado["titulo"]);?>">
                <input type="hidden" name="categoria" value="<?php print_r($dadosChamado["categoria"]);?>">
                <input type="hidden" name="descricao" value="<?php print_r($dadosChamado["descricao"]);?>">
                <input type="hidden" name="statusChamada" value="<?php print_r($dadosChamado["statusChamada"]);?>">
                <input type="hidden" name="idChamado" value="<?php print_r($dadosChamado["idChamado"]);?>">
                <input type="hidden" name="numChamado" value="<?php print_r($dadosChamado["numChamado"]);?>">
                 <input type="hidden" name="email" value="<?php print_r($dadosChamado["email"]);?>">

                <?php 
                if($listaFinal["acesso"] == "adm"){ ?>

                <div class="row mt-10">
                <div class="col-3">
                  <input type="submit" class="btn btn-sm btn-block btn-success mb-1 ml-1" value="ENCERRAR">
                </div>
                
              </div>
                <?php }?>
              </div>
              </form>

            <?php }
              }
            } ?>

            </div>
          </div>
        </div>
      </div>
       <div class="row col-8 mt-2 mb-5">
          <a href="home.php" class="btn btn-lg btn-warning btn-block" >Voltar</a>
       </div>
    </div>
  </body>
</html>