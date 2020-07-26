# Proyecto 2 - PHP-Laravel -- Gaming Place

## Web

Gaming Place es una página dedicada a compartir opiniones sobre juegos, donde los usuarios pueden dejar sus experiencias como jugadores de un juego particular, o como casuales los cuales solo lo vieron por tráilers o gameplays (o ni se animaron a comprarlo para jugarlo). El objetivo principal de la página es el de brindar una gran utilidad, por ejemplo, para alguien que está queriendo decidir si comprar un juego en particular o nó, ya sea viendo una mala o buena reseña sobre la jugabilidad del mismo, bugs, o sobre la historia que plantea el mismo. 

Dentro de la página voy a definir dos roles:
* Administrador : Encargado de agregar juegos y sus datos correspondientes a la página, como imágenes, decoradores de un juego (los géneros, las plataformas en las que fue implementado, editores y desarrolladores del mismo). El rol del administrador se centra en crear los datos necesarios para las páginas de juegos, esto es, la entidad juego que corresponde al mismo, con todos sus datos básicos y luego al menos dos imágenes (deseable aunque opcional) correspondientes a la vista principal (típicamente denominado thumbnail) del mismo y el fondo ilustrativo que tendrá en su página principal. Luego los usuarios de la página se encargan de operar la misma página del juego. A futuro se desea implementar una sección de pedidos, donde los usuarios pueden cargar pedidos de juegos, los cuales desean tener disponibles para comentar.
* Usuario : Su principal utilidad para la página es puntuar los juegos disponibles dentro de la misma en base a una crítica general y/o diversas críticas adicionales mas puntuales. Los usuarios pueden filtar todos los juegos disponibles, acceder a sus páginas principales para ver sus datos y dejar calificaciones sobre los mismos.

La página gira entorno a cuatro identidades principales, vale la pena aclarar que todas las tablas tienen columnas 'created_at' y 'updated_at' para llevar control de cuando se crea una entidad y cuando se actualiza respectivamente:

### Juego 

Un juego se compone de los siguientes campos, necesarios para mantener la funcionalidad de la página:

* id: El identificador único del juego.
* nombre: Es el nombre del juego, además debe ser único entre todos los demás almacenados.
* genero: Es una lista de los géneros (RPG, acción, aventura, etc) que posee el juego, en formato json.
* plataforma: Es una lista de las plataformas (PC, PlayStation, etc) que posee el juego, en formato json.
* editor: Es una lista de los editores que posee publicaron el juego, en formato json.
* desarrollador: Es una lista de los desarrolladores detrás de la creación del juego, en formato json.
* puntaje: Una sumatioria de todas las calificaciones de los usuarios para este juego.
* cant_calificaciones: Una cuenta de la cantidad de calificaciones que posee este juego.
* rating: Promedio de puntaje (puntaje/cant_calificaciones).


### Calificacion 

Una calificación se compone de los siguientes datos:

* id: El identificador único del juego.
* users_id: Identificador del usuario que creó esta calificación.
* juego_id: Identificador del juego al que pertenece esta calificación.
* descripción: Descripción corta de esta reseña, con fines introductorios.
* reseña: Es el cuerpo principal de la calificación, donde el usuario cuenta su experiencia personal.
* puntaje: El valor que sumariza la experiencia del usuario.
* tipo: El tipo de reseña al cual pertenece, de tipo jugador o casual, para discernir si realmente tiene experienca de juego o no.

### Imágen 

Una imágen contiene los siguientes datos:

* id: El identificador único de la imágen.
* juego_id: Identificador del juego al cual pertenece esta imágen.
* nombre_vista: La visa a la que pertenece este juego, inicialmente se necesitan dos para completar un juego, una llamada "principal" y otra llamada "fondo", las cuales completan la página principal de un juego. A futuro se desea implementar una funcionalidad que permita a los usuarios subir capturas de pantalla tomadas por ellos para compartirlas con otros usuarios (nombre_vista = user).
* imagen: Los datos de la imágen codificados en base64. Estos datos son utilizados para regenerar la imagen en la página web.

### User 

Un usuario está compuesto por los siguientes campos:

* id: Identificador único del usuario dentro del sistema.
* nombre: Se corresponde al nickname que utiliza el usuario en la aplicación web.
* email: Email único al cual está relacionado el usuario.
* type: Comprende los valores 'default' o 'admin', central en el modelo de roles, en conjunto con los middleware 'is_admin' y 'is_user' se modelan las distintas vistas de la página.
* email_verified_at: Indica si el usuario verificó o no su email (quizás necesario para funciones futuras). Un admin no necesita de este dato.
* password: Contraseña codificada del usuario.
* remember_token: Utilizado en el middleware de autenticación para aumentar la seguridad de las sesiones.
* api_key: Es la clave que debe utilizar el usuario para acceder a la api del sistema. El usuario puede regenerar esta clave en cualquier momento.

## API

La api actualmente permite el acceso a todos los modelos de datos. La seguridad de la misma se centra en el uso de api_tokens, los cuales son otorgados a los usuarios en el momento en el cual se registran y pueden ser regenerados desde su perfil, o por el mismo uso de las rutas de la api. La api requiere que se incluya el api_token dentro de los headers de las consultas de aquellas rutas bloqueadas de acceso no autorizado. En cuanto a los datos, estos se presentan paginados, por medio de la funcionalidad "Paginate" de Eloquent, para disminuir el impacto computacional de las consultas sobre el servidor. En caso de no autorizar el acceso (por contraseña incorrecta o token erróneo) se devuelve un mensaje adecuado. Las rutas que define la api se acceden todas por el método post. Las rutas que no tienen seguridad de api token son las siguientes:

### Login '/api/login'

Permite a un usuario obtener su api_token, se envían en el body del post el email y la contraseña del usuario y como respuesta se otorga el api_key que utilizará con las rutas de la api.

Headers:
* Accept: application/json.
* Content-Type: application/json.

Body (form-data):
* email: Email del usuario.
* password: Contraseña del usuario.

Respuesta:
{
    "status_code": 200,
    "access_token": "sDvNLTmquvW28REZTa[...]NJ6NslKHwn85yFHpT",
    "token_type": "Bearer"
}

### User '/api/user'

Retorna los datos personales del usuario relacionado con el email.

Headers:
* Accept: application/json.
* Content-Type: application/json.

Body (form-data):
* email: Email del usuario.
* password: Contraseña del usuario.

Respuesta:
{
    "id": 12,
    "type": "default",
    "name": "api",
    "email": "api@gmail.com",
    "email_verified_at": null,
    "created_at": "2020-06-26T02:25:45.000000Z",
    "updated_at": "2020-06-26T02:25:45.000000Z",
    "api_token": "sDvNLTmquvW28REZT[...]rjJBbYwxswvIP6lJP1tq5zNJ6NslKHwn85yFHpT"
}

### Token reset '/api/token/reset'

* /token/reset: 
Permite a un usuario regenerar su api_token, requiere de su email y contraseña.

Headers:
* Accept: application/json.
* Content-Type: application/json.

Body (form-data):
* email: Email del usuario.
* password: Contraseña del usuario.
* api_token: "Bearer "+ api_token del usuario.

Respuesta:
{
    "status_code": 200,
    "access_token": "cS073R6[...]tKUMx1UN", (token nuevo, distino al del body, y este último queda obsoleto)
    "token_type": "Bearer"
}


Las siguientes direcciones corresponden con los accesos a datos y poseen todas los siguientes datos en los request:

Headers:
* Accept: application/json.
* Content-Type: application/json.
* Authorization: "Bearer "+ api_token del usuario.

Body (form-data):


Respuesta (es un contenido de ejemplo):
{
    "status_code": 200,
    "response": {
        "current_page": 1,
        "data": [
            [dependiente de la entidad obtenida de la ruta]
        ],
        "first_page_url": "http://127.0.0.1:8000/[ruta]/all?page=1",
        "from": 1,
        "last_page": 1,
        "last_page_url": "http://127.0.0.1:8000/[ruta]/all?page=1",
        "next_page_url": null,
        "path": "http://127.0.0.1:8000/[ruta]/all",
        "per_page": 50,
        "prev_page_url": null,
        "to": 10,
        "total": 10
    }
}

Las rutas contempladas son las siguientes:

* todos los juegos '/api/juegos/all': Permite a un usuario acceder a todos los juegos almacenados en el servidor.

* todas las calificaciones '/api/calificaciones/all': Permite a un usuario acceder a todas las calificaciones almacenados en el servidor.

* todos los géneros '/api/generos/all': Permite a un usuario acceder a todos los géneros guardados en el servidor.

* todas las plataformas '/api/plataformas/all': Permite a un usuario acceder a todas las plataformas guardados en el servidor.

* todos los editores '/api/editores/all': Permite a un usuario acceder a todos los editores guardados en el servidor.

* todos los desarrolladores '/api/desarrolladores/all': Permite a un usuario acceder a todos los desarrolladores guardados en el servidor.

## Pruebas

### API

Utilizando postman y definiendo los datos requeridos por cada ruta se pueden acceder a los datos sin problemas. Adicionalmente se dejó un usuario de prueba precargado en el sistema, se puede acceder a la ruta /login con sus datos (ver sección Login) para obtener el api_token y así poder probar la api:

{
    "type": "default",
    "password": "api",
    "email": "api@gmail.com",
}

La idea es usar estas credenciales con la ruta /api/login para obtener el api_token, incluirlo en el header "Authentication" seguido de "bearer " (para conformar el sistema de autenticación) y probar cualquiera de las otras rutas para acceder a los datos.

### WEB

Existen varios usuarios, para el rol de usuarios si se ve el user seeder hay muchos pero fueron usados como "placeholder" de las calificaciones, la aplicación puede testearse en su totalidad por un usuario admin ya que decidí no limitar el alcance del usuario admin a solo administrar la página, ya que su opinión sobre los juegos es también importante. A su vez, ya que las opiniones cambian decidí permitir a los usuarios hacer varias opiniones. El usuario admin de purebas es el siguiente:

Email: administrador@gmail.com
Password: adminadmin

Con este usuario se puede acceder a la totalidad de las funcionalidades. Entre las funcionalidades de un usuario normal se encuentra la de filtrar juegos en base a sus gustos, ver los detalles del mismo, calificaciones de otros usuarios y postear sus propias calificaciones. Dentro de la funcionalidad de admin está la de administrar juegos y todo lo relacionado con sus detalles e imágenes, crear nuevos usuarios admin y consultar usuarios y calificaciones (desde su sección de administración, donde estaría el perfil del usuario default).


## Aclaraciones

El juego con id 0, "Final Fantasy VII Remake" está intencionalmente sin calificaciones, la idea de esto es utilizarlo como prueba de calificaciones, lo utilicé para probar que el comportamiento de la página y las calificaciones sea correcto.

Por cuestiones de tiempo dejé de lado ciertas ideas que plantié dentro de la idea del juego (dentro de IDEA.md) donde se me recalcó que quizás no podría implementar todas las ideas planteadas:
* Calificaciones de juegos particionadas por aspectos, la idea era que no sea solo una calificacion, sino que darle la oportunidad al usuario de calificar distintos aspectos del juego por separado, siendo la calificación principal algo genérico y se completaba con otras calificaciones como lo es la historia, el entorno gráfico, la interfaz, sonido, etc.
* BAN-HAMMER: Como todo foro o similar, es usual que algunos usuarios no respenten las normas de comportamiento, y es necesario prohibirles el uso de la página web ante estos casos. Para implementar esto la idea era poner un boton de reporte, atado a una entidad reporte y darle una columna más al usuario para calificarlo con un ban o no, caso en el cual se eliminaba la calificación en cuestión y se le imposibilitaba por un tiempo indicado de calificar juegos.
* Sección de noticias: Similar a la idea del reporte, pero para pedir cargas de juegos. La idea era que se adjunten los datos (incluidas las dos imágenes básicas de todo juego) para que luego el administrador complete datos faltantes o modifique los necesarios y suba el juego.

Conforme vea el alcance del proyecto 3 y qué implique desarrollar, quizás vuelva a este proyecto a implementarlo, o bien, lo implemente para el proyecto 3.
