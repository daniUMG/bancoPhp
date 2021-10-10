<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../components/PHPMailer/Exception.php';
require '../components/PHPMailer/PHPMailer.php';
require '../components/PHPMailer/SMTP.php';

include('../db/conection.php');

$host = $_SERVER["HTTP_HOST"];
$mail = new PHPMailer(true);

	if($_SERVER["REQUEST_METHOD"] == "POST") {
		// header("Content-Type: text/plain");
	$apellido = $_POST['apellido'];
    $nombre = $_POST['nombre'];
    $telef = $_POST['telefono'];
    $correo = $_POST['email'];
    $password = $_POST['password'];
    $password = MD5('$password');
    $hash = md5(rand(0,1000));
	$sql = "INSERT INTO usuario (apellido, nombre, telefono, email, password, estado, hash) VALUES ('$apellido', '$nombre', '$telef', '$correo', '$password', 0, '$hash')";

    if ($resultado = $conexion->query($sql)) {
	    if($resultado >= 1) {
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
				$mail->addAddress($correo);

				//Content
				$mail->isHTML(true);
				$mail->Subject = 'Verificar Cuenta';
				$mail->Body    = 'Este correo es para <b>Verificar su cuenta!</b><p>Acceda al siguiente link para poder activar su cuenta:</p><p>http://'.$host.'/views/verificarEmail.php?email='.$correo.'&hash='.$hash.'</p>';

				$mail->send();
				echo 'Mensaje enviado';
				// header('location: ../index.php');
				// echo "<script>alert('Usuario Registrado de manera Exitosa!');</script>";
			} catch (Exception $e) {
				echo "Hubo error al enviar el correo de email: {$mail->ErrorInfo}";
			}
		} else {
			echo "<script>alert('Error: Se produjo un error al intentar guardar los datos, revise que haya ingresado todo correctamente.');</script>";
		}
    } else {
    	printf("Error: ", $sql->error);
    } 
}
?>