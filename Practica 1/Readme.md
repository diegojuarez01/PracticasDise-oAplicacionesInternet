Aplicaciones Web con ASP, JSP, Ajax y Java Applets.
===
# **Estructura basica de las páginas**
Decidir como estructurar la página (aplicarlo a la página de inicio que servira de guia para las demás)

#### Header (compuesto por 2 elementos)

  1. Una imagen que sera nuestro logo de empresa.
  2. Titulo de la web ("YOUNG TU WEB PARA VIAJES AEREOS").
  
En la parte del CSS se aplica un color similar al del logo siguiendo de ejemplo en toda la web, ademas de los tamaños de los elementos que componen el header.

#### Menú navegacional

Compuesto por listas y enlaces para redireccionar al usuario a otra  de las páginas del proyecto cuando se pulse sobre ellos, con CSS le he dado formato a la letra,cambiado el color de fondo, modificado los bordes, controlado los márgenes y aplicado algún efecto como el que se produce al poner el cursor encima de algún elemento de la lista (cambiando su color a uno más claro y desplazandose el elemento de lista para abajo).

A este menu navegacional le iremos insertando todas las paginas de nuestro proyecto.

#### Section

Ocupara el espacio más grande dentro de la web, en el aparecerá todo el contenido de la web de las diferentes páginas que se irán creando.

En la página de inicio aparecerá un mensaje de bienvenida al usuario además de una explicación de la funcionalidad de la web 
y una imagen que permitirá al usuario acceder directamente a la pagina (“ubicación”) que se creara posteriormente.

Dentro de Section he creado un `<div>` al que le iremos aplicando diferentes estilos dependiendo de la página y
de los elementos dentro de este `<div>`.
  
#### Footer 
  
Por ultimo para acabar con la estructura nuestra web tendremos el Footer en el que aparecerá un texto con el nombre del desarrollador “DESARROLLADO POR DIEGO JUÁREZ ROMERO” al que le aplicaremos un formato `<h2>` modificado en el CSS y manteniendo la sintonia con el estilo de las demás secciones.

# **Desarrollo de la interfaz básica**

Ahora que tenemos la estructura que va a seguir la web, hay que empezar a crear nuevas páginas y darles funcionalidad a estas, se mantendran la estructura para todas las páginas de la web, solo cambiara el contenido dentro de <Section>.

