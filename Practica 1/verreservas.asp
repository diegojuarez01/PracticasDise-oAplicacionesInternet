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
			<%
			<!--Guardamos los datos introducidos por el usuario en el formulario en las siguientes variables-->
			DNI = request.form("DNI")
			IDRESERVA = request.form ("IDRESERVA")
			<!--Atributos para verificar dni del usuario y idreserva asignada-->
			verificardni = 0
			verificaridreserva = 0
			cancelado = 0
			<!--Sentencia que mostrara todos los atributos de la tabla reserva-->
			SentenciaSQL = "select * from RESERVA where idreserva='" & IDRESERVA & "'"
			<!-- Establecemos el recorset-->
			Set rs = Conexion.Execute(SentenciaSQL)
			<!--Titulo del contenido que mostrara un titulo junto con el DNI introducido del usuario-->
			Response.Write("<h3>Reserva para IDRESERVA: "& IDRESERVA &"</h3>")
			<!--Ejecutaremos el siguiente codigo mientras el se recorre el recorset  -->
			do until rs.Eof
			
			<!--Si se encuentra algun NIF en el recorset que sea igual al DNI introducido -->
			<!--por el usuario la variable verificardni cambiara el valor de 0 a 1 -->
			if(rs("NIF")=DNI) then
			verificardni = 1
			<!-- Hara lo mismo que para el "NIF" pero con IDRESERVA aunque para IDRESERVA tendremos-->
			<!-- un numero por lo que utilizamos cint.-->
			if(cint(IDRESERVA)=cint(rs("IDRESERVA"))) then
			verificaridreserva = 1
			if (rs("cancelado")=0) then
			cancelado = 1
%>			
		<table>
		<tr>
		<th scope="col">IDRESERVA</th>
		<th scope="col">Nombre</th>
		<th scope="col">Apellidos</th>
		<th scope="col">DNI</th>
		<th scope="col">IDVUELO</th>
		</tr>
			<tr>
			<td><%=rs("IDRESERVA")%></td>
			<td><%=rs("NOMBRE")%></td>
			<td><%=rs("APELLIDOS")%></td>
			<td><%=rs("NIF")%></td>
			<td><%=rs("IDVUELO")%></td>
		</tr>
		</table>
			<div id="volveratras">
			<form method="POST" action="cancelarreserva.asp">
			<input type="submit" value="Cancerlar reserva">
			</form>
			</div>
		<%
		<!--Si no se cumplen las opciones se pasara el siguiente valor del recorset-->
		else
		end if
		end if
		end if
		<!-- Siguiente valor del recorset-->
		rs.MoveNext
		loop
		<!--Si el dni no es alguno de los que hay en la base de datos mostrara un error-->
			if	(verificardni=0) then
				response.write("<h7>ERROR: DNI NO ENCONTRADO O INVALIDO </h7></br>")
				
		%>
		<div id="volveratras">
				<h8><a href='consultarreservas.asp'>Volver atras</a></h8>
				</div>
		<%		
			<!--Si el IDRESERVA no es alguno de los que hay en la base de datos mostrara un error-->
			else if	(verificaridreserva=0) then
				response.write("<h7>ERROR: IDRESERVA NO ENCONTRADA O INVALIDA </h7></br>")
		%>
		<div id="volveratras">
				<h8><a href='consultarreservas.asp'>Volver atras</a></h8>
				</div>
					<%		
			<!--Si la reserva esta cancelada  mostrara un error-->
			else if	(cancelado=0) then
				response.write("<h7>ERROR: RESERVA NO ENCONTRADA, FUE CANCELADA </h7></br>")
		%>
		<div id="volveratras">
				<h8><a href='consultarreservas.asp'>Volver atras</a></h8>
				</div>
		<%	
		end if
			end if
				end if
			<!--Se crean las variables de sesion -->
			session("NIF") = DNI
			session("IDRESERVA") = IDRESERVA
			%>
		</section>
		</div>
		<!-- Pie de pagina-->
		<footer>
		<div id="titulofoot">
		<h2>DESARROLLADO POR DIEGO JUÁREZ ROMERO </h2>
		</div>
		</footer>
	</body>
	<!--#include file="cerrarconexion.asp"-->
</html>