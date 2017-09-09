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
<h3>Resultado de la consulta: </h3>
<center>
				<form method="post" name="consultaclientes" action="">
				<table>
				<tr bgcolor=orange>
				<td><font color=white><b>Editar</b></font></td>
				<td><b><font color=white><b>IDCliente</font></b></td>
				<td><b><font color=white><b>DNI</font></b></td>
				<td><b><font color=white>Nombre</b></font></td>
				<td><b><font color=white>Primer Apellido</font></b></td>
				<td><b><font color=white>Segundo Apellido</font></b></td>
				<td><b><font color=white>Email</font></b></td>
				<td><b><font color=white>Telefono</font></b></td>
				<td><b><font color=white>Direccion</font></b></td>
				<td><b><font color=white>Cp</font></b></td>
				<td><b><font color=white>Poblacion</font></b></td>
				<td><b><font color=white>Provincia</font></b></td>
				<td><b><font color=white>Foto</font></b></td>
				
				
				
<?php 
include "conectar.php";

$nombre=$_POST["nombre"];
$apellido1=$_POST["apellido1"];
$apellido2=$_POST["apellido2"];
$poblacion=$_POST["poblacion"];
$provincia=$_POST["provincia"];
$telefono=$_POST["telefono"];

//Para cuando hay 5 valores nulo
if($apellido1=='' and $apellido2==''  and $poblacion==''  and $provincia==''  and $telefono=='')
{
$resultado=mysql_query("Select * from clientes where nombre='$nombre'");	
}
else if($nombre=='' and $apellido2==''  and $poblacion==''  and $provincia==''  and $telefono=='' )
{
	$resultado=mysql_query("Select * from clientes where apellido1='$apellido1'");	
}
else if($nombre=='' and $apellido1==''  and $poblacion==''  and $provincia==''  and $telefono==''  )
{
		$resultado=mysql_query("Select * from clientes where apellido2='$apellido2'");	
}
else if($nombre=='' and $apellido1==''  and $apellido2==''  and $provincia==''  and $telefono==''  )
{
	$resultado=mysql_query("Select * from clientes where poblacion='$poblacion'");	
}
else if($nombre=='' and $apellido1==''  and $apellido2==''  and $poblacion==''  and $telefono==''  )
{
	$resultado=mysql_query("Select * from clientes where provincia='$provincia'");	
}
else if($nombre=='' and $apellido1==''  and $apellido2==''  and $poblacion==''  and $provincia==''  )
{
	$resultado=mysql_query("Select * from clientes where telefono='$telefono'");	
}

//Para cuando hay 4 valores nulos

else if($apellido2==''  and $poblacion==''  and $provincia==''  and $telefono=='')
{
	$resultado=mysql_query("Select * from clientes where nombre='$nombre' and apellido1='$apellido1'");
}
else if($apellido1==''  and $poblacion==''  and $provincia==''  and $telefono=='')
{
	$resultado=mysql_query("Select * from clientes where nombre='$nombre' and apellido2='$apellido2'");
}
else if($apellido1==''  and $apellido2==''  and $provincia==''  and $telefono=='')
{
	$resultado=mysql_query("Select * from clientes where nombre='$nombre' and poblacion='$poblacion'");
}
else if($apellido1==''  and $apellido2==''  and $poblacion==''  and $telefono=='')
{
	$resultado=mysql_query("Select * from clientes where nombre='$nombre' and provincia='$provincia'");
}
else if($apellido1==''  and $apellido2==''  and $poblacion==''  and $provincia=='')
{
	$resultado=mysql_query("Select * from clientes where nombre='$nombre' and telefono='$telefono'");
}
else if($nombre==''  and $poblacion==''  and $provincia==''  and $telefono=='')
{
	$resultado=mysql_query("Select * from clientes where apellido2='$apellido2' and apellido1='$apellido1'");
}
else if($nombre==''  and $apellido2==''  and $provincia==''  and $telefono=='')
{
	$resultado=mysql_query("Select * from clientes where poblacion='$poblacion' and apellido1='$apellido1'");
}
else if($nombre==''  and $poblacion==''  and $apellido2==''  and $telefono=='')
{
	$resultado=mysql_query("Select * from clientes where provincia='$provincia' and apellido1='$apellido1'");
}
else if($nombre==''  and $poblacion==''  and $apellido2==''  and $provincia=='')
{
	$resultado=mysql_query("Select * from clientes where telefono='$telefono' and apellido1='$apellido1'");
}
else if($nombre==''  and $apellido1==''  and $telefono==''  and $provincia=='')
{
	$resultado=mysql_query("Select * from clientes where poblacion='$poblacion' and apellido2='$apellido2'");
}
else if($nombre==''  and $apellido1==''  and $poblacion==''  and $provincia=='')
{
	$resultado=mysql_query("Select * from clientes where telefono='$telefono' and apellido2='$apellido2'");
}
else if($nombre==''  and $apellido1==''  and $poblacion==''  and $telefono=='')
{
	$resultado=mysql_query("Select * from clientes where provincia='$provincia' and apellido2='$apellido2'");
}
else if($nombre==''  and $apellido1==''  and $apellido2==''  and $telefono=='')
{
	$resultado=mysql_query("Select * from clientes where provincia='$provincia' and poblacion='$poblacion'");
}
else if($nombre==''  and $apellido1==''  and $apellido2==''  and $poblacion=='')
{
	$resultado=mysql_query("Select * from clientes where provincia='$provincia' and telefono='$telefono'");
}
else if($nombre==''  and $apellido1==''  and $apellido2==''  and $provincia=='')
{
	$resultado=mysql_query("Select * from clientes where telefono='$telefono' and poblacion='$poblacion'");
}

//Para cuando hay 3 valores nulos
else if($poblacion==''  and $provincia==''  and $telefono=='')
{
	$resultado=mysql_query("Select * from clientes where nombre='$nombre' and apellido1='$apellido1' and apellido2='$apellido2'");
}
else if($apellido2==''  and $provincia==''  and $telefono=='')
{
	$resultado=mysql_query("Select * from clientes where nombre='$nombre' and apellido1='$apellido1' and poblacion='$poblacion'");
}
else if($apellido2==''  and $poblacion==''  and $telefono=='')
{
	$resultado=mysql_query("Select * from clientes where nombre='$nombre' and apellido1='$apellido1' and provincia='$provincia'");
}
else if($apellido2==''  and $provincia==''  and $poblacion=='')
{
	$resultado=mysql_query("Select * from clientes where nombre='$nombre' and apellido1='$apellido1' and telefono='$telefono'");
}


else if($apellido1==''  and $provincia==''  and $telefono=='')
{
	$resultado=mysql_query("Select * from clientes where nombre='$nombre' and apellido2='$apellido2' and poblacion='$poblacion'");
}
else if($apellido1==''  and $poblacion==''  and $telefono=='')
{
	$resultado=mysql_query("Select * from clientes where nombre='$nombre' and apellido2='$apellido2' and provincia='$provincia'");
}

else if($apellido1==''  and $provincia==''  and $poblacion=='')
{
	$resultado=mysql_query("Select * from clientes where nombre='$nombre' and apellido2='$apellido2' and telefono='$telefono'");
}

else if($apellido1==''  and $apellido2==''  and $telefono=='')
{
	$resultado=mysql_query("Select * from clientes where nombre='$nombre' and poblacion='$poblacion' and provincia='$provincia'");
}

else if($apellido1==''  and $provincia==''  and $apellido2=='')
{
	$resultado=mysql_query("Select * from clientes where nombre='$nombre' and poblacion='$poblacion' and telefono='$telefono'");
}

else if($apellido1==''  and $poblacion==''  and $apellido2=='')
{
	$resultado=mysql_query("Select * from clientes where nombre='$nombre' and provincia='$provincia' and telefono='$telefono'");
}

else if($provincia==''  and $nombre==''  and $telefono=='')
{
	$resultado=mysql_query("Select * from clientes where apellido1='$apellido1' and apellido2='$apellido2' and poblacion='$poblacion'");
}

else if($nombre==''  and $poblacion==''  and $telefono=='')
{
	$resultado=mysql_query("Select * from clientes where apellido1='$apellido1' and apellido2='$apellido2' and provincia='$provincia'");
}

else if($nombre==''  and $poblacion==''  and $provincia=='')
{
	$resultado=mysql_query("Select * from clientes where apellido1='$apellido1' and apellido2='$apellido2' and telefono='$telefono'");
}

else if($nombre==''  and $apellido2==''  and $telefono=='')
{
	$resultado=mysql_query("Select * from clientes where apellido1='$apellido1' and poblacion='$poblacion' and provincia='$provincia'");
}

else if($nombre==''  and $apellido2==''  and $provincia=='')
{
	$resultado=mysql_query("Select * from clientes where apellido1='$apellido1' and poblacion='$poblacion' and telefono='$telefono'");
}

else if($nombre==''  and $apellido2==''  and $poblacion=='')
{
	$resultado=mysql_query("Select * from clientes where apellido1='$apellido1' and provincia='$provincia' and telefono='$telefono'");
}

else if($nombre==''  and $apellido1==''  and $telefono=='')
{
	$resultado=mysql_query("Select * from clientes where apellido1='$apellido2' and poblacion='$poblacion' and provincia='$provincia'");
}

else if($nombre==''  and $apellido2==''  and $provincia=='')
{
	$resultado=mysql_query("Select * from clientes where apellido1='$apellido2' and poblacion='$poblacion' and telefono='$telefono'");
}

else if($nombre==''  and $apellido2==''  and $poblacion=='')
{
	$resultado=mysql_query("Select * from clientes where apellido1='$apellido2' and provincia='$provincia' and telefono='$telefono'");
}

else if($nombre==''  and $apellido2==''  and $apellido1=='')
{
	$resultado=mysql_query("Select * from clientes where poblacion='$poblacion' and provincia='$provincia' and telefono='$telefono'");
}

//Para cuando hay 2 valores nulos

else if($provincia==''  and $telefono=='')
{
	$resultado=mysql_query("Select * from clientes where nombre='$nombre' and apellido1='$apellido1' and apellido2='$apellido2' and poblacion='$poblacion'");
}
else if($poblacion==''  and $telefono=='')
{
	$resultado=mysql_query("Select * from clientes where nombre='$nombre' and apellido1='$apellido1' and apellido2='$apellido2' and provincia='$provincia'");
}
else if($poblacion==''  and $provincia=='')
{
	$resultado=mysql_query("Select * from clientes where nombre='$nombre' and apellido1='$apellido1' and apellido2='$apellido2' and telefono='$telefono'");
}

else if($apellido2==''  and $telefono=='')
{
	$resultado=mysql_query("Select * from clientes where nombre='$nombre' and apellido1='$apellido1' and provincia='$provincia' and poblacion='$poblacion'");
}
else if($apellido2==''  and $provincia=='')
{
	$resultado=mysql_query("Select * from clientes where nombre='$nombre' and apellido1='$apellido1' and poblacion='$poblacion' and telefono='$telefono'");
}
else if($apellido2==''  and $poblacion=='')
{
	$resultado=mysql_query("Select * from clientes where nombre='$nombre' and apellido1='$apellido1' and provincia='$provincia' and telefono='$telefono'");
}

else if($nombre==''  and $telefono=='')
{
	$resultado=mysql_query("Select * from clientes where apellido2='$apellido2' and apellido1='$apellido1' and provincia='$provincia' and poblacion='$poblacion'");
}
else if($nombre==''  and $provincia=='')
{
	$resultado=mysql_query("Select * from clientes where apellido2='$apellido2' and apellido1='$apellido1' and telefono='$telefono' and poblacion='$poblacion'");
}
else if($nombre==''  and $poblacion=='')
{
	$resultado=mysql_query("Select * from clientes where apellido2='$apellido2' and apellido1='$apellido1' and telefono='$telefono' and provincia='$provincia'");
}

else if($nombre==''  and $apellido1=='')
{
	$resultado=mysql_query("Select * from clientes where apellido2='$apellido2' and telefono='$telefono' and provincia='$provincia' and poblacion='$poblacion'");
}

else if($nombre==''  and $apellido2=='')
{
	$resultado=mysql_query("Select * from clientes where apellido1='$apellido1' and telefono='$telefono' and provincia='$provincia' and poblacion='$poblacion'");
}

else if($provincia==''  and $apellido1=='')
{
	$resultado=mysql_query("Select * from clientes where apellido2='$apellido2' and telefono='$telefono' and nombre='$nombre' and poblacion='$poblacion'");
}

else if($poblacion==''  and $apellido1=='')
{
	$resultado=mysql_query("Select * from clientes where apellido2='$apellido2' and telefono='$telefono' and nombre='$nombre' and provincia='$provincia'");
}
else if($apellido2==''  and $apellido1=='')
{
	$resultado=mysql_query("Select * from clientes where poblacion='$poblacion' and telefono='$telefono' and nombre='$nombre' and provincia='$provincia'");
}
else if($telefono==''  and $apellido1=='')
{
	$resultado=mysql_query("Select * from clientes where poblacion='$poblacion' and apellido2='$apellido2' and nombre='$nombre' and provincia='$provincia'");
}
//Para cuando hay 1 valor nulo
else if($telefono=='')
{
	$resultado=mysql_query("Select * from clientes where poblacion='$poblacion' and apellido2='$apellido2' and nombre='$nombre' and provincia='$provincia' and apellido1='$apellido1'");
}
else if($poblacion=='')
{
	$resultado=mysql_query("Select * from clientes where telefono='$telefono' and apellido2='$apellido2' and nombre='$nombre' and provincia='$provincia' and apellido1='$apellido1'");
}
else if($provincia=='')
{
	$resultado=mysql_query("Select * from clientes where telefono='$telefono' and apellido2='$apellido2' and nombre='$nombre' and poblacion='$poblacion' and apellido1='$apellido1'");
}
else if($apellido2=='')
{
	$resultado=mysql_query("Select * from clientes where telefono='$telefono' and provincia='$provincia' and nombre='$nombre' and poblacion='$poblacion' and apellido1='$apellido1'");
}
else if($apellido1=='')
{
	$resultado=mysql_query("Select * from clientes where telefono='$telefono' and provincia='$provincia' and nombre='$nombre' and poblacion='$poblacion' and apellido2='$apellido2'");
}
else if($nombre=='')
{
	$resultado=mysql_query("Select * from clientes where telefono='$telefono' and provincia='$provincia' and apellido1='$apellido1' and poblacion='$poblacion' and apellido2='$apellido2'");
}
// Si no hay ningun valor nulo
else{
		$resultado=mysql_query("Select * from clientes where nombre='$nombre' and telefono='$telefono' and provincia='$provincia' and apellido1='$apellido1' and poblacion='$poblacion' and apellido2='$apellido2'");
}
if($resultado==0)
{
echo "Error al acceder a la base de datos de clientes.<br>";
}
else
{
$contador=1; 
while($fila=mysql_fetch_array($resultado))
{
$idcliente=$fila["id_cliente"];
$dni=$fila["dni"];
$nombre=$fila["nombre"];
$apellido1=$fila["apellido1"];
$apellido2=$fila["apellido2"];
$email=$fila["email"];
$telefono=$fila["telefono"];
$direccion=$fila["direccion"];
$poblacion=$fila["poblacion"];
$provincia=$fila["provincia"];
$cp=$fila["cp"];
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
<a href=editarcliente.php?id_cliente=$idcliente><img src=img/editar.jpg width=20></a></center></td>
<td><font size=2>$idcliente</font></td>
<td><font size=2>$dni</font></td>
<td><font size=2>$nombre</font></td>
<td><font size=2>$apellido1</font></td>
<td><font size=2>$apellido2</font></td>
<td><font size=2>$email</font></td>
<td><font size=2>$telefono</font></td>
<td><font size=2>$direccion</font></td>
<td><font size=2>$cp</font></td>
<td><font size=2>$poblacion</font></td>
<td><font size=2>$provincia</font></td>
<td><img src=$imagen width=50 border=0></td>
</tr>";
}
else
{ 
echo "<tr bgcolor=white><td><center>
<a href=editarcliente.php?id_cliente=$idcliente><img src=img/editar.jpg width=20></a></center></td>
<td><font size=2>$idcliente</font></td>
<td><font size=2>$dni</font></td>
<td><font size=2>$nombre</font></td>
<td><font size=2>$apellido1</font></td>
<td><font size=2>$apellido2</font></td>
<td><font size=2>$email</font></td>
<td><font size=2>$telefono</font></td>
<td><font size=2>$direccion</font></td>
<td><font size=2>$cp</font></td>
<td><font size=2>$poblacion</font></td>
<td><font size=2>$provincia</font></td>
<td><img src=$imagen width=50 border=0></td>
</tr>";
}
$contador=$contador+1;
}
}
?>
</table>
		<button type="button"onclick="location.href = 'consultas.php'">Volver a gestion de consultas </button>
		<button type="button"onclick="location.href = 'consultaclientes.php'">Volver atras </button>
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