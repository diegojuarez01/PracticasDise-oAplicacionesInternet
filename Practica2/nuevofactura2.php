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
			<h3>Añadir lineas de detalle:</h3>
			<center>
<?php 
include "conectar.php"; 

$matricula=$_POST["matricula"];
$horas=$_POST["horas"];
$preciohora=$_POST["preciohora"];
$emision=$_POST["emision"];
$pago=$_POST["pago"];
$idempleado=$_POST["empleado"];
$baseimponible=$preciohora*$horas;
$iva='21';
$total=$baseimponible*(($iva/100)+1);


$resultado=mysql_query("insert factura(matricula,horas,precio_hora,fecha_emision,fecha_pago,id_empleado,base_imponible,iva,total) values ('$matricula','$horas','$preciohora','$emision','$pago','$idempleado','$baseimponible','$iva','$total')");
if($resultado==0)
{
echo " <h4>Error al introducir la factura en la Base de Datos.</h4><br>";
}
else
{
echo "<h4>La factura se ha introducido con &eacute;xito en la Base de Datos.</h4><br>";
}
$query= mysql_query("SELECT MAX(num_factura) AS id FROM factura");
 if ($row = mysql_fetch_row($query)) 
 {
   $numfactura = trim($row[0]);
 }
echo 		

			"<form method='post' name='facturas' action='lineafactura.php' enctype='multipart/form-data'>
			<center>
			<br><font color='white'>Unidades:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</font>
			<input type='number' name='unidades' required/><br>
			<input type='hidden' name='numfactura' value='$numfactura' required/>
			<input type='hidden' name='baseimponible' value='$baseimponible' required/>
			<font color='white'>Referencia repuesto:</font>
			<select name='referencia'required> <option selected disabled value=''>Seleccione una referencia</option>";
			
$resultado=mysql_query("select referencia from repuestos");
if($resultado==0)
{
echo " <h4>Error al introducir la factura en la Base de Datos.</h4><br>";
}
else
{
$contador=1;
 while($fila=mysql_fetch_array($resultado))
{
$referencia=$fila["referencia"];

if($contador%2==0)
{ 
echo "<option value='$referencia'>$referencia</option>";
}
else
{ 
echo "<option value='$referencia'>$referencia</option>";
}
$contador=$contador+1;
}
}
	
echo		"</select><br>";




?>
					
		<center>
		<input type=submit value="Añadir linea">
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