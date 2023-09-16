<?php

require 'vendor/autoload.php';

class Books
{
    function obtenerLibros()
    {
        try {
            $db = Flight::db();
            $query = $db->prepare("SELECT * FROM tbl_libros");
            $query->execute();
            $data = $query->fetchAll();

            if ($query->rowCount() === 0) {
                Flight::halt(404, json_encode(
                    [
                        "error" => "No se encontraron libros",
                        "status" => "error",
                        "code" => "404"
                    ]
                ));
            } else {
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
        } catch (PDOException $e) {
            Flight::halt(500, json_encode(
                [
                    "error" => "Error en la consulta SQL: " . $e->getMessage(),
                    "status" => "error",
                    "code" => "500"
                ]
            ));
        }
    }
}
