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
<h3>Consultar clientes: </h3>
<center>
<form action="consultaclientes2.php" method=post>
<font color='white'>Buscar clientes con nombre:&nbsp&nbsp&nbsp&nbsp&nbsp</font>
<select name=nombre>
<option value="">Elija un nombre</option>
<?php
include "conectar.php"; 
$resultado=mysql_query("Select distinct nombre from clientes");
if($resultado==0)
{
echo "Error al acceder a la base de datos de clientes.<br>";
}
else
{ while($fila=mysql_fetch_array($resultado))
{
$nombre=$fila["nombre"]; echo "<option value='$nombre'>$nombre</option>";
}
}
?>
</select><br>
<font color='white'>Buscar clientes con apellido1:</font>
<select name=apellido1>
<option value="">Elija un apellido1</option>
<?php 
$resultado=mysql_query("Select distinct apellido1 from clientes");
if($resultado==0)
{
echo "Error al acceder a la base de datos de clientes.<br>";
}
else
{ while($fila=mysql_fetch_array($resultado))
{
$apellido1=$fila["apellido1"]; echo "<option value='$apellido1'>$apellido1</option>";
}
}
?>
</select><br>
<font color='white'>Buscar clientes con apellido2:</font>
<select name=apellido2>
<option value="">Elija un apellido2</option>
<?php 
$resultado=mysql_query("Select distinct apellido2 from clientes");
if($resultado==0)
{
echo "Error al acceder a la base de datos de clientes.<br>";
}
else
{ while($fila=mysql_fetch_array($resultado))
{
$apellido2=$fila["apellido2"]; echo "<option value='$apellido2'>$apellido2</option>";
}
}
?>
</select><br>
<font color='white'>Buscar clientes con poblacion:</font>
<select name=poblacion>
<option value="">Elija una poblacion</option>
<?php 
//Utilizamos distinct para que no se repita
$resultado=mysql_query("Select  distinct poblacion from clientes");
if($resultado==0)
{
echo "Error al acceder a la base de datos de clientes.<br>";
}
else
{ while($fila=mysql_fetch_array($resultado))
{
$poblacion=$fila["poblacion"]; echo "<option value='$poblacion'>$poblacion</option>";
}
}
?>
</select><br>
<font color='white'>Buscar clientes con provincia:</font>
<select name=provincia>
<option value="">Elija una provincia</option>
<?php 
//Utilizamos distinct para que no se repita
$resultado=mysql_query("Select  distinct provincia from clientes");
if($resultado==0)
{
echo "Error al acceder a la base de datos de clientes.<br>";
}
else
{ while($fila=mysql_fetch_array($resultado))
{
$provincia=$fila["provincia"]; echo "<option value='$provincia'>$provincia</option>";
}
}
?>
</select><br>	
<font color='white'>Buscar clientes con telefono:</font>
<select name=telefono>
<option value="">Elija un telefono</option>
<?php 
//Utilizamos distinct para que no se repita
$resultado=mysql_query("Select  distinct telefono from clientes");
if($resultado==0)
{
echo "Error al acceder a la base de datos de clientes.<br>";
}
else
{ while($fila=mysql_fetch_array($resultado))
{
$telefono=$fila["telefono"]; echo "<option value='$telefono'>$telefono</option>";
}
}
?>
</select><br>								
<center>
		<input type=submit value="Realizar consulta">
		<button type="button"onclick="location.href = 'consultas.php'">Volver atras </button>
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