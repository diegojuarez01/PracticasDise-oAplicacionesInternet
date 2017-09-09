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
			<h3>Añadir empleados:</h3>
			<form method="post" action="nuevoempleado2.php" enctype="multipart/form-data">
			<center>
			 
			<font color="white">DNI:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</font>
			<input type="text" name="dni"id="dni"required  /></br>
			 
			<font color="white">Nombre:&nbsp&nbsp&nbsp&nbsp</font>
			<input type="text" name="nombre"id="nombre"required  /><br>
		 
			<font color="white">Apellido1:&nbsp</font>
			<input type="text" name="apellido1"id="apellido1"required /><br>
			
			<font color="white">Apellido2:&nbsp</font>
			<input type="text" name="apellido2" id="apellido2"required /><br>
			
			<font color="white">Direccion:&nbsp</font>
			<input type="text" name="direccion" id="direccion"required /><br>

			<font color="white">CP:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</font>
			<input type="text" name="cp" id="cp"required /><br>
			
			<font color="white">Poblacion:&nbsp</font>
			<input type="text" name="poblacion" id="poblacion"required  /><br>
			
			<font color="white">Provincia:&nbsp&nbsp</font>
			<input type="text" name="provincia" id="provincia" required /><br>
			
			<font color="white">Telefono:&nbsp&nbsp&nbsp</font>
			<input type="text" name="telefono" id="telefono"required  /><br>
						
			<font color="white">Email:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</font>
			<input type="text" name="email" id="email" required /><br>
			
			<font color='white'>Tipo:&nbsp&nbsp&nbsp&nbsp&nbsp</font>
			<select name='tipo' required> <option selected disabled value=''>Seleccione tipo de empleado</option>
			<option value="Administrador">Administrador</option>
			<option value="Empleado">Empleado</option>
			</select><br>
			
			<br><font color="white">Usuario:&nbsp&nbsp&nbsp&nbsp&nbsp</font>
			<input type="text" name="usuario" id="usuario" required /><br>

	
			<font color="white">Contraseña:</font>
			<input type="text" name="contraseña" id="contraseña" required /><br>			
			<br>
			<font color="white">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspFoto:</font>
			<input type="file" name="foto" id="foto"required/><br> 
			
		
					
<center><input type=submit value="Añadir empleado">
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