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

    function obtenerLibrosId($id)
    {
        // Validar que $id sea un número entero positivo
        if (!is_numeric($id) || $id <= 0) {
            Flight::halt(400, json_encode([
                "error" => "ID no válido",
                "status" => "error",
                "code" => "400"
            ]));
        }

        try {
            $db = Flight::db();
            $query = $db->prepare("SELECT * FROM tbl_libros WHERE id = :id");
            $query->execute([":id" => $id]);
            $data = $query->fetch();

            if ($data === false) {
                Flight::halt(404, json_encode([
                    "error" => "Libro no encontrado",
                    "status" => "error",
                    "code" => "404"
                ]));
            }

            $array = [
                "Nombre" => $data['nombre_libro'],
                "Autor" => $data['autor_libro'],
                "Fecha de Publicacion" => $data['fecha_libro'],
                "Categoria" => $data['categoria_libro']
            ];

            Flight::json($array);
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
