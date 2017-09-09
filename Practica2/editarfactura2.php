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
			<h3>Modificar factura:</h3>
			<center>
<?php 
include "conectar.php"; 
$numfactura=$_POST["numfactura"];
$matricula=$_POST["matricula"];
$horas=$_POST["horas"];
$preciohora=$_POST["preciohora"];
$emision=$_POST["emision"];
$pago=$_POST["pago"];
$idempleado=$_POST["empleado"];
$baseimponible=$_POST["imponible"];
$iva=$_POST["iva"];
$total=$_POST["total"];
$restarhoras=$_POST["restarhoras"];
$restarpreciohora=$_POST["restarpreciohora"];

if($numfactura=='' or $matricula=='' or $horas=='' or $preciohora=='' or $emision=='' or $idempleado=='' or $baseimponible=='' or $iva=='' or $total=='')
{
	echo " <h4>Error al modificar la factura en la Base de Datos, algun campo del formulario anterior es nulo.</h4><br>";
}
else{
//Actualizamos base imponible y total
$baseimponible=$baseimponible-($restarhoras*$restarpreciohora);
$baseimponible=$baseimponible+($horas*$preciohora);
$total=$baseimponible*(($iva/100)+1);
$resultado=mysql_query("update factura set matricula='$matricula',horas='$horas',precio_hora='$preciohora',fecha_emision='$emision',fecha_pago='$pago',id_empleado='$idempleado',base_imponible='$baseimponible',iva='$iva',total='$total' where num_factura='$numfactura'");
if($resultado==0)
{
echo " <h4>Error al modificar la factura en la Base de Datos.</h4><br>";

}
else
{
echo "<h4>La factura se ha modificado con &eacute;xito en la Base de Datos.</h4><br>";
}
}
?>
					
<center>
<button type="button"onclick="location.href = 'gestionfacturas.php'">Volver a gestion de factura </button> 
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