<?php
require "http/db/conexion.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Globe | LOGIN</title>

  <link href="assets/dist/img/icon empre.jpeg" rel="icon">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
  <!-- CDN para sweetalert -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="../view/app/recuperar.app.js"> </script>
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="" class="h1"><b>Globe</b></a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">¿Olvidaste tu contraseña?</p>
        <form action="forgotPassword.php" method="post" id="recoverForm">
          <div class="input-group mb-3">
            <input type="email" name="correo" id="email" class="form-control" placeholder="Correo">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <button type="submit" name="recuperar" id="recuperar" class="btn btn-primary btn-block">Enviar</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
        <p class="mt-3 mb-1 text-lg-right">
          <a href="../indexLogin.php">Regresar</a>
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <?php

  require 'PHPMailer/Exception.php';
  require 'PHPMailer/PHPMailer.php';
  require 'PHPMailer/SMTP.php';

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

  $mail = new PHPMailer(true);

  include 'http/db/conexion.php';

  if (isset($_POST['recuperar'])) {

    $correo_recuperar = $_POST['correo'];
    $pass = substr(md5(microtime()), 1, 10);

    $sql = "SELECT * FROM users WHERE email = '$correo_recuperar'";
    $res = mysqli_query($conexion, $sql);
    $n = mysqli_num_rows($res);

    if ($n > 0) {
      try {
        $mailRecipient = $correo_recuperar;
        $subject = "Solicitud de recuperación de contraseña.";
        $body = "Hola, '$correo_recuperar', el sistema le ha generado la siguiente contraseña: '$pass'";

        //Server settings
        $mail->CharSet = "UTF8";
        $mail->SMTPDebug = 0;                               //Enable verbose debug output
        $mail->isSMTP();                                    //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';               //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                           //Enable SMTP authentication
        $mail->Username   = 'fernandogarces925@gmail.com';  //SMTP username
        $mail->Password   = 'durbpfgpvphzqyvl';             //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;    //Enable implicit TLS encryption
        $mail->Port       = 465;                            //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('fernandogarces925@gmail.com', 'Globe');
        $mail->addAddress($mailRecipient);     //Add a recipient

        //Content
        $mail->isHTML(true);                   //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $body;

        $mail->send();
  ?>
        <script>
          Swal.fire({
            icon: 'success',
            title: '¡Correo electrónico enviado!',
            confirmButtonText: 'Aceptar',
          })
        </script>
      <?php
      } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      }
      $passC = password_hash($pass, PASSWORD_DEFAULT);
      $query = "UPDATE users SET passwordUser = '$passC' WHERE email = '$correo_recuperar'";

      $resultado = mysqli_query($conexion, $query);

      if ($resultado) {
      ?>
        <script>
          Swal.fire({
            heightAuto: false,
            position: 'center',
            icon: 'success',
            confirmButtonText: 'Aceptar',
            text: '¡Correo electrónico enviado!',
          }).then(function(isConfirm) {
            if (isConfirm) {
              location.href = '../indexLogin.php';
            } else {

            }
          });
        </script>
      <?php
      }
    } else {
      ?>
      <script>
        Swal.fire({
          icon: 'warning',
          heightAuto: false,
          position: 'center',
          text: '¡Correo electrónico no encontrado!',
          confirmButtonText: 'Aceptar',
        })
      </script>
  <?php
    }
  }

  ?>


  <!-- jQuery -->
  <script src="assets/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="assets/dist/js/adminlte.min.js"></script>
</body>

</html>