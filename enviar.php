<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// Definição das constantes SMTP
define('SMTP_HOST', 'smtp.seuservidor.com');
define('SMTP_USER', 'seu_email@seuservidor.com');
define('SMTP_PASS', 'sua_senha');
define('SMTP_PORT', 587);

$post = filter_input_array(INPUT_POST);

$nome = $post['nome'];
$email = $post['email'];
$mensagem = $post['mensagem'];

$body = "
<div style='background:#CCC; padding: 60px'>
    <div style='background:#FFF; padding: 20px; font-family: arial; font-size: 14px; width:600px; margin:auto;'>
        <h3>Formulário de contato do site</h3>
        <strong>Nome:</strong>
        {$nome}
        <br>
        <strong>E-mail:</strong>
        {$email}
        <br>
        <strong>Mensagem:</strong>
        {$mensagem}
    </div>
</div>    
";

$mail = new PHPMailer(true);

try {
    // Configurações do servidor SMTP
    $mail->isSMTP();
    $mail->Host       = SMTP_HOST;
    $mail->SMTPAuth   = true;
    $mail->Username   = SMTP_USER;
    $mail->Password   = SMTP_PASS;
    $mail->Port       = SMTP_PORT;
    $mail->CharSet    = 'utf8'; // utf8 / iso-8859-1

    // Remetente e destinatário
    $mail->setFrom(SMTP_USER, 'Seu Nome');
    $mail->addAddress('ph4261009@gmail.com', 'Nome Destinatário');

    // Conteúdo do e-mail
    $mail->isHTML(true);
    $mail->Subject = 'Contato do Site: ' . $nome;
    $mail->Body    = $body;

    // Enviar e-mail
    $mail->send();
    
    // Redirecionamento após envio bem-sucedido
    header("location: retorno.php");
    exit;
} catch (Exception $e) {
    // Tratamento de erro
    echo "Erro ao enviar o e-mail: {$mail->ErrorInfo}";
}
?>
