Este projeto consiste na simulação de call center, sistema interno para empresas ou gerencia interna para pequenos negocios, uma vez que seu formato simplificado e direto permite facil adaptação ao sistema de negocio.
As tecnologia aplicadas neste projeto passam por PHP, MySQL, HTML, CSS, Boostrap, SOAP WebService) e uso do PHPMailer para envio de email.
A aplicação consiste em consultar um banco de dado listado com clientes (previamente listados pela empresa) e liberar acesso a este usuario, ele então poderá abrir chamados (simulando a requisição de um serviço), onde este é listado em um segundo banco de dados (simulando o back-end do consumo sobre serviço de terceiros) e fica aberto para que um colaborador/empresa prestadora de serviços supra essa necessidade.
O chamado passa por dois estados, em aberto (aberto pelo cliente e suprido com as informações de tal) e fechado (onde é dada a baixa no sistema após a resolução do problema) o que resulta no envio de email ao cliente com as informações do chamado.
**Parte deste Layout faz parte do curso de desenvolvimento web aplicado por Jamilton Damasceno e Jorge Sant Ana, do qual sou aluno.


-----------------------------------INFORMAÇÕES IMPORTANTES-----------------------------------------------

A divisão foi feita em três bancos distintos afim de simular a consulta em bancos de terceiros em projeto do meu curso de ADS. Para aqueles que desejam mudar a estrutura de banco é de extrema importancia que atualizem os metodos de consulta no arquivo "soap2.php" afim de evitar falhas.
**Para melhor aproveitamento, use algum Email valido para ter acesso as respostas encaminhadas ao final das etapas.
**O acesso administrativo (valor = "adm") permite a criação e encerramento além da consulta de seus e dos demais chamados criados por outros usuarios, já o acesso de usuario (valor = "user") tem apenas a permissão de criação e acesso de seus próprios chamados.
**Para usar o PHPMAILER junto ao email, é necessário mudar a permissão no proprio provedor (Não recomendado para seu email pessoal, use apenas com uma conta teste). 
Caminho no Gmail: Gerencie sua conta Google -> Segurança -> Acesso a App Menos Seguro -> Ativar Acesso.	



-----------------------------------Comando SQL para Criação dos bancos-----------------------------------

-CREATE DATABASE BancoClientes
-CREATE TABLE login_cliente(
	email varchar(80) NOT null,
    senha varchar(240) not null,
    id int not null,
    acesso varchar(40) not null
);

**IMPORTANTE: Preencher com criptografia MD5() no ato de popular o campo senha**
Ex: INSERT INTO login_cliente(senha)VALUES(MD5('suaSenhaAqui'));

**IMPORTANTE: o campo "acesso" deverá receber valores de "adm" (para acesso administrativo) e "user" (para acesso de usuario). 

-CREATE DATABASE BancoClientes
-CREATE TABLE fechamento(
	serial varchar(240) not null,
    categoria varchar(240) not null,
    detalhes varchar(240) not null,
    preco int not null
);

-CREATE DATABASE solicitachamado
-CREATE TABLE fechamento(
	titulo varchar(240) not null,
    categoria varchar(240) not null,
    descricao text NOT null,
    statusChamada int not null,
    idChamado int not null,
    numChamado int AUTO_INCREMENT, 
    email varchar(240) not null
);