<?php 
session_start();//sempre iniciar o session para ter acesso ao array;
	$_SESSION;
	/*
	unset($_SESSION["validando"]);//unset retira especificamente algum item do array sem comprometer os outros(the same as pop);
	*/
	session_destroy(); //esta funççao destroy por completo o array session (e por sequencia, destroy todos os seus itens), deve ser seguido de REDIRECIONAMENTO (como pagina index ou outra default) para não criar instabilidade de acesso.

	header("Location: index.php");//função para redirecionamento,

?>