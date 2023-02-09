<?php

#Con GetUpdates

$nombre=$_POST['name'];
$correo=$_POST['email'];
$compania=$_POST['company'];
$telefono=$_POST['phone'];
$mensaje=$_POST['message'];

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set('America/Argentina/Buenos_Aires');

$token = "TOKEN_ID";
$msg = "
Nombre: $nombre
Correo: $correo
Compania: $compania
Telefono: $telefono
Mensaje: $mensaje
";

$datos = [
    'chat_id' => '-100XXXXXXXXX',
    'text' =>  $msg,
    'parse_mode' => 'HTML' #formato del mensaje
];
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot" . $token . "/sendMessage");
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, $datos);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$r_array = json_decode(curl_exec($ch), true);

curl_close($ch);
if ($r_array['ok'] == 1) {
    echo "Mensaje enviado.";
} else {
    echo "Mensaje no enviado.";
    print_r($r_array);
}