
<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<head>
		<title> Taller Mecanico YOUNG </title>
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

		<nav>
			<ul>
				<li><a href="inicio.php"><h4> Inicio </h4></a></li>
				<li><a href="login.php"><h4> Login </h4></a></li>
				
			</ul>
		</nav>
		
		<section>
		<div id="contenido">
				<h3>Introduzca sus datos</h3>
				<!--Pondremos el formulario de login para el administrador en el pediremos usuario y password -->
				<form method="POST" action="seguridad.php">
				<center><font color="white">Usuario:&nbsp&nbsp</font>
				<!-- tenemos 1 imput text y 1 imput type password donde el usuario introducira
				el usuario y el password de la reserva ademas tenemos el atributo required 
				por lo que el usuario no podra dejar en blanco el imput-->
				<input type="text" name="usuario" required="required"><br>
				<font color="white">Password:</font>
				<input type="password" name="password" required="required">
				<!--boton para enviar formulario-->
			
			<div id="enviar">
				<input type="submit" value="Conectar">
			</div>
		</div>			
		</form>
		</section>
		<!-- Pie de pagina-->
		<footer>
		<div id="titulofoot">
		<h2>DESARROLLADO POR DIEGO JUÁREZ ROMERO </h2>
		</div>
		</footer>
	</body>
</html>