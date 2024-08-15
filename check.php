<?php
include 'header.php';
try{
    $conn=mysqli_connect($servidor, $usuario, $pass, $baseDatos);
    if(!$conn){
        echo'{"codigo":400, "mensaje":"Error intentano conectar!!",
            "respuesta":""}';
    }else{
        echo'{"codigo":200, "mensaje":"Conectado Correctamente!!", 
            "respuesta":""}';
    }
}catch(Exception $e){
    echo'{"codigo":400, "mensaje":"Error intentando conectar",
        "respuesta":""}';
}