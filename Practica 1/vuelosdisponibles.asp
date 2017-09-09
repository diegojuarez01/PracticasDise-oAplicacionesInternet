<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<head>
		<title> Viajes Young </title>
		<link href="css/fuentes.css" rel="stylesheet" type="text/css">
		<link href="css/pagina.css" rel="stylesheet" type="text/css">
	</head>
	<body>
	<!-- #include file=conexion.asp --> 
	<!-- cabecera donde pondremos el logo de la empresa de aviones 
	y un titulo para la pagina
	-->
		<header>
			<div id="imglogo">
				<img src="img/logo.jpg" alt="logo">
			</div>
			<div id="titulo">
				<h1>YOUNG TU WEB PARA VIAJES AEREOS</h1>
			</div>
		</header>
		<!--Menu donde pondremos varios botones con diferentes acciones -->
		<nav>
			<ul>
				<li><a href="inicio.asp"><h4> Inicio </h4></a></li>
				<li><a href="vuelosdisponibles.asp"><h4> Vuelos disponibles </h4></a></li>
				<li><a href="ubicacion.asp"><h4> Ubicacion </h4></a></li>
				<li><a href="consultarreservas.asp"><h4> Consultar reservas </h4></a></li>
				<!-- Si el admin no esta autentifado se mostrara en el menu para que 
				se pueda autenticar sino se mostraran las opciones de administrador-->
				<%
				autentificar= session("autentificado")
				<!-- si autentificar es 0 significa que el usuario no es admin -->
				<!-- por lo que le seguira apareciendo en el menu un login -->
				if autentificar = "0" then
				response.write("<li><a href=""adminlogin.asp""""><h4> Admin login</h4></a></li>")
				<!-- si autentificar es 1 significa que el usuario es admin -->
				<!-- por lo que le aparecera en el menu su panel de admin-->
				elseif autentificar = "1" then
				response.write("<li><a href=""administrador.asp""""><h4> Opciones Admin</h4></a></li>")
				<!-- Por defecto si no hemos intentado logearnos nos aparecera el menu para logearnos -->
				else
				response.write("<li><a href=""adminlogin.asp""""><h4> Admin login</h4></a></li>")
				end if
				%>
			</ul>
		</nav>
		<section>
				<div id="contenido">
					<h3>Vuelos disponibles</h3>
<!-- Formulario para ver los vuelos disponibles dependiendo de lo que seleccione el usuario -->
				<form id="origen" name="origen" method="POST" action="reservarvuelos.asp">
				<label for="CiudadDeOrigen"> Seleccione una ciudad de origen: </label> <br/>
				<select name="CiudadDeOrigen">
				<%
				<!-- Muestra CIUDAD de la tabla CIUDAD -->
					SentenciaSQL = "select CIUDAD from CIUDAD"
				<!--Cuando el usuario no cambie la ciudad de origen se mostrara para todas las ciudades -->
					Response.Write("<OPTION VALUE=Todas>")
					Response.Write("Todas las ciudades</OPTION>")
				<!--Lanza el select guardado en SentenciaSQL -->	
					Set rs = Conexion.Execute(SentenciaSQL)
				<!-- Ejecutara el codigo mientras el recorset no este la posicion inicial
					do while not rs.EOF	
				<!--Se iran escribiendo todas las ciudades-->
					Response.Write("<OPTION VALUE='" + rs("CIUDAD") + "'>")
					Response.Write(rs("CIUDAD") + "</OPTION>")
				<!--Se desplaza	al siguiente registro del recorset-->
					rs.MoveNext
					loop
				%>
				</select>
				<div id="destino">
				<label for="CiudadDeDestino"> Seleccione una ciudad de destino: </label> <br/>
					<select name="CiudadDeDestino">
				<%
				<!-- Muestra CIUDAD de la tabla CIUDAD -->
					SentenciaSQL = "select CIUDAD from CIUDAD"
				<!--Cuando el usuario no cambie la ciudad de origen se mostrara para todas las ciudades -->
					Response.Write("<OPTION VALUE=Todas>")
					Response.Write("Todas los destinos</OPTION>")
				<!--Lanza el select guardado en SentenciaSQL -->	
					Set rs = Conexion.Execute(SentenciaSQL)
				<!-- Ejecutara el codigo mientras el recorset no este la posicion inicial
					do while not rs.EOF	
				<!--Se iran escribiendo todas las ciudades-->
					Response.Write("<OPTION VALUE='" + rs("CIUDAD") + "'>")
					Response.Write(rs("CIUDAD") + "</OPTION>")
				<!--Se desplaza	al siguiente registro del recorset-->
					rs.MoveNext
					loop
							%>
					</select>
				</div>
			
			<!--botones para enviar formulario y para vaciarlo -->
			<div id="enviar">
				<input type="submit" value="Enviar">
				<input type="reset" value="Vaciar">
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
	<!--#include file="cerrarconexion.asp"-->
</html>