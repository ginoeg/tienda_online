<?php

namespace Kawschool;
require_once 'config.php';

try {
    $conexion = new PDO("mysql:host=$host;dbname=$db", $username, $password);
    echo "Connected to $db at $host successfully.";
} catch (PDOException $pe) {
    die("Could not connect to the database $db :" . $pe->getMessage());
}

class Articulos
{
    private $config;
    private $cn = null;

    public function registrar($_params)
    {
        $sql = "INSERT INTO `productos`(`titulo`, `descripcion`, `foto`, `precio`, `categoria_id`, `fecha`) 
        VALUES (:titulo,:descripcion,:foto,:precio,:categoria_id,:fecha)";

        $resultado = $this->cn->prepare($sql);

        $_array = [
            ':titulo' => $_params['titulo'],
            ':descripcion' => $_params['descripcion'],
            ':foto' => $_params['foto'],
            ':precio' => $_params['precio'],
            ':categoria_id' => $_params['categoria_id'],
            ':fecha' => $_params['fecha'],
        ];

        if (mysqli_query($conexion, $sql, $_array)) {
            echo "Insercion correcta";
            } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
            }
            mysqli_close($conexion);
            return true;
        }
    }
    
    public function actualizar($_params)
    {
        $sql = "UPDATE `productos` SET `titulo`=:titulo,`descripcion`=:descripcion,`foto`=:foto,`precio`=:precio,
        `categoria_id`=:categoria_id,`fecha`=:fecha WHERE `id`=:id";

        $resultado = $this->cn->prepare($sql);

        $_array = [
            ':titulo' => $_params['titulo'],
            ':descripcion' => $_params['descripcion'],
            ':foto' => $_params['foto'],
            ':precio' => $_params['precio'],
            ':categoria_id' => $_params['categoria_id'],
            ':fecha' => $_params['fecha'],
            ':id' => $_params['id'],
        ];

        if (mysqli_query($conexion, $sql, $_array)) {
            echo "Insercion correcta";
            } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
            }
            mysqli_close($conexion);
            return true;
        }
    public function eliminar()
    {
        $sql = 'DELETE FROM `productos` WHERE `id`=:id';

        $resultado = $this->cn->prepare($sql);

        $_array = [
            ':id' => $_params['id'],
        ];

        if ($resultado->execute($_array)) {
            return true;
        }

        return false;
    }
    public function mostrar()
    {
        $sql = "SELECT productos.id, titulo, descripcion,foto,nombre,precio,fecha,estado FROM productos
        
        INNER JOIN categorias
        ON productos.categoria_id = categorias.id ORDER BY productos.id DESC
        ";

        $resultado = $this->cn->prepare($sql);

        if ($resultado->execute()) {
            return $resultado->fetchAll();
        }

        return false;
    }
    public function mostrarPorId($id)
    {
        $sql = 'SELECT * FROM `productos` WHERE `id`=:id ';

        $resultado = $this->cn->prepare($sql);
        $_array = [
            ':id' => $_params['id'],
        ];

        if ($resultado->execute($_array)) {
            return $resultado->fetch();
        }

        return false;
    }
}
