<?php 
	session_start();

	if ($_POST["titulo"] == null || $_POST["categoria"] == "Escolher Categoria" || $_POST["descricao"] == null ) {
		//Tratamento para se assegurar que todos os campos foram preenchidos
		header("Location: abrir_chamado.php?error=dados");

	}else{
		$_POST['id'] = $_SESSION["id"];

		$_POST;//recebendo os dados da index

		$client = new SoapClient(null, array (//criando o client
			"location" => "http://localhost/Aplicação_HelpDesk/Arquivos/soap2.php",
			"uri" => "http://localhost/Aplicação_HelpDesk/Arquivos/soap2.php",
			"trace" => 1));

		$result= $client->realizarChamado($_POST);//solicitando do server o login

		echo "<pre>";
		print_r($_POST);
		echo "</pre>";
		
		if (is_soap_fault($result)){//tratando erro
			trigger_error("SOAP fault");
		}else{//atribuindo valores de resposta
		
		//encaminhamento em caso de sucesso	
		echo $_SESSION["validado"] != "sim" ? header("Location: index.php?error=erro2") : header("Location: soapConsulta.php");

		require "backEndEmail.php";
		
		echo $_SESSION["validado"] != "sim" ? header("Location: index.php?error=erro2") : header("Location: soapConsulta.php");

		$emailSend = EnviarEmailChamado($_POST);
		}		
	}
?>