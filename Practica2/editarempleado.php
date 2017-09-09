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
				document.editarempleado.action = pagina;
				document.editarempleado.submit();
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
			<h3>Editar empleado:</h3>
<?php 
include "conectar.php"; 
error_reporting(0);	
$idempleado=$_GET["idempleado"];

$resultado=mysql_query("select * from empleados where id_empleado='$idempleado'");
if($resultado==0)
{
echo " <h4>Error al introducir el empleado en la Base de Datos.</h4><br>";
}
else
{
$contador=1; 
while($fila=mysql_fetch_array($resultado))
{
	
$idempleado2=$fila["id_empleado"];
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

echo 		"<form method='post' name='editarempleado'action='' enctype='multipart/form-data'>
			<center>
			
			<font color='white'>IDEmpleado:</font>
			<input type='text' name='idempleado'readonly value='$idempleado2'required/></br>
			
			
			<font color='white'>Nombre:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</font>
			<input type='text' name='nombre' value='$nombre'required /><br>
		 
			<font color='white'>Apellido1:&nbsp&nbsp&nbsp&nbsp</font>
			<input type='text' name='apellido1' value='$apellido1'required/><br>
			
			<font color='white'>Apellido2:&nbsp&nbsp&nbsp&nbsp</font>
			<input type='text' name='apellido2' value='$apellido2'required/><br>
			
			<font color='white'>Poblacion:&nbsp&nbsp&nbsp&nbsp</font>
			<input type='text' name='poblacion' value='$poblacion' required/><br>
			
			<font color='white'>Provincia:&nbsp&nbsp&nbsp&nbsp</font>
			<input type='text' name='provincia' value='$provincia'required /><br>
			
			
			<font color='white'>Telefono:&nbsp&nbsp&nbsp&nbsp&nbsp</font>
			<input type='text' name='telefono' value='$telefono'required /><br>
			
			<font color='white'>DNI:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</font>
			<input type='text' name='dni'value='$dni'required/></br>
			
			<font color='white'>Direccion:&nbsp&nbsp&nbsp</font>
			<input type='text' name='direccion' value='$direccion'required/><br>

			<font color='white'>CP:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</font>
			<input type='text' name='cp' value='$cp'required/><br>
			 
			<font color='white'>Email:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</font>
			<input type='text' name='email' value='$email' required /><br>
			
			<font color='white'>Usuario:&nbsp&nbsp&nbsp&nbsp&nbsp</font>
			<input type='text' name='usuario' value='$usuario' required /><br>
			
			<font color='white'>Contraseña:</font>
			<input type='text' name='contraseña' value='$contraseña' required /><br>
			
			<font color='white'>Tipo:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</font>
			<select name='tipo'><option value='$tipo'>$tipo</option>";

						if($tipo=='Administrador')
{
	$tipo='Empleado';
echo "<option value='$tipo'>$tipo</option>";
}
else
{
	$tipo='Administrador';
echo "<option value='$tipo'>$tipo</option>";
}
	
		echo "	</select><br><br>
					
			<br><font color='white'>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspFoto:</font>
			
			<input type='file' name='foto'/><br>
			<img src=$imagen width=200 class='centrarimagen'></a><br>";
			
}
}
	

?>	
								
<center><input type=submit value="Modificar empleado" OnClick="enviar('editarempleado2.php')">
<input type=submit value="Eliminar empleado" OnClick="enviar('eliminarempleado2.php')">	
<button type="button"onclick="location.href = 'gestionempleados.php'">Volver atras</button> 
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