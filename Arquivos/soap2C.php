<?php 
	session_start();
	
	$_POST;//recebendo os dados da index

	$client = new SoapClient(null, array (//criando o client
		"location" => "http://localhost/Aplicação_HelpDesk/Arquivos/soap2.php",
		"uri" => "http://localhost/Aplicação_HelpDesk/Arquivos/soap2.php",
		"trace" => 1));

	$result=$client->LoginCliente($_POST);//solicitando do server o login

	if (is_soap_fault($result)){//tratando erro
		trigger_error("SOAP fault");
	}else{//atribuindo valores de resposta
		$_SESSION["validado"] = $result["1"];
		$_SESSION["id"] = $result["2"];
		$_SESSION["acesso"] = $result["3"];
		$_SESSION["email"] = $result["4"];

	//encaminhamento em caso de sucesso	
	echo $_SESSION["validado"] != "sim" ? header("Location: index.php?error=erro") : header("Location: home.php");
	}
?>