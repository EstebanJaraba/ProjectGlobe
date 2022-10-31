<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
require '../phpMailer/Exception.php';
require '../phpMailer/PHPMailer.php';
require '../phpMailer/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'db/conexion.php';
if($_POST['accion'] == 'recuperarContra'){
  $correo = $_POST['correo'];

  $query = "SELECT * FROM users WHERE email='$correo'";

  $file = mysqli_query($conexion,$query);
  
  $filenew = mysqli_num_rows($file);
  $nombre = mysqli_fetch_array($file);
  $contraseña = $nombre['passwordUser'];
  if($filenew > 0){
    try {
    
      $mail = $correo;
      $asunto = "Recuperacion de clave";
      $cuerpo = "Su contraseña es: '$contraseña'";
        //Server settings
        $mail->isSMTP();
        $mail->CharSet = "UTF8";  
        $mail->SMTPDebug=0;                                       //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'nestortaranguife@gmail.com';                     //SMTP username
        $mail->Password   = 'zresqayqnrvdnltx';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('nestortaranguife@gmail.com', 'Globe');
        $mail->addAddress($correo);     //Add a recipient
        // $mail->addAddress('ellen@example.com');               //Name is optional
        // $mail->addReplyTo('info@example.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');
    
        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $asunto;
        $mail->Body    = $cuerpo;
        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
        $mail->send();
        echo json_encode('ok');
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
  }

  
}
//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

