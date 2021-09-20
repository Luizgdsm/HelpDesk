 <?php
 /* Tratamento de paramentros de "index.php" para comparação de senha em array $bancoFake (que simula um banco de dados) afim da realização de login */
 session_start();
 	
foreach ($bancoFake as $teste) {//percorrendo o banco fake e comparando com parametros de $_POST
	
	if($_POST['email'] == $teste["email"]){//validando email

		if ($_POST['senha'] == $teste["senha"]) {//validando senha
			$valid = true;
			$_SESSION["validado"] = "sim";
			$_SESSION["id"] = $teste["id"];
			$_SESSION["acesso"] = $teste["acesso"];
			print_r($_SESSION);
			break;		
		}
		break;
	}
}

echo $valid != true ? header("Location: index.php?error=erro") : header("Location: home.php");
//operador ternario para realocar login.

?>