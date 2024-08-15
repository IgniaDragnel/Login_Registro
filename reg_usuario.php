<?php
include 'header.php';
try {
    $conn = mysqli_connect($servidor, $usuario, $pass, $baseDatos);
    if (!$conn) {
        echo '{"codigo":400, "mensaje":"Error intentando conectar!!","respuesta";""}';
    } else {
        if (
            isset($_POST['usuario']) &&
            isset($_POST['pass']) &&
            isset($_POST['jugador']) &&
            isset($_POST['nivel'])
        ) {

            $usuario = $_POST['usuario'];
            $pass = $_POST['pass'];
            $jugador = $_POST['jugador'];
            $nivel = $_POST['nivel'];

            $sql = "SELECT * FROM `usuarios` WHERE `usuario`='$usuario';";
            $resultado = $conn->query($sql);
            if ($resultado->num_rows > 0) {
                echo '{"codigo":403, "mensaje":"El usuario ya existe!!","respuesta":"' . $resultado->num_rows . '"}';
            } else {
                $sql = "INSERT INTO `usuarios` (`id`, `usuario`, `pass`, `jugador`, `nivel`) 
                VALUES (NULL, '$usuario', '$pass', '$jugador', '$nivel');";
                if ($conn->query($sql) == TRUE) {
                    $sql = "SELECT*FROM `usuarios`WHERE`usuario`='$usuario';";
                    $resultado = $conn->query($sql);
                    $texto = '';
                    while ($row=$resultado->fetch_assoc()) {
                        $texto="{\\\"id\\\":".$row['id'].",\\\"usuario\\\":\\\"".$row['usuario']."\\\",\\\"pass\\\":\\\"".$row['pass']."\\\",\\\"jugador\\\":".$row['jugador'].",\\\"nivel\\\":".$row['nivel'].",\\\"puntaje\\\":".$row['puntaje']."}";
                    }
                    echo '{"codigo":201, "mensaje":"Usuario creado correctamente!!","respuesta":".$texto"}';
                } else {
                    echo '{"codigo":401, "mensaje":"Error intentando crear el usuario!!","respuesta":""}';
                }
            }
        } else {
            echo '{"codigo":402, "mensaje":"Faltan datos para ejecutar la accion solicitada!!","respuesta":""}';
        }
    }
} catch (Exception $e) {
    echo '{"codigo":400, "mensaje":"Error intentando conectar!!","respuesta":""}';
}