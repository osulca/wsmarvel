<?php

class ClienteWS {
    private $URI = "http://localhost/webservice/servidor.php?password=manzanita";


// GET con file_get_contents
// $dataRaw = file_get_contents($URI);
// $data = json_decode($dataRaw, true);

    public function myGET()
    {
    // GET con curl
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->URI);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $resultado = curl_exec($ch);
        curl_close($ch);

        echo $resultado;
    }

    public function myPOST($codigo, $nombres, $apellidos, $telefono, $email, $id_pa)
    {
    // POST con curl
        $enviar = array(
            "codigo" => $codigo,
            "nombres" => $nombres,
            "apellidos" => $apellidos,
            "telefono" => $telefono,
            "email" => $email,
            "id_pa" => $id_pa,
        );

        $ch = curl_init($this->URI);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $enviar);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $resultado = curl_exec($ch);
        curl_close($ch);

        echo $resultado;
    }

    public function myDELETE($id)
    {
    // DELETE con curl
        $URI2 = "http://localhost/webservice/servidor.php?password=manzanita&id=$id";

        $ch = curl_init($URI2);

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $resultado = curl_exec($ch);
        curl_close($ch);

        echo $resultado;
    }

    public function myPATCH($id, $codigo, $nombres, $apellidos, $telefono, $email, $id_pa)
    {
    // PATCH con curl
        $URI = "http://localhost/webservice/servidor.php?id=$id&codigo=$codigo&nombres=$nombres&apellidos=$apellidos&telefono=$telefono&email=$email&id_pa=$id_pa";

        $ch = curl_init($URI);

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $resultado = curl_exec($ch);
        curl_close($ch);

        echo $resultado;
    }
}