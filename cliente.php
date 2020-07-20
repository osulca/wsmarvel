<?php
$URI = "http://localhost/webservice/servidor.php?password=manzanita";
$dataRaw =  file_get_contents($URI);
$data = json_decode($dataRaw, true);
// var_dump($data);

// GET con curl
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $URI);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$resultado = curl_exec($ch);
curl_close($ch);

var_dump($resultado);

// POST con curl
$enviar = array(
    "codigo" => "200434134",
    "nombres" => "Andres",
    "apellidos" => "Soto Muniz",
    "telefono" => "12132144",
    "email" => "ssdg@ggmail.com",
    "id_pa" => 2,
);

$ch = curl_init($URI);

curl_setopt($ch, CURLOPT_POSTFIELDS, $enviar);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$resultado = curl_exec($ch);
curl_close($ch);

var_dump($resultado);
