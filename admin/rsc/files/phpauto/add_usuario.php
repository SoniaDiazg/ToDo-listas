<?php
include_once 'dbconfig.php';

if(isset($_POST['btn-save']))
{
 // variables for input data
     
      $nombre_usuario = $_POST['nombre_usuario'];
      $correo_usuario = $_POST['correo_usuario'];
    // variables for input data

 // sql query for inserting data into database
 
$sql_query="INSERT INTO usuario (`id_usuario`,`nombre_usuario`,`correo_usuario`) VALUES(null,'".$nombre_usuario."','".$correo_usuario."')";
 // sql query for inserting data into database
 
 // sql query execution function
 if(mysqli_query($con,$sql_query))
 {
  ?>
  <script type="text/javascript">
  alert('usuario added Successfully ');
  window.location.href='indexusuario.php';
  </script>
  <?php
 }
 else
 {
  ?>
  <script type="text/javascript">
  alert('error occured while inserting your data');
  </script>
  <?php
 }
 // sql query execution function
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Core PHP Crud functions By PHP Code Builder</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> <link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
<center>

<div id="container"> 
<div id="table-responsive">
        <label>Core PHP Crud functions - <a href="http://www.phpcodebuilder.com" target="_blank">By PHP Code Builder</a></label>
    </div>
</div>
<div id="container"> &<div   id="table-responsive">
    <form method="post" enctype="multipart/form-data" >
    <table  class="table table-striped">
    <tr>
    <td align="center"><a href="indexusuario.php">back to main page</a></td>
    </tr>



   
    <tr>
   <td>
   <label for="nombre_usuario" class="form-label">Nombre_usuario:</label>
   </td>
    <td>
    <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" required placeholder="Nombre_usuario">
    </td>
    </tr>
    <tr>
   <td>
   <label for="correo_usuario" class="form-label">Correo_usuario:</label>
   </td>
    <td>
    <input type="text" class="form-control" id="correo_usuario" name="correo_usuario" required placeholder="Correo_usuario">
    </td>
    </tr>
  
	<tr>
    <td><button type="submit" name="btn-save"><strong>SAVE</strong></button></td>
    </tr>
    </table>
    </form>
    </div>
</div>

</center>
</body>
</html>
