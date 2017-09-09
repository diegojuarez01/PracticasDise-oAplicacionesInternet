	<!-- Para establecer la conexion -->
	<!--#include file="conexion.asp"-->
		
		<%
		<!--Recogemos los valores introducidos en el formulario de añadirciudad.asp
			idciudad=request.form("idciudad")
			ciudad=request.form("ciudad")
			tasa_aeropuerto=request.form("tasa_aeropuerto")
		<!--Insert a la bd con los datos obtenidos -->
			SentenciaSQL = "insert into CIUDAD values ('" & idciudad & "', '" & ciudad & "', '" & tasa_aeropuerto & "')"
			Set rs = Conexion.Execute(SentenciaSQL)
			response.redirect("administrador.asp")
		%>
		<!--#include file="cerrarconexion.asp"-->