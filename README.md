
## Proyecto 2 - PHP-Laravel

Página web de críticas de videojuegos. El estilo de página va a seguir el de gamespot.com (sólo la parte de rating de un juego), de hecho gamespot provee una API de uso libre desde la cual puedo obtener los datos necesarios de los últimos juegos lanzados para poblar la base de datos (al menos descargar los datos inicialmente). La página está dedicada a brindar un medio para compartir experiencias de uso en diversos juegos entre usuarios, lo que brinda una gran utilidad, por ejemplo, para alguien que está queriendo decidir si comprar un juego en particular o nó. 

Dentro de la página voy a definir dos roles:
* Administrador : Encargado de agregar juegos y sus datos correspondientes a la página. Adicionalmente el administrador puede borrar comentarios inapropiados (spoilers), o bloquear usuarios que infrigen las leyes de la comunidad de la página (ban-hammer).
* Usuario : Su principal utilidad para la página es puntuar los juegos disponibles dentro de la misma en base a una crítica general y/o diversas críticas adicionales mas puntuales.

Particularmente, como primer modelo, un juego va a disponer de diversos atributos o campos, donde solo el administrador tiene ABM:
* Nombre del juego.
* Id único del juego.
* Imágen del juego.
* Fecha de lanzamiento.
* Descripción del juego.
* Géneros del juego.
* Página web del juego.
* Puntaje general del juego.
* Puntajes en detalle del mismo (luego de requerirlo por medio de un botón en la vista).
* Se dispondría una vista de los comentarios sobre el juego.

Por otro lado un usuario de la página tiene acceso a la funcionalidad que brinda datos a la página, dentro de lo cual define otro modelo de datos, relacionado con el puntaje y los comentarios sobre juegos:
* Un usuario puede comentar y puntuar un juego.
* Como funcionalidad adicional pensé permitir a un usuario agregar precisión sobre la puntuación del juego agregando diversas áreas del juego las cuales puntuar. Por ejemplo, que tan buena es la historia, que tan buenos son los gráficos, que tan bueno es el control del juego, que tan buena es la jugabilidad del mismo (mecánicas únicas del mismo), si tiene un modo multijugador que tan disfrutable es el mismo, etc.

Un ejemplo de lo que deseo crear como página puede verse acá https://www.gamespot.com/games/gears-5/reviews/.
