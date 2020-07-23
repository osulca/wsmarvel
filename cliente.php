<?php
$URI = "http://localhost/webservice/servidor.php?password=manzanita";

/*
// GET con file_get_contents
$dataRaw =  file_get_contents($URI);
$data = json_decode($dataRaw, true);

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

// DELETE con curl
$id = 21;
$URI2 = "http://localhost/webservice/servidor.php?password=manzanita&id=$id";

$ch = curl_init($URI2);

curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$resultado = curl_exec($ch);
curl_close($ch);

echo $resultado;

*/
// PATCH con curl
$URI = "http://localhost/webservice/servidor.php?id=26&codigo=200434134&nombres=Pedro&apellidos=Torres+Mata&telefono=12132144&email=ssdg@ggmail.co&id_pa=1";

$ch = curl_init($URI);

curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$resultado = curl_exec($ch);
curl_close($ch);

var_dump($resultado);
