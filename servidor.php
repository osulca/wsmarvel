<?php
require_once "ConexionDB.php";
//detectar el tipo de request
$metodo = $_SERVER["REQUEST_METHOD"];
//procesar el request
switch ($metodo) {
    //TODO: Conectarnos a la BD (CRUD)
    case "GET":
        if (isset($_GET["password"])) {
            $data = $_GET["password"];
            $password = "manzanita";
            if ($data == $password) {
                echo json_encode(traerDatos());
            } else {
                echo json_encode(array("Resultado" => "password incorrecto"));
            }
        }else{
            echo json_encode(array("Resultado" => "dato faltante"));
        }
        break;
    case "POST":
        $codigo = $_POST["codigo"];
        $nombres = $_POST["nombres"];
        $apellidos = $_POST["apellidos"];
        $telefono = $_POST["telefono"];
        $email = $_POST["email"];
        $id_pa = $_POST["id_pa"];
        $resultado = guardarDatos($codigo, $nombres, $apellidos, $telefono, $email, $id_pa);
        if ($resultado) {
            $mensaje = "Datos Guardados";
        } else {
            $mensaje = "Datos No Guardados";
        }
        echo json_encode(array("Resultado" => $mensaje));
        break;
    case "PATCH":
        echo "utilizaste el metodo " . $metodo;
        break;
    case "DELETE":
        echo "utilizaste el metodo " . $metodo;
        break;
}


function traerDatos()
{
    try {
        $db = new ConexionDB();
        $conn = $db->abrirConexion();

        $sql = $query = "SELECT  * FROM estudiantes";
        $respuesta = $conn->prepare($sql);
        $respuesta->execute();
        $result = $respuesta->fetchAll();

        $db->cerrarConexion();
        return $result;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

}

function guardarDatos($codigo, $nombres, $apellidos, $telefono, $correo, $id_pa)
{
    try {
        $db = new ConexionDB();
        $conn = $db->abrirConexion();

        $sql = "INSERT INTO estudiantes(codigo, nombres, apellidos, telefono, correo, id_pa) VALUES('$codigo','$nombres','$apellidos', '$telefono', '$correo', $id_pa )";
        $respuesta = $conn->prepare($sql);
        $respuesta->execute();
        $numRows = $respuesta->rowCount();
        if ($numRows != 0) {
            $result = true;
        } else {
            $result = false;
        }

        $db->cerrarConexion();

        return $result;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
