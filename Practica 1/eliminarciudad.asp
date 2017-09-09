	<!-- Para establecer la conexion -->
	<!--#include file="conexion.asp"-->
		<%
			idciudad=request.form("idciudad")
			ciudad=request.form("ciudad")
			tasa_aeropuerto=request.form("tasa_aeropuerto")	
			<!--Delete a la bd con los datos obtenidos -->
			sentenciaSQL="Delete from ciudad WHERE idciudad='" & idciudad & "'" 			
			Set rs = Conexion.Execute(SentenciaSQL)
		%>
			
		
				<script type="text/javascript">
			<!--
			alert('<%="CIUDAD BORRADA"%>')
			-->
			</script>
			<%server.transfer("administrador.asp")%>
			
			
