Aplicaciones Web con ASP, JSP, Ajax y Java Applets.
===
# **Estructura de las páginas**
Decidir como estructurar la página (aplicarlo a la página de inicio que servira de guia para las demás)

# * Header (compuesto por 2 elementos)
  1. Una imagen que sera nuestro logo de empresa.
  2. Titulo de la web ("YOUNG TU WEB PARA VIAJES AEREOS").
 En la parte del CSS se aplica un color similar al del logo siguiendo de ejemplo en toda la web, ademas de los tamaños de los elementos que componen el header.

Además, luego le aplicaremos a la parte donde se encuentra el título de la web con CSS colores parecidos
a los del logo que formaran parte del color de toda la web y por su puesto el tamaño que ocupara,
este tamaño habrá que aplicárselo a los elementos que forman la web.
A continuación, he creado un menú navegacional con listas y enlaces para re direccionar al usuario a otra página cuando 
se pulse sobre ellos, con CSS le he dado formato a la letra, he cambiado también el color de fondo y 
hemos puesto el mismo que el del header, he modificado los bordes, controlar los márgenes y algún efecto
como el que se produce al poner el cursor encima de algún elemento de la lista, que cambia su color por 
uno más claro y se desplaza para abajo. Después de tener este menú navegacional creado solo hay que ir 
añadiendo las páginas que se quieran tener en el menú.
Ahora he pasado a crear el apartado Section que será el más grande de la web, será donde, 
en el aparecerá todo el contenido de la web de las diferentes páginas que se irán creando,
para la página de inicio aparecerá un mensaje de bienvenida al usuario además de una explicación de la funcionalidad de la web 
y una imagen que permitirá al usuario acceder a un elemento del menú(“ubicación”) que creare más adelante.
Dentro de Section he creado un <div> al que le aplicaremos estilos posteriormente dependiendo de la página y
de los elementos dentro de este <div>.
Por ultimo para acabar con la estructura nuestra web tendrá un Footer en el que aparecerá un texto “DESARROLLADO POR DIEGO JUÁREZ ROMERO” 
con su propio formato <h2> modificado en el CSS y siguiendo el estilo de las demás secciones.
Ahora que tengo la estructura que va a seguir la web, 
hay que empezar a crear nuevas páginas y darles funcionalidad a estas,
todas las páginas de la web seguirán esta estructura, solo cambiara el contenido dentro de <Section>.

