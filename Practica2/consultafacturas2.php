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
<h3>Resultado de las consultas: </h3>
<center>
<?php 
include "conectar.php";
$fechaemisioninicio=$_POST["fechaemisioninicio"];
$fechaemisionfinal=$_POST["fechaemisionfinal"];
$fechapagoinicio=$_POST["fechapagoinicio"];
$fechapagofinal=$_POST["fechapagofinal"];
$pendientes=$_POST["pendientes"];
$idcliente=$_POST["idcliente"];
// Creamos un array para guardar las matriculas del idcliente.
$array = array(); 
if($fechaemisioninicio=='' and $fechaemisionfinal=='')
{	

}
else if($fechaemisioninicio=='')
{	
echo "<h2>Debe de introducir una fecha de emision inicial para obtener el listado </h2>";
}
else if($fechaemisionfinal=='')
{	
echo "<h2>Debe de introducir una fecha de emision final para obtener el listado </h2>";
}
else
{
echo "<h3>Listado de facturas emitidas entre el $fechaemisioninicio y el $fechaemisionfinal </h3>
<form method='post' name='consultasfacturas' action=''>
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
				";


$resultado=mysql_query("Select * from factura where fecha_emision  BETWEEN '$fechaemisioninicio'  AND '$fechaemisionfinal'");
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
</tr>";
}
$contador=$contador+1;
}
}
echo "</form>
</table>";
}
//Para controlar listado de pagos
if($fechapagoinicio=='' and $fechapagofinal=='')
{	
}
else if($fechapagoinicio=='')
{	
echo "<h2>Debe de introducir una fecha de pago inicial para obtener el listado </h2>";
}
else if($fechapagofinal=='')
{	
echo "<h2>Debe de introducir una fecha de pago final para obtener el listado </h2>";
}
else
{
echo "<h3>Listado de facturas pagadas entre el $fechapagoinicio y el $fechapagofinal </h3>
				<form method='post' name='consultasfacturas' action=''>
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
				";


$resultado=mysql_query("Select * from factura where fecha_pago  BETWEEN '$fechapagoinicio'  AND '$fechapagofinal'");
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
</tr>";
}
$contador=$contador+1;
}
}
echo "</form></table>";
}


//Controlando el lista de facturas pendientes de pago
if($pendientes=='no')
{
	
}
else
{
echo "<h3>Listado de facturas pendientes de pago</h3>
				<form method='post' name='consultasfacturas' action=''>
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
				";


$resultado=mysql_query("Select * from factura where fecha_pago=''");
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
</tr>";
}
$contador=$contador+1;
}
}
echo "</form></table>";
}
if($idcliente=='')
{	
}
else
{
echo "<h3>Listado de facturas del IDCLIENTE: $idcliente</h3>
				<form method='post' name='consultasfacturas' action=''>
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
				";

$resultado=mysql_query("Select matricula from vehiculos where id_cliente='$idcliente'");
if($resultado==0)
{
echo "Error al acceder a la base de datos de factura.<br>";
}
else
{
$contador=1; 
while($fila=mysql_fetch_array($resultado))
{
$matricula=$fila["matricula"];
$array[] = $matricula;
}
for($i=0;$i<count($array);$i++)
{ 
$resultado=mysql_query("Select * from factura where matricula='$array[$i]'");
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
</tr>";
}
$contador=$contador+1;
}
}
}
}
}
echo "</form></table>";


?>
	
		<button type="button"onclick="location.href = 'consultas.php'">Volver a gestion de consultas </button>
		<button type="button"onclick="location.href = 'consultafacturas.php'">Volver atras </button>
		</center>

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