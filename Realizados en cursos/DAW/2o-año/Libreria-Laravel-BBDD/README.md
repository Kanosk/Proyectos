Pasos a seguir para verificar el funcionamiento de la aplicación:
- clonar el repositorio (git clone https://github.com/Kanosk/4ut-dsw.git)
- entrar en la carpeta clonada y abrir la terminal
- hacer composer install
- copiar el fichero .env.example y renombrarlo a .env
- usar el comando php artisan key:generate
- configurar la conexion a la base de datos del fichero .env
- migrar las bases de datos (php artisan migrate:fresh --seed)
- y servir el proyecto para verificar (php artisan serve)

## Proyecto de aplicación web escrita en PHP que acceda a una Base de datos mediante AJAX

Partiendo del proyecto del carrito de la compra visto en Clases: 
Generar un proyecto en Laravel que realice las siguientes modificaciones y nuevas
funcionalidades.
Se debe iniciar una sesión en la aplicación, en este caso ya no partimos de un fichero XML,
sino que se debe acceder con las credenciales guardados en la tabla de base de datos
“Usuarios”.

El login se vera de la siguiente manera
![image](https://github.com/Kanosk/4ut-dsw/assets/107559941/4384e436-0632-4645-baad-29bf293a90c8)

Una vez iniciada la sesión en la aplicación el funcionamiento es muy similar a la aplicación
del carrito vista en clase. Se debe crear una sesión con dos variables el nombre del usuario y
otra variable dónde se almacena los datos del carrito de la compra.
El primer listado que debe aparecer en la aplicación es un nuevo listado en forma de tabla
generado dinámicamente mediante AJAX, de todas las categorías de la aplicación.
Los datos de esta tabla se obtienen de la tabla de base de datos “Categorias”.
Se deben añadir además en la tabla por cada fila, tres botones: “Ver Productos”, “Editar” y
“Eliminar”.

![image](https://github.com/Kanosk/4ut-dsw/assets/107559941/a38b7d34-47db-4f2b-94cf-ce12657a7695)

Los botones tienen las siguientes acciones:
Ver Productos: Acción que nos genera una tabla de productos correspondientes a una
determinada categoría. (Estos datos deben generarse dinámicamente y los datos deben
proceder de la base de datos).
Editar: Nos genera un formulario en el que el usuario podrá modificar el nombre
y descripción de la categoría. (Se debe modificar la información en la base de
datos).
Eliminar: Elimina la categoría de la base de datos. Al eliminar la categoría, el
listado de categorías debe actualizarse.
![image](https://github.com/Kanosk/4ut-dsw/assets/107559941/0e95badc-7f84-4780-b434-6c0c2578dfc8)

Ver productos mostrará un nuevo listado con la información de los productos
relacionados con una determinada Categoría. Esta tabla se tiene que generar
dinámicamente, sin salir de la página “index”.
Si al seleccionar una determinada categoría no existen Productos, mostramos
el siguiente mensaje: “Categoría sin productos”
![image](https://github.com/Kanosk/4ut-dsw/assets/107559941/56fecbb1-862f-4fc7-b048-821bcf751657)


Se muestra el siguiente formulario para editar la información disponible de la
Categoría, “Nombre” y “Descripción”. Esta información se debe consultar en la
base de datos (No utilizar variables de sesión para editar la información).
La modificación de la información se debe realizar en la base de datos.
Si la modificación se realiza con éxito se debe informar al usuario mediante un
mensaje.
El mensaje debe poner: “Categoría editada con éxito”.
Si existe algún error a la hora de editar la categoría se debe mostrar el
siguiente mensaje:
"Se produjo un error, no se pudo editar la Categoría"

![image](https://github.com/Kanosk/4ut-dsw/assets/107559941/e1445b3b-9846-49ae-9380-771eda04e45f)

Si la eliminación se realiza con éxito se debe informar al usuario mediante un
mensaje.
El mensaje debe poner: “Categoría eliminada con éxito”.
Si existe algún error a la hora de eliminar la categoría se debe mostrar el
siguiente mensaje:
"Se produjo un error, no se pudo eliminar la Categoría"


![image](https://github.com/Kanosk/4ut-dsw/assets/107559941/1bc886d3-6520-4088-9688-730d8ba3e59f)
![image](https://github.com/Kanosk/4ut-dsw/assets/107559941/40f11533-7c92-4921-bf20-d24a49a0d958)

en el apartado de Añadir Productos tiene que leer la base de datos y mostrar un selector con el nombre de las categorias de forma automaticamente

![image](https://github.com/Kanosk/4ut-dsw/assets/107559941/63163359-94e8-4394-bd97-58340f44f17f)





