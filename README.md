 # Rating de films y tv-shows
La idea de el sitio es la creacion de un usuario el cual pueda hacer valoraciones de tv-shows o peliculas y sean guardadas en una DB. Las entidades son shows,reviews y el usuario.
La tabla shows está relacionada con la tabla reviews a través de la columna id, que se conecta a show_id en la tabla de reseñas, con lo que asi podriamos mostrar el show/film que fue reseñado y a la vez user se relaciona
a traves de el id de user y la clave foranea user_id en la tabla reviews, por lo que con esta relacion de 3 tablas podemos ver que show fue reseñado y porque usuario(se puede mostrar el username y el id de el mismo)
 # Diagrama de relaciones
![](https://github.com/NahuCaporale/Rating-movies/blob/master/Diagrama_relaciones_db.png)
 # Integrantes
 Nahuel Caporale y Geronimo Moroni
