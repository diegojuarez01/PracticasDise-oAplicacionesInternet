		<!-- Para establecer la conexion -->
	<!--#include file="conexion.asp"-->


<%				Ciudadseleccionada= request.querystring("Ciudades")
				sentenciaSQL = "select * from CIUDAD where CIUDAD='" & Ciudadseleccionada &"'" 
				set rs = conexion.execute(sentenciaSQL)
				texto = ("<br><label for=""idciudad"""">IDCIUDAD:</label></br>")
				texto = texto & ("<input type=""text"""" id=""idciudad"""" name=""idciudad"""" readonly value=" & rs("IDCIUDAD") & ">")
				texto = texto &("<br><label for=""ciudad"""">CIUDAD:</label></br>")
				texto = texto & ("<input type=""text"""" id=""ciudad"""" name=""ciudad"""" value='" + rs("CIUDAD") + "'>")
				texto = texto &("<br><label for=""tasa"""">TASA_AEROPUERTO:</label></br>")
				texto = texto & ("<input type=""text"""" id=""tasas"""" name=""tasa_aeropuerto"""" value=" & rs("TASA_AEROPUERTO") & ">")
				response.write(texto)
%>
				

		