<?php
include 'header.php';
try{
    $conn = mysqli_connect($servidor,$usuario,$pass,$baseDatos);
    if(!$conn){
        echo'{"codigo:400, "mensaje":"Error intentando conectae!!","respuesta"}';
    }else{
        if(isset($_GET['usuario'])){
            $usuario=$_GET['usuario'];
            $sql="Select *FROM `usuarios` WHERE `usuario`='$usuario';";
            $resultado=$conn->query($sql);
            if($resultado->num_rows>0){
                echo'{"codigo":202, "mensaje":"El usario existe en el sistema!!","respuesta"}';
            }else{
                echo'{"codigo":203,"mensaje":"El usuario no existe!!","respuesta":"0"}';
            }
        }else{
            echo'{"codigo":402, "mensaje":"Falta datos para ejecutar la acción solicitada!!"}';
        }
    }
}catch(Exception $e){
    echo'{"codigo":400, "mensaje":"Errot Intente Conectar!!","respuesta":"error2"}';
}