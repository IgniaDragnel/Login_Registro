<?php
include 'header.php';
try {
    $conn = mysqli_connect($servidor, $usuario, $pass, $baseDatos);
    if (!$conn) {
        echo '{"codigo":400, "mensaje":"Error intentando conectar!!","respuesta";""}';
    } else {
        if (
            isset($_GET['usuario']) &&
            isset($_GET['pass']) &&
            isset($_GET['pass2']) &&
            isset($_GET['jugador']) &&
            isset($_GET['nivel'])
        ) {

            $usuario = $_GET['usuario'];
            $pass = $_GET['pass'];
            $pass2 = $_GET['pass2'];
            $jugador = $_GET['jugador'];
            $nivel = $_GET['nivel'];

            $sql = "SELECT * FROM `usuarios` WHERE `usuario`='$usuario'and`pass`='$pass' ;";
            $resultado = $conn->query($sql);
            if ($resultado->num_rows > 0) {
                //echo '{"codigo":403, "mensaje":"El usuario ya existe!!","respuesta":"' . $resultado->num_rows . '"}';
                $sql="UPDATE `usuarios`SET`pass`='".$pass2."', `jugador`='".$jugador."',`nivel`='".$nivel."' WHERE `usuario`='$usuario'; ";
                $conn->query($sql);
                $sql = "SELECT * FROM `usuarios` WHERE `usuario`='$usuario';";
                $resultado = $conn->query($sql);
                $texto = '';
                while ($row = $resultado->fetch_assoc()) {
                    $texto = "{
                    #id#:" . $row['id'] . ",
                    #usuario#:" . $row['usuario'] . ",
                    #pass#:" . $row['pass'] . ",
                    #jugador#:" . $row['jugador'] . ",
                    #nivel#:" . $row['nivel'] . "
                    }";
                }
                echo '{"codigo":206, "mensaje":"Usuario editado correctamente!!","respuesta";"' . $texto . '"}';


            } else {
                echo '{"codigo":204, "mensaje":"Error el usuario o contrasenia son incorrectos!!","respuesta";""}';               
            }
        } else {
            echo '{"codigo":402, "mensaje":"Faltan datos para ejecutar la accion solicitada!!","respuesta";""}';
        }
    }
} catch (Exception $e) {
    echo '{"codigo":400, "mensaje":"Error intentando conectar!!","respuesta";""}';
}

// include 'footer.php';+