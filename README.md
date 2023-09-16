# BookHound API

La API bookHound es una aplicación en PHP usando el framework de FlightPHP que gestiona libros y ofrece funcionalidad CRUD (Crear, Leer, Actualizar y Eliminar) para la entidad "Libro". Además, cuenta con un endpoint especial para realizar búsquedas en todos los campos de la tabla "Libros".

## Características

- Operaciones CRUD (Crear, Leer, Actualizar, Eliminar) para libros.
- Búsqueda avanzada en todos los campos de la tabla de libros.
- Diseñado en FlightPHP para una fácil integración en proyectos web.

## Requisitos

- PHP 7.0 o superior.
- Base de datos MySQL o similar.

## Instalación

1. Clona el repositorio de bookHound desde GitHub:

   ```bash
   git clone https://github.com/JBxss/BookHound.git
   ```

2. Accede al directorio del proyecto:

   ```bash
   cd bookHound
   ```

3. Configura la base de datos editando el archivo `index.php` con la información de tu base de datos:

   ```php
   Flight::register('db', 'PDO', array('mysql:host=localhost;dbname=basededatos', 'usuario',  'contraseña'));
   ```

4. Importa la base de datos utilizando el archivo SQL proporcionado en `database/APILibros.sql`.

5. Inicia el servidor web de tu elección (por ejemplo, Apache) y asegúrate de que PHP esté configurado correctamente.

6. Accede a la API en tu navegador o mediante herramientas como Postman utilizando las rutas definidas en la API.

## Uso

### Operaciones CRUD

La API bookHound admite las siguientes operaciones CRUD para libros:

- `POST /api/libros`: Crea un nuevo libro.
- `GET /api/libros`: Obtiene todos los libros.
- `GET /api/libros/{id}`: Obtiene un libro específico por su ID.
- `PUT /api/libros/{id}`: Actualiza un libro existente por su ID.
- `DELETE /api/libros`: Elimina un libro existente por su ID.

### Búsqueda Avanzada

La API también proporciona una funcionalidad de búsqueda avanzada:

- `GET /api/libros/buscar/TextoDeBusqueda`: Realiza una búsqueda en todos los campos de la tabla de libros y devuelve resultados que coincidan con el término de búsqueda.

### Ejemplos de Uso

```bash
# Obtener todos los libros
curl http://tu-servidor/api/libros

# Obtener un libro específico por su ID
curl http://tu-servidor/api/libros/1

# Actualizar un libro existente por su ID
curl -X PUT -d "titulo=Nuevo Titulo" http://tu-servidor/api/libros/1

# Eliminar un libro existente por su ID
curl -X DELETE http://tu-servidor/api/libros/1

# Realizar una búsqueda avanzada
curl http://tu-servidor/api/libros/PalabraClave
```

## Contribuir

Si deseas contribuir a bookHound, sigue estos pasos:

1. Haz un fork del repositorio.
2. Crea una nueva rama para tu contribución: `git checkout -b mi-contribucion`
3. Realiza tus cambios y asegúrate de que los comentarios estén actualizados.
4. Envía un pull request con tus cambios al repositorio original.

## Licencia

Este proyecto está bajo la licencia [LICENSE].

## Contacto

Si tienes alguna pregunta o sugerencia, puedes ponerte en contacto a travez de una issue.

¡Gracias por usar bookHound!
