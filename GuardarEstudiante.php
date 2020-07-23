<form method="post" action="<?=$_SERVER["PHP_SELF"]?>">
    <input type="text" name="codigo" placeholder="codigo"><br>
    <input type="text" name="nombres" placeholder="nombres"><br>
    <input type="text" name="apellidos" placeholder="apellidos"><br>
    <input type="text" name="telefono" placeholder="telefono"><br>
    <input type="text" name="email" placeholder="email"><br>
    <input type="text" name="id_pa" placeholder="id_pa"><br>
    <input type="submit" name="submit" value="Guardar">
</form>
<?php
if(isset($_POST["submit"])){
    include_once "ClienteWS.php";
    $cliente = new ClienteWS();
    $cliente->myPOST($_POST["codigo"], $_POST["nombres"], $_POST["apellidos"], $_POST["telefono"], $_POST["email"], $_POST["id_pa"]);
}
