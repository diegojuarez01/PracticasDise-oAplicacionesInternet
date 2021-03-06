<?php
error_reporting(0);	
/* Empezamos la sesión */
    session_start();
/* Obtenemos variable*/
    $_SESSION['tipoempleado'];
/* Si la variable de sesion esta vacia, redireccionar al index y mostramos un alert. */
    if(empty($_SESSION['tipoempleado'])) 
	{
echo "<script language='javascript'>alert('Tienes que estar logeado para acceder a esta URL'); window.location.assign('inicio.php') 	</script>"; 
    }
		else if($_SESSION['tipoempleado']=='Empleado')
	{
		echo "<script language='javascript'>alert('Tienes que ser administrador para acceder a esta URL'); window.location.assign('inicio.php') 	</script>"; 

	}
?>

<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<head>
		<title> Taller Mecanico YOUNG</title>
		<link href="css/fuentes.css" rel="stylesheet" type="text/css">
		<link href="css/pagina.css" rel="stylesheet" type="text/css">
	</head>
	<body>
			<header>
			<div id="imglogo">
				<img src="img/logo.jpg" alt="logo">
			</div>
			<div id="titulo">
				<h1>Taller Mecanico YOUNG</h1>
			</div>
		</header>
		<!--Menu donde pondremos varios botones con diferentes acciones -->
		<nav>
			<ul>
				<li><a href="inicio.php"><h4> Inicio </h4></a></li>							
				<?php
				error_reporting(0);	
				//si la variable de sesion que indica el tipo de usuario esta vacia se mostrara un menu para logearse
				if(empty($_SESSION['tipoempleado'])) 
				{
				echo("<li><a href=login.php><h4> Login</h4></a></li>");
				}
				//Si la variable contiene algun valor habra que controlar los valores para Empleado y Administrador
				else{
				if ($_SESSION['tipoempleado']=="Empleado")
				{
				echo "<li style=float:right><a href=cerrarsesion.php><h4>Cerrar Sesion</h4></a></li>";	
				echo "<li><a href=gestionclientes.php><h4>Gestión de Clientes</h4></a></li>";
				echo "<li><a href=gestionvehiculos.php><h4>Gestión de Vehículos</h4></a></li>";
				echo "<li><a href=gestionrepuestos.php><h4>Gestión de Repuestos</h4></a></li>";
				echo "<li><a href=gestionfacturas.php><h4>Gestión de Facturas</h4></a></li>";
				echo "<li><a href=consultas.php><h4>Consultas</h4></a></li>";
				}
				
				elseif ($_SESSION['tipoempleado']=="Administrador")
				{
				echo "<li style=float:right><a href=cerrarsesion.php><h4>Cerrar Sesion</h4></a></li>";	
				echo "<li><a href=gestionclientes.php><h4>Gestión de Clientes</h4></a></li>";
				echo "<li><a href=gestionvehiculos.php><h4>Gestión de Vehículos</h4></a></li>";
				echo "<li><a href=gestionrepuestos.php><h4>Gestión de Repuestos</h4></a></li>";
				echo "<li><a href=gestionfacturas.php><h4>Gestión de Facturas</h4></a></li>";
				echo "<li><a href=gestionempleados.php><h4>Gestión de Empleados</h4></a></li>";
				echo "<li><a href=consultas.php><h4>Consultas</h4></a></li>";
				}
				else{
				echo("<li><a href=login.php><h4> Login</h4></a></li>");	
				}
				}
				?>
			</ul>
		</nav>	
		<section>
		<div id="contenido">
			<h3>Modificar empleado:</h3>
			<center>
<?php 
include "conectar.php"; 
$idempleado=$_POST["idempleado"];
$dni=$_POST["dni"];
$nombre=$_POST["nombre"];
$apellido1=$_POST["apellido1"];
$apellido2=$_POST["apellido2"];
$direccion=$_POST["direccion"];
$cp=$_POST["cp"];
$poblacion=$_POST["poblacion"];
$provincia=$_POST["provincia"];
$telefono=$_POST["telefono"];
$email=$_POST["email"];
$tipo=$_POST["tipo"];
$usuario=$_POST["usuario"];
$contraseña=$_POST["contraseña"];
if($dni=='' or $nombre=='' or $apellido1=='' or $apellido2=='' or $direccion=='' or $cp=='' or $poblacion=='' or $provincia=='' or $telefono=='' or $email=='' or $tipo=='' or $usuario=='' or $contraseña=='')
{
	echo " <h4>Error al modificar el empleado en la Base de Datos, algun campo del formulario anterior es nulo.</h4><br>";
}
else{
if (is_uploaded_file($_FILES['foto']['tmp_name']))
{
$foto=$_FILES['foto']['tmp_name'];
// Tratamiento necesario para introducir la imagen en la base de datos
$fotografia=imagecreatefromjpeg($foto);
ob_start();
imagejpeg($fotografia);
// obtenemos el fichero jpg-binario del buffer y lo almacena en la variable jpg
$jpg=ob_get_contents();
//cerramos el buffer
ob_end_clean();
// preparamos la variable para usarla en una consulta sql
$jpg=str_replace('##','\##',mysql_real_escape_string($jpg));

$resultado=mysql_query("update empleados set dni='$dni',nombre='$nombre',apellido1='$apellido1',apellido2='$apellido2',direccion='$direccion',cp='$cp',poblacion='$poblacion',provincia='$provincia',telefono='$telefono',email='$email',tipo='$tipo',usuario='$usuario',contrasenia='$contraseña',fotografia='$jpg' where id_empleado=$idempleado");
if($resultado==0)
{
echo " <h4>Error al modificar el empleado en la Base de Datos.</h4><br>";

}
else
{
echo "<h4>El empleado se ha modificado con &eacute;xito en la Base de Datos.</h4><br>";
}
}
else
{
	echo "<h4>No ha introducido ninguna foto nueva por lo que mantendra la anterior.</h4>";
$resultado=mysql_query("update empleados set dni='$dni',nombre='$nombre',apellido1='$apellido1',apellido2='$apellido2',direccion='$direccion',cp='$cp',poblacion='$poblacion',provincia='$provincia',telefono='$telefono',email='$email',tipo='$tipo',usuario='$usuario',contrasenia='$contraseña' where id_empleado=$idempleado");
	if($resultado==0)
{
echo " <h4>Error al modificar el empleado en la Base de Datos.</h4><br>";
}
else
{
echo "<h4>El empleado se ha modificado con &eacute;xito en la Base de Datos.</h4><br>";
}
}
}
?>
					
<center>
<button type="button"onclick="location.href = 'gestionempleados.php'">Volver a gestion de empleados </button> 
<button type="button"onclick="location.href = 'inicio.php'">Pagina de inicio </button>
</center>
</form>
</div>
</section>
		<!-- Pie de pagina-->
		<footer>
		<div id="titulofoot">
		<h2>DESARROLLADO POR DIEGO JUAREZ ROMERO </h2>
		</div>
		</footer>
	</body>
</html>