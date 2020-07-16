<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body class="container mt-5">
    <form action="#" method="post">
        <input type="text" name="personaje"/>
        <input type="submit" name="submit" value="buscar"/>
    </form>
    <?php
if(isset($_POST["submit"])){
    echo "<br>";
$publicKey = "5c465051a788252db815c7bd342d97a1";
$privateKey = "68d5d07dd7a4ff064c19956ba9b3027df293824c";
$ts = "23";
$hash = md5($ts.$privateKey.$publicKey);

$personaje = $_POST["personaje"];
$personaje = str_replace(" ", "+", $personaje);

$URI = "https://gateway.marvel.com/v1/public/characters?name=$personaje&apikey=$publicKey&ts=$ts&hash=$hash";

$response = file_get_contents($URI);

$datos = json_decode($response, true);

if($datos["data"]["results"]!=null){
    $imagen = $datos["data"]["results"][0]["thumbnail"]["path"].".".$datos["data"]["results"][0]["thumbnail"]["extension"];
    echo "<table class='table'>
            <tr>
                <td><img src='$imagen' class='img-thumbnail' style='height: 200px;'/></td>
                <td style='width: 80%''>
                    <b>Nombre: </b>".$datos["data"]["results"][0]["name"]."<br>
                    <b>Descripcion: </b>".$datos["data"]["results"][0]["description"]."
                </td>
            <tr>
         </table>";

    echo "<h3>Comics</h3><ol>"; 
    $comics = $datos["data"]["results"][0]["comics"];   
    //var_dump($comics);
    foreach($comics["items"] as $comic){
        echo "<li><a href='".$comic["resourceURI"]."?apikey=$publicKey&ts=$ts&hash=$hash'>".$comic["name"]."</a></li>";
    }
    echo "</ol>";
    //echo $comics["items"][0]["name"]; 
}else{
    echo "resultados no encontrados";
}


}
?>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</html>
