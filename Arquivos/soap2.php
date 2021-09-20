<?php 
	
$server = new SoapServer(null, array(//criando o server
	"uri" => "http://localhost/Aplicação_HelpDesk/Arquivos/soap2c.php"));//altere seu diretorio**

$server->addFunction("LoginCliente");
$server->addFunction("realizarConsulta");
$server->addFunction("realizarChamado");
$server->addFunction("fecharChamado");
$server->addFunction("alteraStatusChamado");

function LoginCliente($dados){//função de login
	$dadosCliente = [];//variavel de retorno para o client
	$emailcliente = $dados["email"];//precisei adicionar esta e a senha pois o mysql não aceitava array
	$senhacliente = $dados["senha"];

	define("server", "127.0.0.1");//definindo localhost para do mysql (acesso padrão para localhost)
	define("usuario", "root");
	define("senha", "");//referente a senha de acesso ao seu banco de dados
	define("bancoDeDados", "BancoClientes");

	//abrindo conexão com o banco de dados
	$conexao = mysqli_connect(server, usuario, senha, bancoDeDados) or die("errorSoap");

	//comando de busca do mysql
	$sql = "select COUNT(*) as total from login_cliente WHERE email = '$emailcliente' and senha = MD5('$senhacliente')";
	$result = mysqli_query($conexao, $sql);
	$row = mysqli_fetch_assoc($result);
	$sqlDados = "select * from login_cliente WHERE email = '$emailcliente' and senha = MD5('$senhacliente')";
	$resultDados = mysqli_query($conexao, $sqlDados);
	$rowDados = mysqli_fetch_assoc($resultDados);

	if ($row["total"] == 1) {//atribuindo valores em caso de sucesso
		$dadosCliente[1] = $_SESSION["validado"] = "sim";
		$dadosCliente[2] = $rowDados["id"];
		$dadosCliente[3] = $rowDados["acesso"];
		$dadosCliente[4] = $rowDados["email"];	

			return $dadosCliente;
		}else{
		$dadosCliente["TesteBanco"] = "errorSoap";
			return $dadosCliente;
		}
}

//Função responsávelpor abrir chamado no BD
function realizarChamado($dados){
	$dadosCliente = [];//variavel de retorno para o client
	$tituloChamado = $dados["titulo"];
	$categoriaChamado = $dados["categoria"];
	$descricaoChamado = $dados["descricao"];
	$statusChamado = $dados["status"];
	$idChamado = $dados["id"];
	$email = $dados["email"];

	define("server", "127.0.0.1");//definindo localhost para do mysql
	define("usuario", "root");
	define("senha", "");
	define("bancoDeDados", "solicitachamado");

	$conexaoChamado = mysqli_connect(server, usuario, senha, bancoDeDados) or die("errorSoap");
	$setChamadoFinal = "insert INTO chamado(titulo, categoria, descricao, statusChamada, idChamado, email)VALUES('$tituloChamado', '$categoriaChamado', '$descricaoChamado', '$statusChamado', '$idChamado', '$email')";
	$resultChamado = mysqli_query($conexaoChamado, $setChamadoFinal);
}	

function realizarConsulta($dados){
	$dadosCliente = [];//variavel de retorno para o client
	$idCliente = $dados["id"];

	define("server", "127.0.0.1");//definindo localhost para do mysql
	define("usuario", "root");
	define("senha", "");
	define("bancoDeDados", "solicitachamado");

	$conexao = mysqli_connect(server, usuario, senha, bancoDeDados) or die("errorSoap");

	if ($dados['acesso'] != "adm") {

	$setConsulta = "select count(*) as qtd from chamado where idChamado = '$idCliente' order by numChamado asc";
	$result = mysqli_query($conexao, $setConsulta);
	$row = mysqli_fetch_assoc($result);

	$setConsulta3 = "select numChamado from chamado where idChamado = '$idCliente' order by numChamado asc";
	$result3 = mysqli_query($conexao, $setConsulta3);
	$row3 = mysqli_fetch_assoc($result3);
	$ini = $row3["numChamado"];

	for($i = 1; $i <= $row["qtd"]; $i++){

		$setConsulta2 = "select * from chamado where idChamado = '$idCliente' and numChamado = '$ini' order by numChamado asc";
		$result2 = mysqli_query($conexao, $setConsulta2);
		$row2["$i"] = mysqli_fetch_assoc($result2);

			do{

				$setConsulta2 = "select * from chamado where idChamado = '$idCliente' and numChamado = '$ii' order by numChamado asc";
				$result2 = mysqli_query($conexao, $setConsulta2);
				$row2["$i"] = mysqli_fetch_assoc($result2);

				$ii++;
				}while (empty($row2["$i"]));
		
		}

		$row2["numChamado"] = $row["qtd"];
		$row2["primeiro"] = $row3["numChamado"];

		}else{//selecionando dados para adm(onde volta todos os dados armazenados)

			$setConsulta = "select count(*) as qtd from chamado order by numChamado asc";
			$result = mysqli_query($conexao, $setConsulta);
			$row = mysqli_fetch_assoc($result);

			for ($i=1; $i <= $row["qtd"] ; $i++) { 
			$setConsulta2 = "select * from chamado where numChamado = '$i' order by numChamado asc";
			$result2 = mysqli_query($conexao, $setConsulta2);
			$row2["$i"] = mysqli_fetch_assoc($result2);
			$row2["numChamado"] = $row["qtd"];
			$row2["primeiro"] = $row3["numChamado"];
		}

	}
	
	if (true ) {//atribuindo valores em caso de sucesso
		return $row2;
	}else{
		$dadosCliente["TesteBanco"] = "errorSoap";
		return $dadosCliente;
	}
} 
	

function fecharChamado($dados){
	$dadosCliente = [];//variavel de retorno para o client
	$serial = $dados["serial"];
	$categoria = $dados["categoria"];
	$detalhes = $dados["detalhes"];
	$preco = $dados["preco"];
	$idChamado = $dados["id"];

	define("server", "127.0.0.1");//definindo localhost para do mysql
	define("usuario", "root");
	define("senha", "");
	define("bancoDeDados", "pagamento");

	$conexao = mysqli_connect(server, usuario, senha, bancoDeDados) or die("errorSoap");
	$setChamado = "insert INTO fechamento(serial, categoria, detalhes, preco)VALUES('$serial', '$categoria', '$detalhes', '$preco')";
	$result = mysqli_query($conexao ,$setChamado);

		if (true) {//atribuindo valores em caso de sucesso
			return true;
		}else{
			$dadosCliente["TesteBanco"] = "errorSoap";
			return $dadosCliente;
		}
	}	

function alteraStatusChamado($dados){
	$numChamado = $dados["numChamado"];
	define("server", "127.0.0.1");//definindo localhost para do mysql
	define("usuario", "root");
	define("senha", "");
	define("bancoDeDados", "solicitachamado");

	$conexao = mysqli_connect(server, usuario, senha, bancoDeDados) or die("errorSoap");
	$setChamado = "update chamado SET statusChamada = 1 WHERE numChamado = '$numChamado';";
	$result = mysqli_query($conexao ,$setChamado);
}	

	$server->handle();
?>















