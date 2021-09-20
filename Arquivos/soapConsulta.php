<?php 
	session_start();
	
	$_POST = $_SESSION;
	
	$client = new SoapClient(null, array (//criando o client
		"location" => "http://localhost/Aplicação_HelpDesk/Arquivos/soap2.php",
		"uri" => "http://localhost/Aplicação_HelpDesk/Arquivos/soap2.php",
		"trace" => 1));

	$result= $client->realizarConsulta($_POST); //solicitando do server o login
	
	$_SESSION['DadosBanco'] = $result;

	if (is_soap_fault($result)){//tratando erro
		trigger_error("SOAP fault");
	}else{//atribuindo valores de resposta
		echo $_SESSION["validado"] != "sim" ? header("Location: index.php?error=erro2") : header("Location: consultar_chamado.php");
	}
?>