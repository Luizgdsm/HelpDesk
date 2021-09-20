<?php

	require "./biblioteca/Exception.php";//importando biblioteca de PHPMAILER (envio de Email)
	require "./biblioteca/OAuth.php";
	require "./biblioteca/PHPMailer.php";
	require "./biblioteca/POP3.php";
	require "./biblioteca/SMTP.php";

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

    function EnviarEmailChamado($dados){
    $email = $dados["email"];
    $titulo = $dados["titulo"];
    $categoria = $dados["categoria"];
    $descricao = $dados["descricao"];
    $id = $dados["id"];
    
   $mail = new PHPMailer(true);

   try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                           //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                 //Enable SMTP authentication

    //Sempre que possivel, manter campos Username e Password em diretorio separado, por questões de segurança
    $mail->Username   = 'SEU EMAIL AQUI (que deve encaminhar a mensagem do sistema)';         //SMTP username
    $mail->Password   = 'SENHA DO EMAIL';                     //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;       //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                  //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('SEU EMAIL AQUI', 'HelpDesk Chamados');//endereço de remetente
    $mail->addAddress($email, 'Cliente');//endereço de destinatário
    
    //$mail->addAddress('ellen@example.com'); //Name is optional
    $mail->addReplyTo('SEU EMAIL AQUI', 'Duvidas? Entre em contato:');//endereço para respostas de destinatário
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');   //Optional name
    

    //Content

    $mail->isHTML(true);                                  //Set email format to HTML
    

    //utilizando o objeto para o get das informações fornecidas pelo usuário de forma dinamica.
    $mail->Subject = "Abertura de Chamado";
    $mail->Body    = 
    "
    <table width='100%' align='center'>
      <tr align='center' bgcolor='#343a40'>
        <th >
          <h4><font color='white'>Help Desk</font></h4>
        </th>
        <tr>
        <td> 
            Olá,<br>
            Agradecemos a confiança em nossa equipe, neste email você reberá mais detalhes sobre 
            o chamado aberto por você.<br><br>
            <h4>Informações de Chamado:</h4>
            Chamado: $titulo.<br>     
            Categoria: $categoria.<br>
            Descrição: $descricao.<br> 
            Numero de Chamado: $id.<br>
            
            Em breve entraremos em contato com mais informações de seu pedido.<br>
            Caso encontre alguma divergencia no serviço solicitado e/ou prestado, entre em contato com nossa equipe por este mesmo email.<br>
            <br>
            Att.
        </td>
        </tr>
      </tr>
    </table>
    ";
    $mail->AltBody = "Chamados HelpDesk";

    //Area de debug
    $mail->send();
     
} catch (Exception $e) {
    return false; 
}

}

	function EnviarEmailEncerramento($dados){
	$serial = $dados["serial"];
	$categoria = $dados["categoria"];
	$detalhes = $dados["detalhes"];
	$preco = $dados["preco"];
	$tituloChamado = $dados["tituloChamado"];
	$categoriaChamado = $dados["categoriaChamado"];
	$descricaoChamado = $dados["descricaoChamado"];
	$statusChamada = $dados["statusChamada"];
	$idChamado = $dados["idChamado"];
	$numChamado = $dados["numChamado"];
	$email = $dados["email"];
	
   $mail = new PHPMailer(true);


   try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                           //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                 //Enable SMTP authentication

    //Sempre que possivel, manter campos Username e Password em diretorio separado, por questões de segurança
    $mail->Username   = 'SEU EMAIL AQUI (que deve encaminhar a mensagem do sistema)';         //SMTP username
    $mail->Password   = 'SENHA DO EMAIL';                     //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;       //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                  //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('SEU EMAIL AQUI', 'HelpDesk Chamados');//endereço de remetente
    $mail->addAddress($email, 'Cliente');//endereço de destinatário
    
    //$mail->addAddress('ellen@example.com'); //Name is optional
    $mail->addReplyTo('SEU EMAIL AQUI', 'Duvidas? Entre em contato:');//endereço para respostas de destinatário
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');   //Optional name
    

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML

    //utilizando o objeto para o get das informações fornecidas pelo usuário de forma dinamica.
    $mail->Subject = "Encerramento de Chamado";
    $mail->Body    = 
    "
    <table width='100%' align='center'>
      <tr align='center' bgcolor='#343a40'>
        <th >
          <h4><font color='white'>Help Desk</font></h4>
        </th>
        </tr>
        <td> 
            Olá,<br>
            Agradecemos a confiança em nossa equipe, neste email você reberá mais detalhes sobre 
            a resolução ao chamado aberto por você.<br><br>
            <h3>Informações de Chamado:</h3>
            Chamado: $tituloChamado.<br>     
            Categoria: $categoriaChamado.<br>
            Descrição: $descricaoChamado.<br> 
            <h3>Informações de Serviço:</h3>
            Serial: $serial.<br> 
            Categoria de serviço: $categoria.<br>
            detalhesdo Serviço: $detalhes.<br>
            Preço Final: R$ $preco (Adicionado automaticamente a sua fatura mensal).<br><br> 
            
            Caso encontre alguma divergencia no serviço solicitado e/ou prestado, entre em contato com nossa equipe por este mesmo email.<br>
            <br>
            Att.
        </td>
        </tr>
      </tr>
    </table>
    ";
    $mail->AltBody = "Chamados HelpDesk";

    //Area de debug
    $mail->send();
     
} catch (Exception $e) {
	return false; 
}

}
	
?>