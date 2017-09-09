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
			<h3>Añadir nueva factura:</h3>
			<?php
include "conectar.php"; 
error_reporting(0);	

echo 		"<form method='post' name='facturas' action='nuevofactura2.php' enctype='multipart/form-data'>
			<center>
			<font color='white'>Matricula:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</font>	
			<select name='matricula' required> <option selected disabled value=''>Seleccione una matricula</option>";
			
$resultado=mysql_query("select matricula from vehiculos");
if($resultado==0)
{
echo " <h4>Error al introducir la factura en la Base de Datos.</h4><br>";
}
else
{
$contador=1;
 while($fila=mysql_fetch_array($resultado))
{
$matricula=$fila["matricula"];

if($contador%2==0)
{ 
echo "<option value='$matricula'>$matricula</option>";
}
else
{ 
echo "<option value='$matricula'>$matricula</option>";
}
$contador=$contador+1;
}
}
	
echo		"</select><br>
						
				 
			<br><font color='white'>Horas:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</font>
			<input type='text' name='horas' required/><br>
			
			<font color='white'>Precio_hora:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</font>
			<input type='text' name='preciohora' required/><br>
			
			<font color='white'>Fecha_emision:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</font>
			<input type='date' name='emision'required/><br><br>
			
			<font color='white'>Fecha_pago:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</font>
			<input type='date' name='pago'/><br>
			
			<font color='white'>IDEmpleado:&nbsp&nbsp&nbsp</font>
			<select name='empleado'required> <option selected disabled value=''>Seleccione una idempleado</option>";
			
$resultado=mysql_query("select id_empleado from empleados");
if($resultado==0)
{
echo " <h4>Error al introducir la factura en la Base de Datos.</h4><br>";
}
else
{
$contador=1;
 while($fila=mysql_fetch_array($resultado))
{
$empleado=$fila["id_empleado"];

if($contador%2==0)
{ 
echo "<option value='$empleado'>$empleado</option>";
}
else
{ 
echo "<option value='$empleado'>$empleado</option>";
}
$contador=$contador+1;
}
}
	
echo		"</select><br>";	
			
?>	

					
<center><input type=submit value="Añadir lineas de detalles">
<input type=reset value="Vaciar formulario"></center>
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