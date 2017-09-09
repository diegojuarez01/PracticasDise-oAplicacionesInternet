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
				document.facturas.action = pagina;
				document.facturas.submit();
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
				<h3><br>Gestion de facturas:</h3></br>
				<center>
				<form method="post" name="facturas" action="">
				<table>
				<tr bgcolor=orange>
				<td><font color=white><b>Editar</b></font></td>
				<td><font color=white><b>NumeroFactura</b></font></td>
				<td><b><font color=white><b>Matricula</font></b></td>
				<td><b><font color=white>Horas</b></font></td>
				<td><b><font color=white>Precio_hora</font></b></td>
				<td><b><font color=white>Fecha_emision</font></b></td>
				<td><b><font color=white>Fecha_pago</font></b></td>
				<td><b><font color=white>IDEmpleado</font></b></td>
				<td><b><font color=white>Base_Imponible</font></b></td>
				<td><b><font color=white>Iva</font></b></td>
				<td><b><font color=white>Total</font></b></td>
				<td><b><font color=white><b>Eliminar</font></b></td>	
				
<?php 
include "conectar.php";

$resultado=mysql_query("Select * from factura");
if($resultado==0)
{
echo "Error al acceder a la base de datos de factura.<br>";
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
$baseimponible=$fila["base_imponible"];
$iva=$fila["iva"];
$total=$fila["total"];

if($contador%2==0)
{ 
echo "<tr bgcolor=white><td><center>
<a href=editarfactura.php?numfactura=$numfactura><img src=img/editar.jpg width=20></a></center></td>
<td><font size=2>$numfactura</font></td>
<td><font size=2>$matricula</font></td>
<td><font size=2>$horas</font></td>
<td><font size=2>$preciohora</font></td>
<td><font size=2>$emision</font></td>
<td><font size=2>$pago</font></td>
<td><font size=2>$idempleado</font></td>
<td><font size=2>$baseimponible</font></td>
<td><font size=2>$iva</font></td>
<td><font size=2>$total</font></td>
<td><input type=checkbox name=borrar[] value=$numfactura>
</tr>";
}
else
{ 
echo "<tr bgcolor=white><td><center>
<a href=editarfactura.php?numfactura=$numfactura><img src=img/editar.jpg width=20></a></center></td>
<td><font size=2>$numfactura</font></td>
<td><font size=2>$matricula</font></td>
<td><font size=2>$horas</font></td>
<td><font size=2>$preciohora</font></td>
<td><font size=2>$emision</font></td>
<td><font size=2>$pago</font></td>
<td><font size=2>$idempleado</font></td>
<td><font size=2>$baseimponible</font></td>
<td><font size=2>$iva</font></td>
<td><font size=2>$total</font></td>
<td><input type=checkbox name=borrar[] value=$numfactura>
</tr>";
}
$contador=$contador+1;
}
}
?>
</table>
<center>
<input type=submit value="Eliminar facturas" onClick="enviar('eliminarfactura.php')">
<input type=reset value="Deseleccionar Todos">
<input type="button" value="Añadir factura" onClick="enviar('nuevofactura.php')">
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