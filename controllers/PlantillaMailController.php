<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../components/PHPMailer/Exception.php';
require '../components/PHPMailer/PHPMailer.php';
require '../components/PHPMailer/SMTP.php';

$hash = md5(rand(0,1000));
$host = $_SERVER["HTTP_HOST"];
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'devmail173@gmail.com';
    $mail->Password   = 'WCPZFyMKqdREU42';
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    //Recipients
    $mail->setFrom('devmail173@gmail.com', 'Proyecto Banco');
    $mail->addAddress('correo_destino', 'nombre_destino');

    //Content
    $mail->isHTML(true);
    $mail->Subject = 'Verificar Cuenta';
    $mail->Body    = 'Este correo es para <b>Verificar su cuenta!</b><p>Acceda al siguiente link para poder activar su cuenta:</p><p>http://'.$host.'/verify.php?email='.$email.'&hash='.$hash.'</p>';

    $mail->send();
    // echo 'Message has been sent';
    header('location: ../index.php');
} catch (Exception $e) {
    echo "Hubo error al enviar el correo de email: {$mail->ErrorInfo}";
}
?>