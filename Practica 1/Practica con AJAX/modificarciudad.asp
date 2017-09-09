	<!-- Para establecer la conexion -->
	<!--#include file="conexion.asp"-->
		<%
			idciudad=request.form("idciudad")
			ciudad=request.form("ciudad")
			tasa_aeropuerto=request.form("tasa_aeropuerto")
			<!--Update a la bd con los datos obtenidos -->
			sentenciaSQL="update CIUDAD set ciudad ='" & ciudad & "',tasa_aeropuerto='" & tasa_aeropuerto & "' WHERE idciudad='" & idciudad & "'" 			
			Set rs = Conexion.Execute(SentenciaSQL)
			%>
				<script type="text/javascript">
			<!--
			alert('<%="CIUDAD MODIFICADA"%>')
			-->
			</script>
			<%server.transfer("administrador.asp")%>
