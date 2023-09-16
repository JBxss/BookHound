<?php

require 'vendor/autoload.php';

class Books
{
    function obtenerLibros()
    {
        $db = Flight::db();
        $query = $db->prepare("SELECT * FROM tbl_libros");
        $query->execute();
        $data = $query->fetchAll();
        $array = [];

        foreach ($data as $row) {
            $array[] = [
                "Nombre" => $row['nombre_libro'],
                "Autor" => $row['autor_libro'],
                "Fecha de Publicacion" => $row['fecha_libro'],
                "Categoria" => $row['categoria_libro']
            ];
        }


        Flight::json([
            "total_rows" => $query->rowCount(),
            "rows" => $array
        ]);
    }
}