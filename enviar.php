<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if(isset($_POST['enviar'])){
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; 
        $mail->SMTPAuth   = true;
        $mail->Username   = 'pedrofts2005@gmail.com';
        $mail->Password   = 'vaym xuxe rzbn igga';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;
        $mail->setFrom('pedrofts2005@gmail.com', 'Hospital Rio Grande');
        $mail->addAddress($_POST['email'], $_POST['nome']); 
        $mail->addReplyTo('info@example.com', 'Information');

        $mail->isHTML(true);
        $mail->Subject = '';
        $body = "Mensagem do Hospital Rio Grande <br>
                 Nome: ". $_POST['nome']."<br>
                 E-mail: ". $_POST['email']."<br>
                 Mensagem:<br>
                 ". $_POST['msg'];

        $mail->Body    = $body;
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
else{
    echo "ERRO AO ENVIAR";
}
?>