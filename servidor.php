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
        $id = $_GET["id"];
        $codigo = $_GET["codigo"];
        $nombres = $_GET["nombres"];
        $apellidos = $_GET["apellidos"];
        $telefono = $_GET["telefono"];
        $email = $_GET["email"];
        $id_pa = $_GET["id_pa"];

        if(actualizarDatos($id, $codigo, $nombres, $apellidos, $telefono, $email, $id_pa)){
            $mensaje = "datos actualizados";
        }else{
            $mensaje = "Error, no se actualizaron los datos";
        }
        echo json_encode(array("Resultado" => $mensaje));
        break;
    case "DELETE":
        $id = $_GET["id"];
        if(eliminarDatos($id)){
            $mensaje = "datos eliminados";
        }else{
            $mensaje = "Error, no se eliminaros los datos";
        }
        echo json_encode(array("Resultado" => $mensaje));
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
        $data = array();
        $i = 0;
        foreach ($result as $estudiante){
            $data[$i] = array(
                "nombres" => $estudiante["nombres"],
                "apellidos" => $estudiante["apellidos"],
            );
            $i++;
        }
        return $data;
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

function eliminarDatos($id)
{
    try {
        $db = new ConexionDB();
        $conn = $db->abrirConexion();

        $sql = "DELETE FROM estudiantes WHERE id=$id";
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

function actualizarDatos($id, $codigo, $nombres, $apellidos, $telefono, $correo, $id_pa)
{
    $id = (int) $id;
    $id_pa = (int) $id_pa;
    try {
        $db = new ConexionDB();
        $conn = $db->abrirConexion();

        $sql = "UPDATE estudiantes 
                SET codigo='$codigo', nombres='$nombres', apellidos='$apellidos', telefono='$telefono', correo='$correo', id_pa=$id_pa 
                WHERE id=$id";
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
