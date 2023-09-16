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
                "error" => "ID no valido",
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

    function InsertarLibro()
    {
        try {

            $db = Flight::db();
            $nombre = Flight::request()->data->nombre_libro;
            $autor = Flight::request()->data->autor_libro;
            $fecha = Flight::request()->data->fecha_libro;
            $categoria = Flight::request()->data->categoria_libro;

            // Realiza validaciones
            $errores = [];

            if (empty($nombre)) {
                $errores[] = "El nombre es obligatorio";
            } elseif (strlen($nombre) < 2 || strlen($nombre) > 50) {
                $errores[] = "El nombre debe tener entre 2 y 50 caracteres.";
            }

            if (empty($autor)) {
                $errores[] = "El nombre del autor es obligatorio";
            } elseif (strlen($autor) < 2 || strlen($autor) > 50) {
                $errores[] = "El nombre del autor debe tener entre 2 y 50 caracteres.";
            }

            if (strtotime($fecha) === false) {
                $errores[] = "Fecha no valida";
            }

            if (empty($categoria)) {
                $errores[] = "La categoria del libro es obligatorio";
            }

            if (!empty($errores)) {
                Flight::halt(400, json_encode(
                    [
                        "error" => $errores,
                        "status" => "Error",
                        "code" => "400"
                    ]
                ));
            } else {

                $query = $db->prepare("INSERT INTO tbl_libros (nombre_libro, autor_libro, fecha_libro, categoria_libro) VALUES (:nombre, :autor, :fecha, :categoria)");

                if ($query->execute([":nombre" => $nombre, ":autor" => $autor, ":fecha" => $fecha, ":categoria" => $categoria])) {

                    $array = [
                        "Nuevo Libro" => [
                            "Nombre del Libro" => $nombre,
                            "Autor" => $autor,
                            "Fecha de Publicacion" => $fecha,
                            "Categoria" => $categoria,
                        ],
                        "status" => "success",
                        "code" => "200",
                    ];
                } else {
                    Flight::halt(500, json_encode(
                        [
                            "error" => "Hubo un error al agregar los registros",
                            "status" => "Error",
                            "code" => "500"
                        ]
                    ));
                }
            }

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

    function ActualizarLibro($id)
    {
        // Validar que $id sea un número entero positivo
        if (!is_numeric($id) || $id <= 0) {
            Flight::halt(400, json_encode([
                "error" => "ID no valido",
                "status" => "error",
                "code" => "400"
            ]));
        }

        try {
            $db = Flight::db();
            $nombre = Flight::request()->data->nombre_libro;
            $autor = Flight::request()->data->autor_libro;
            $fecha = Flight::request()->data->fecha_libro;
            $categoria = Flight::request()->data->categoria_libro;

            // Realiza validaciones
            $errores = [];

            if (empty($nombre)) {
                $errores[] = "El nombre es obligatorio";
            } elseif (strlen($nombre) < 2 || strlen($nombre) > 50) {
                $errores[] = "El nombre debe tener entre 2 y 50 caracteres.";
            }

            if (empty($autor)) {
                $errores[] = "El nombre del autor es obligatorio";
            } elseif (strlen($autor) < 2 || strlen($autor) > 50) {
                $errores[] = "El nombre del autor debe tener entre 2 y 50 caracteres.";
            }

            if (strtotime($fecha) === false) {
                $errores[] = "Fecha no valida";
            }

            if (empty($categoria)) {
                $errores[] = "La categoria del libro es obligatorio";
            }

            if (!empty($errores)) {
                Flight::halt(400, json_encode(
                    [
                        "error" => $errores,
                        "status" => "Error",
                        "code" => "400"
                    ]
                ));
            } else {
                $query = $db->prepare("UPDATE tbl_libros SET nombre_libro = :nombre, autor_libro = :autor, fecha_libro = :fecha, categoria_libro = :categoria WHERE id = :id");

                $array = [
                    "error" => "Hubo un error al agregar los registros",
                    "status" => "Error"
                ];

                if ($query->execute([":id" => $id, ":nombre" => $nombre, ":autor" => $autor, ":fecha" => $fecha, ":categoria" => $categoria])) {
                    $array = [
                        "ID Libro" => $id,
                        "Libro Actualizado" => [
                            "Nombre del Libro" => $nombre,
                            "Autor" => $autor,
                            "Fecha de Publicacion" => $fecha,
                            "Categoria" => $categoria,
                        ],
                        "status" => "success"
                    ];
                };

                Flight::json($array);
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

    function EliminarLibro()
    {
        try {
            $db = Flight::db();
            $id = Flight::request()->data->id;

            // Validar que $id sea un número entero positivo
            if (!is_numeric($id) || $id <= 0) {
                Flight::halt(400, json_encode([
                    "error" => "ID no valido",
                    "status" => "error",
                    "code" => "400"
                ]));
            }


            $query = $db->prepare("DELETE from tbl_libros WHERE id = :id");

            $array = [
                "error" => "Hubo un error al eliminar los registros",
                "status" => "Error"
            ];

            if ($query->execute([":id" => $id])) {
                $array = [
                    "data" => [
                        "ID Libro" => $id
                    ],
                    "status" => "success"
                ];
            };

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
