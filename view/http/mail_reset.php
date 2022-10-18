<?php
// Multiple recipients
$to = 'Papercut@papercut.com'; // note the comma

// Subject
$subject = 'Restablecer password Globe';
$codigo = rand(1000,9999);

// Message
$message = '
<html>
<head>
  <title>Birthday Reminders for August</title>
</head>
<body>
  <h1>Here are the birthdays upcoming in August!</h1>
  <div style="text-align:center; background-color:#ccc">
  <p>Restablecer contraseña</p>
    <h3>'.$codigo.'</h3>
  <p><small>Ignorelo</small></p>
  </div>
  
</body>
</html>
';

// To send HTML mail, the Content-type header must be set
$headers[] = 'MIME-Version: 1.0';
$headers[] = 'Content-type: text/html; charset=iso-8859-1';

// // Additional headers
// $headers[] = 'To: Mary <mary@example.com>, Kelly <kelly@example.com>';
// $headers[] = 'From: Birthday Reminder <birthday@example.com>';
// $headers[] = 'Cc: birthdayarchive@example.com';
// $headers[] = 'Bcc: birthdaycheck@example.com';

// Mail it
mail($to, $subject, $message, implode("\r\n", $headers));
?>