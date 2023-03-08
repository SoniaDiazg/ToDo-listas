<?php 
    if($_GET){
        if(isset($_GET['correousu']) && !empty($_GET['correousu'])){
            
            require_once 'includes/conexion.inc.php';

            $sqlValidacion = "
            UPDATE usuario
                SET validacion_usuario = validado,
                    estado_usuario = activo
                WHERE correo_usuario LIKE '".$_GET['correousu']."';
            ";
    
            $queryValidacion = mysqli_query($conectar, $sqlValidacion);
        }
    }
    
?>
