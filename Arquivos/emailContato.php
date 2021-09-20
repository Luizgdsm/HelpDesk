<?php require_once "validador_acesso.php"//Extensão require para validar o direito de acesso a pagina ?>
<html>
  <head>
    <meta charset="utf-8" />
    <title>App Help Desk</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
      .card-abrir-chamado {
        padding: 30px 0 0 0;
        width: 100%;
        margin: 0 auto;
      }
    </style>
  </head>

  <body>

   <?php require_once "BarraNavegacao.php" //Extensão require para inclusão da barra de navegação por require. ?>

   <?php 
   echo "<pre>";
   print_r($_POST);
   echo "</pre>";

   $infoChamado = array();
   $infoChamado = $_POST["numChamado"];
   ?>

    <div class="container">    
      <div class="row">

        <div class="card-abrir-chamado">
          <div class="card">
            <div class="card-header">
              Fechamento de chamado
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col">
                  
                  <form action="soapFechamento.php" method="post">
                    <div class="form-group">
                      <label>Serial/Nome</label>
                      <input name="serial" type="text" class="form-control" placeholder="Serial">
                    </div>
                    
                    <div class="form-group">
                      <label>Categoria</label>
                      <select name="categoria" class="form-control">
                         <option>Escolher Categoria</option>
                        <option>Atendimento em casa</option>
                        <option>Atendimento Empresarial</option>
                        <option>Hardware</option>
                        <option>Software</option>
                        <option>Rede</option>
                      </select>
                    </div>
                    
                    <div class="form-group">
                      <label>Detalhes</label>
                      <textarea name="detalhes" class="form-control" rows="3" placeholder="Materiais, Horas, Equipamentos"></textarea>
                    </div>

                    <div class="form-group">
                      <label>Preço Final</label>
                      <input name="preco" type="text" class="form-control" placeholder="R$ 00,00">
                    </div>

                    <?php
                    $_GET;
                      if(isset($_GET["error"]) && $_GET["error"] == "dados"){
                    ?>

                    <div class="text-danger">
                      ATENÇÃO! Todos os dados devem ser preenchidos.
                    </div>

                    <?php } ?>

                    <div class="row mt-5">
                      <div class="col-6">
                        <a href="home.php" class="btn btn-lg btn-warning btn-block" >Cancelar</a>
                      </div>

                      <div class="col-6">
                        <button class="btn btn-lg btn-info btn-block" type="submit">Fechar</button>
                      </div>
                    </div>

                    <input type="hidden" name="numChamado" value="<?php print_r($infoChamado); ;?>">
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
  </body>
</html>