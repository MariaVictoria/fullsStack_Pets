<?php
$nombre= $_POST ['name'];
$emai =$_POST['email'];
$asunto= $_POST['subject'];
$mensaje= $_POST ['message'];

$mensaje = ' Este mensaje fue enviado por : ' . $nombre . ",\r\n";
$mensaje = " Su email es : " . $emai. ",\r\n";
$mensaje = " El asunto es : " . $asunto . ",\r\n";
$mensaje = " El mensaje es :" . $_POST . ",\r\n";
$mensaje = " Enviado el día : " . date('d/m/y' , time());

$para = 'victoriacursos2022@gmail.com';
$asunto =  'mensaje del formulario de "PETS" '

// funcion propia de php
mail ($para , $asunto , utf8_decode($mensaje), $header);

//header es redireccionamiento

header('Location : exito.html')
?>