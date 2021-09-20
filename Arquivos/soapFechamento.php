<?php 
	session_start();

	$_POST;//recebendo os dados da index
	$client = new SoapClient(null, array (//criando o client
		"location" => "http://localhost/Aplicação_HelpDesk/Arquivos/soap2.php",
		"uri" => "http://localhost/Aplicação_HelpDesk/Arquivos/soap2.php",
		"trace" => 1));

	$result= $client->fecharChamado($_POST);

	if (is_soap_fault($result)){//tratando erro
		trigger_error("SOAP fault");
	}elseif($result == true){//redirecionemento para a alteração do estado de chamado
		$resultStatus = $client->alteraStatusChamado($_POST);

		require "backEndEmail.php";
		header("Location: soapConsulta.php");
		$emailSend = EnviarEmailEncerramento($_POST);
	}	
?>