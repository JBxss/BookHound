<?php

require 'vendor/autoload.php';
require 'classes/Books.php';

Flight::register('db', 'PDO', array('mysql:host=localhost;dbname=APILibros', 'root', ''));

$books = new Books();

Flight::route('GET /books', [$books, 'obtenerLibros']);
Flight::route('GET /books/@id', [$books, 'obtenerLibrosId']);
Flight::route('POST /books', [$books, 'InsertarLibro']);
Flight::route('PUT /books/@id', [$books, 'ActualizarLibro']);
Flight::route('DELETE /books', [$books, 'EliminarLibro']);

// // permite buscar libros en función de un criterio específico.
Flight::route('GET /buscar/@searchString', [$books, 'buscarLibros']);

Flight::start();