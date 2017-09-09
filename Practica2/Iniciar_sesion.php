
<html>
<head>
        <meta charset="utf-8">

		<title>League of Challenge</title>
		<link href="CSS/cart.css" rel="stylesheet" type="text/css">
		<link href="CSS/login.css" rel="stylesheet" type="text/css">
        <link href="CSS/fonts.css" rel="stylesheet" type="text/css">
		<link href="CSS/foro.css" rel="stylesheet" type="text/css">
		<link href="CSS/global.css" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="1.js"></script>
</head>


<body>
<header id="header">
        <div id="logo">
        </div>
		</header>
	<nav>
	<ul>
	<?php
				session_start();
				error_reporting(0);	
				//si la variable de sesion que indica el tipo de usuario esta vacia se mostrara un menu para logearse
				if(empty($_SESSION['tipousuario'])) 
				{
				echo("<li><a href=inicio.php>Home</a></li>");
				echo("<li><a href=Registro.php>Registrarse</a></li>");
				echo("<li><a href=Iniciar_sesion.php>Iniciar sesion</a></li>");
				}
				//Si la variable contiene algun valor habra que controlar los valores para Empleado y Administrador
				else{
				if ($_SESSION['tipousuario']=="Usuario")
				{
				echo("<li><a href=inicio.php>Home</a></li>");
				echo "<li><a href=aboutus.php>Quienes somos</a></li>";
				echo "<li><a href=contacto.php>Contacto</a></li>";
				echo "<li><a href=foro.php>Foro</a></li>";
				echo "<li><a href=ranking_individual.php>Ranking individual</a></li>";
				echo "<li><a href=ranking_equipos.php>Ranking equipos</a></li>";
				echo "<li><a href=cerrarsesion.php>Cerrar Sesion</a></li>";	
				}
				
				elseif ($_SESSION['tipousuario']=="Administrador")
				{
				echo("<li><a href=inicio.php>Home</a></li>");
				echo "<li><a href=aboutus.php>Quienes somos</a></li>";
				echo "<li><a href=contacto.php>Contacto</a></li>";
				echo "<li><a href=foro.php>Foro<a></li>";
				echo "<li><a href=ranking_individual.php>Ranking individual</a></li>";
				echo "<li><a href=ranking_equipos.php>Ranking equipos</a></li>";
				echo "<li><a href=gestionjugadores.php>Gestión de jugadores</a></li>";
				echo "<li><a href=cerrarsesion.php>Cerrar Sesion</a></li>";	
				}
				else{
				echo("<li><a href=inicio.php>Home</a></li>");
				echo("<li><a href=Registro.php>Registrarse</a></li>");
				echo("<li><a href=Iniciar_sesion.php>Iniciar sesion</a></li>");
				}
				}
				?>
		</ul>
	</nav>
	
	<section id="seccion">
	<div id="registro"align="center">
	
	<div id="tituloregistro"><h9>Registro</h9></div>
		<form name="formularioregistro" id="formregistro" action="seguridad.php" method="post">
			<p>
				<label for="user_pass">Nombre de usuario:</label>
				<input type="text" name="username" id="username" class="input" value="" size="20" required="required"/>
			</p>
			
			<p>
				<label for="user_pass">Contraseña:</label>
				<input type="password" name="password" id="password" class="input" value="" size="32" required="required"/>
			</p>	
			
			<input type="submit" id="submit"value="Registrarse" />
		
		</form>
	
	</div>

	</section>
	
	<footer id="footer">
			
			<div id="f2">
            <article id="art1">
			<h6> Nosotros </h6>
            <p> Politica de privacidad</p>
            <p> Aviso legal </p>
            <p> Politica de cookies </p>
			<p> Quien somos</p>
			</a>
			</article>  
			<article id="art2">
			<h6> Redes/contacto </h6>
			<p> Soporte </p>		
   	    	<a href="https://www.facebook.com/dobleese.whiteroom">
            <img src="Imagenes/Redes/iconoface.png" alt="Facebook"/>
			</a>
        	<a href="https://twitter.com/DobleEseWR">
            <img src="Imagenes/Redes/iconotwitter.jpg" alt="Twitter"/>
			</a>
			<a href="https://twitter.com/DobleEseWR">
        	<img src="Imagenes/Redes/yo.png" alt="Youtube"/>
			</a>
			</article>  
			</div>
</footer>
</body>
</html>

