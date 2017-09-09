<?php 

include "conectar.php";

$usuario=$_POST["usuario"];
$password=$_POST["password"];

$tipo=null;
$empleado=0;

//Hacemos select en la tabla empleados para los usuarios con el usuario y password introducidos.
$resultado=mysql_query("SELECT * FROM empleados WHERE usuario='$usuario' AND contrasenia='$password'");
if($resultado==NULL)
{
echo "Error al acceder a la base de datos";
}
else
{
while($fila=mysql_fetch_array($resultado))
{
//Si encuentra algun usuario con ese nombre de usuario y password guardamos el tipo de usuario	
$tipo=$fila["tipo"]; 
echo "<p>$tipo conectado";
//dependiendo del tipo de usuario que sea se crearan unas variables u otras 
//Iniciamos la session y creamos variables para administrador
	session_start();
	$_SESSION['tipoempleado']=$tipo;
	echo "<script language='javascript'>window.location='inicio.php'</script>";	
}

if ($tipo==null)
{
session_destroy();
echo "<script language='javascript'>window.location='inicio.php'</script>";	
}
}
?>

		
		
