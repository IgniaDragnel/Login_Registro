<?php
include 'header.php';
try{
    $conn = mysqli_connect($servidor, $usuario, $pass, $baseDatos);
    if(!$conn){
        echo'{"codigo":400, "mensaje":"Error intentando conectar!!","respuesta":""}';
    }else{
        if( isset ($_POST['usuario']) && isset ($_POST['pass'])){
            
                $usuario=$_POST['usuario'];
                $pass=$_POST['pass'];

                $sql="SELECT * FROM `usuarios` WHERE `usuario`='$usuario' and `pass`='$pass';";
                $resultado=$conn->query($sql);
                if($resultado->num_rows>0){
                    //Si existe un usuario con esos datos
                    $sql="SELECT * FROM `usuarios` WHERE `usuario`='$usuario';";
                    $resultado=$conn->query($sql);
                    $texto='';
                    while ($row=$resultado->fetch_assoc()) {
                        $texto="{\\\"id\\\":".$row['id'].",\\\"usuario\\\":\\\"".$row['usuario']."\\\",\\\"pass\\\":\\\"".$row['pass']."\\\",\\\"jugador\\\":".$row['jugador'].",\\\"nivel\\\":".$row['nivel'].",\\\"puntaje\\\":".$row['puntaje']."}"; 
                    }
                    echo'{"codigo":205, "mensaje":"Inicio de sesion correcto!!","respuesta":"'.$texto.'"}';
                }else{
                    echo'{"codigo":204, "mensaje":"El usuario o la contraseña son incorrectos!!","respuesta":"0"}';
                }

            }else{
                echo'{"codigo":402, "mensaje":"Faltan datos para ejecutar la accion solicitada!!","respuesta":""}';
            }

  
    }
}catch(Exception $e){
    echo'{"codigo":400, "mensaje":"Error intentando conectar!!","respuesta":""}';
}