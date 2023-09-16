<?php

require 'vendor/autoload.php';
require 'classes/Books.php';

Flight::register('db', 'PDO', array('mysql:host=localhost;dbname=APILibros', 'root', ''));

$books = new Books();

Flight::route('GET /books', [$books, 'obtenerLibros']);
// Flight::route('GET /books', [$books, '']);
// Flight::route('POST /books', [$books, '']);
// Flight::route('PUT /books', [$books, '']);
// Flight::route('DELETE /books', [$books, '']);

// // permite buscar libros en función de un criterio específico.
// Flight::route('GET /books', [$books, '']);

Flight::start();