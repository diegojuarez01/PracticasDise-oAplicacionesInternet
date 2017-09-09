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
				document.editarfactura.action = pagina;
				document.editarfactura.submit();
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
			<h3>Editar factura:</h3>
<?php 
include "conectar.php"; 
error_reporting(0);	
$numfactura=$_GET["numfactura"];

$resultado=mysql_query("select * from factura where num_factura='$numfactura'");
if($resultado==0)
{
echo " <h4>Error al introducir la factura en la Base de Datos.</h4><br>";
}
else
{
$contador=1; 
while($fila=mysql_fetch_array($resultado))
{
	
$numfactura=$fila["num_factura"];
$matricula=$fila["matricula"];
$horas=$fila["horas"];
$preciohora=$fila["precio_hora"];
$emision=$fila["fecha_emision"];
$pago=$fila["fecha_pago"];
$idempleado=$fila["id_empleado"];
$imponible=$fila["base_imponible"];
$iva=$fila["iva"];
$total=$fila["total"];


echo 		"<form method='post' name='editarfactura' action='' enctype='multipart/form-data'>
			<center>
			<input type='hidden' name='numfactura' value='$numfactura'>
			
			<font color='white'>Matricula:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</font>	
			<select name='matricula'><option value='$matricula'>$matricula</option>";			
}
}		
$resultado=mysql_query("select matricula from vehiculos where matricula <> '$matricula'");
if($resultado==0)
{
echo " <h4>Error al introducir la factura en la Base de Datos.</h4><br>";
}
else
{
$contador=1; while($fila=mysql_fetch_array($resultado))
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
			<input type='text' name='horas' value='$horas'required/><br>
			
			<font color='white'>Precio_hora:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</font>
			<input type='text' name='preciohora' value='$preciohora'required/><br>
			
			<font color='white'>Fecha_emision:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</font>
			<input type='date' name='emision'value='$emision'required/><br><br>
			
			<font color='white'>Fecha_pago:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</font>
			<input type='date' name='pago'value='$pago'required/><br>
			
			<font color='white'>IDEmpleado:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</font>
			<select name='empleado'><option value='$idempleado'>$idempleado</option>";
			
$resultado=mysql_query("select id_empleado from empleados where id_empleado <> $idempleado");
if($resultado==0)
{
echo " <h4>Error al introducir la factura en la Base de Datos.</h4><br>";
}
else
{
$contador=1; while($fila=mysql_fetch_array($resultado))
{
$idempleado=$fila["id_empleado"];

if($contador%2==0)
{ 
echo "<option value='$idempleado'>$idempleado</option>";
}
else
{ 
echo "<option value='$idempleado'>$idempleado</option>";
}
$contador=$contador+1;
}
}
	
echo		"</select><br>
			<input type='hidden' name='imponible' value='$imponible' required/><br>
			<input type='hidden' name='iva' value='$iva'required/><br>
			<input type='hidden' name='total' value='$total'required/><br>
			<input type='hidden' name='restarhoras' value='$horas'required/><br>
			<input type='hidden' name='restarpreciohora' value='$preciohora'required/><br>";	

?>	
</select>								
<center><input type=submit value="Modificar factura" OnClick="enviar('editarfactura2.php')">
<input type=submit value="Eliminar factura" OnClick="enviar('eliminarfactura2.php')">	
<button type="button"onclick="location.href = 'gestionfacturas.php'">Volver atras</button> 

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