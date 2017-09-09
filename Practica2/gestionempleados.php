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
		<script type="text/javascript">
			//Funcion para enviar un formulario a diferentes paginas
			function enviar(pagina){
				document.empleados.action = pagina;
				document.empleados.submit();
				}
		</script>
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
				<h3><br>Gestion de empleados:</h3></br>
				<center>
				<form method="post" name="empleados" action="">
				<table>
				<tr bgcolor=orange>
				<td><font color=white><b>Editar</b></font></td>
				<td><b><font color=white><b>Id</font></b></td>
				<td><b><font color=white>Nombre</b></font></td>
				<td><b><font color=white>1ºapellido</font></b></td>
				<td><b><font color=white>2ºapellido</font></b></td>
				<td><b><font color=white>Poblacion</font></b></td>
				<td><b><font color=white>Provincia</font></b></td>
				<td><b><font color=white>Telefono</font></b></td>
				<td><b><font color=white>Dni</font></b></td>
				<td><b><font color=white>Direccion</font></b></td>
				<td><b><font color=white>Cp</font></b></td>
				<td><b><font color=white>Tipo</font></b></td>
				<td><b><font color=white>Email</font></b></td>
				<td><b><font color=white>Usuario</font></b></td>
				<td><b><font color=white>Contraseña</font></b></td>
				<td><b><font color=white>Foto</font></b></td>
				<td><b><font color=white><b>Eliminar</font></b></td>	
				
<?php 
include "conectar.php";

$resultado=mysql_query("Select * from empleados");
if($resultado==0)
{
echo "Error al acceder a la base de datos de empleados.<br>";
}
else
{
$contador=1; 
while($fila=mysql_fetch_array($resultado))
{
$idempleado=$fila["id_empleado"];
$nombre=$fila["nombre"];
$apellido1=$fila["apellido1"];
$apellido2=$fila["apellido2"];
$poblacion=$fila["poblacion"];
$provincia=$fila["provincia"];
$telefono=$fila["telefono"];
$dni=$fila["dni"];
$direccion=$fila["direccion"];
$cp=$fila["cp"];
$tipo=$fila["tipo"];
$email=$fila["email"];
$usuario=$fila["usuario"];
$contraseña=$fila["contrasenia"];
$foto=$fila["fotografia"];

// Tratamiento de la imagen antes de mostrarla
// getcwd devuelve el directorio actual
// tempnam crea un archivo temporal
// basename da nombre a un archivo
// Creamos una archivo en www con el nombre temp
$imagen=basename(tempnam(getcwd(),"temp"));
// añadimos la extensión jpg al fichero
$imagen.=".jpg";
//abrimos el fichero con permisos de escritura
$fichero=fopen($imagen,"w");
// escribimos en el fichero el contenido del campo de la base de datos
fwrite($fichero,$foto);
//cerramos el fichero
fclose($fichero);

if($contador%2==0)
{ 
echo "<tr bgcolor=white><td><center>
<a href=editarempleado.php?idempleado=$idempleado><img src=img/editar.jpg width=20></a></center></td>
<td><font size=2>$idempleado</font></td>
<td><font size=2>$nombre</font></td>
<td><font size=2>$apellido1</font></td>
<td><font size=2>$apellido2</font></td>
<td><font size=2>$poblacion</font></td>
<td><font size=2>$provincia</font></td>
<td><font size=2>$telefono</font></td>
<td><font size=2>$dni</font></td>
<td><font size=2>$direccion</font></td>
<td><font size=2>$cp</font></td>
<td><font size=2>$tipo</font></td>
<td><font size=2>$email</font></td>
<td><font size=2>$usuario</font></td>
<td><font size=2>$contraseña</font></td>
<td><img src=$imagen width=50 border=0></td>
<td><input type=checkbox name=borrar[] value=$idempleado>
</tr>";
}
else
{ 
echo "<tr bgcolor=white><td><center>
<a href=editarempleado.php?idempleado=$idempleado><img src=img/editar.jpg width=20></a></center></td>
<td><font size=2>$idempleado</font></td>
<td><font size=2>$nombre</font></td>
<td><font size=2>$apellido1</font></td>
<td><font size=2>$apellido2</font></td>
<td><font size=2>$poblacion</font></td>
<td><font size=2>$provincia</font></td>
<td><font size=2>$telefono</font></td>
<td><font size=2>$dni</font></td>
<td><font size=2>$direccion</font></td>
<td><font size=2>$cp</font></td>
<td><font size=2>$tipo</font></td>
<td><font size=2>$email</font></td>
<td><font size=2>$usuario</font></td>
<td><font size=2>$contraseña</font></td>
<td><img src=$imagen width=50 border=0></td>
<td><input type=checkbox name=borrar[] value=$idempleado>
</tr>";
}
$contador=$contador+1;
}
}
?>
</table>
<center>
<input type=submit value="Eliminar empleado" onClick="enviar('eliminarempleado.php')">
<input type=reset value="Deseleccionar Todos">
<input type="button" value="Añadir empleado" onClick="enviar('nuevoempleado.php')">
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