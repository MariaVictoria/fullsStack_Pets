<?php
$nombre = $_POST['name'];
$email = $_POST['email'];
$asunto = $_POST['subject'];
$mensaje = $_POST['message'];

$mensaje = 'Este mensaje fue enviado por: ' . $nombre . ",\r\n";
$mensaje .= "Su email es: " . $email . ",\r\n";
$mensaje .= "El asunto es: " . $asunto . ",\r\n";
$mensaje .= "El mensaje es: " . $mensaje . ",\r\n"; // Aquí deberías usar la variable $mensaje que has definido arriba, no $_POST
$mensaje .= "Enviado el día: " . date('d/m/y', time());

$para = 'victoriacursos2022@gmail.com';
$asunto = 'Mensaje del formulario de "PETS"';

// funcion propia de php
mail($para, $asunto, utf8_decode($mensaje));

//header es redireccionamiento
header('Location: exito.html');
?>
