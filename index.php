<?php

require 'vendor/autoload.php';
require 'classes/Books.php';

Flight::register('db', 'PDO', array('mysql:host=localhost;dbname=API', 'root', ''));

$books = new Books();

Flight::route('GET /books', [$books, 'resgistrar']);
Flight::route('GET /books', [$books, 'resgistrar']);
Flight::route('POST /books', [$books, 'resgistrar']);
Flight::route('PUT /books', [$books, 'resgistrar']);
Flight::route('DELETE /books', [$books, 'resgistrar']);

// permite buscar libros en función de un criterio específico.
Flight::route('GET /books', [$books, 'resgistrar']);

Flight::start();