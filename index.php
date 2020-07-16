<form action="#" method="post">
    <input type="text" name="personaje"/>
    <input type="submit" name="submit" value="buscar"/>
</form>
<?php
$publicKey = "5c465051a788252db815c7bd342d97a1";
$privateKey = "68d5d07dd7a4ff064c19956ba9b3027df293824c";
$ts = "1";
$hash = md5($ts.$privateKey.$publicKey);

$personaje = $_POST["personaje"];
$URI = "https://gateway.marvel.com/v1/public/characters?name=$personaje&apikey=$publicKey&ts=$ts&hash=$hash";

echo $response = file_get_contents($URI);

?>
