			<!--Comprobamos que el usuario introducido y la password son los correctos
			yo he puesto como admin y password por defecto 1234 -->
			<%
			Session.TimeOut = 10
			Usuariocorrecto = 0
			usuario = request.form("usuario")
			password = request.form("password")
			
			if usuario = "1234" AND password = "1234" then
			Usuariocorrecto = 1			
			end if
		
			if Usuariocorrecto = 1 then
			session("autentificado") = 1
			<!-- He utilizado server.transfer porque con response.redirect se perdian las variables de session -->
			server.transfer("inicio.asp")
			else
			session("autentificado")= 0
			server.transfer("adminlogin.asp")
			end if
			%>
