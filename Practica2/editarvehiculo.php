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
		<script type="text/javascript">
			//Funcion para enviar un formulario a diferentes paginas
			function enviar(pagina){
				document.editarvehiculo.action = pagina;
				document.editarvehiculo.submit();
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
			<h3>Editar vehiculo:</h3>
<?php 
include "conectar.php"; 
error_reporting(0);	
$matricula=$_GET["matricula"];

$resultado=mysql_query("select * from vehiculos where matricula='$matricula'");
if($resultado==0)
{
echo " <h4>Error al introducir el vehiculo en la Base de Datos.</h4><br>";
}
else
{
$contador=1; 
while($fila=mysql_fetch_array($resultado))
{
	
$idcliente=$fila["id_cliente"];
$marca=$fila["marca"];
$año=$fila["anio"];
$modelo=$fila["modelo"];
$color=$fila["color"];
$matricula=$fila["matricula"];

echo 		"<form method='post' name='editarvehiculo'action='' enctype='multipart/form-data'>
			<center>
				
			<font color='white'>Marca:&nbsp&nbsp&nbsp</font>
			<input type='text' name='marca'value='$marca'required/></br>
			 
			<font color='white'>Año:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</font>
			<input type='text' name='año' value='$año'required /><br>
		 
			<font color='white'>Modelo:&nbsp&nbsp</font>
			<input type='text' name='modelo' value='$modelo'required/><br>
			
			<font color='white'>Color:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</font>
			<input type='text' name='color' value='$color'required/><br>
			
			<font color='white'>Matricula:</font>
			<input type='text' name='matricula' readonly value='$matricula' required/><br>
			<font color='white'>IDCliente:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</font>
			<select name='cliente'><option value='$idcliente'>$idcliente</option>";
			
}		
}
$resultado=mysql_query("select id_cliente from clientes where id_cliente <> $idcliente");
if($resultado==0)
{
echo " <h4>Error al introducir el vehiculo en la Base de Datos.</h4><br>";
}
else
{
$contador=1; while($fila=mysql_fetch_array($resultado))
{
$cliente=$fila["id_cliente"];

if($contador%2==0)
{ 
echo "<option value='$cliente'>$cliente</option>";
}
else
{ 
echo "<option value='$cliente'>$cliente</option>";
}
$contador=$contador+1;
}
}

?>	
</select>								
<center><input type=submit value="Modificar vehiculo" OnClick="enviar('editarvehiculo2.php')">
<input type=submit value="Eliminar vehiculo" OnClick="enviar('eliminarvehiculo2.php')">	
<button type="button"onclick="location.href = 'gestionvehiculos.php'">Volver atras</button> 

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