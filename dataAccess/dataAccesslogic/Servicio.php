<?php
#include file

include ('../dataAccess/conexion/Conexion.php');

class Servicio
{
    #atributos
    private string $id;
    private string $nombre;
    private string $descripcion;
    private string $categoria_id;
    private string $fecha_hora;
    private string $precio;
    private string $imagen;

    private $connectionDB;

    #constructor  
    public function __construct(ConexionDB $connectionDB)
    {
        $this->connectionDB = $connectionDB->connect();
    }

    // Métodos Get y Set para cada propiedad
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setDescripcion(string $descripcion): void
    {
        $this->descripcion = $descripcion;
    }

    public function getDescripcion(): string
    {
        return $this->descripcion;
    }

    public function setCategoriaId(string $categoria_id): void
    {
        $this->categoria_id = $categoria_id;
    }

    public function getCategoriaId(): string
    {
        return $this->categoria_id;
    }

    public function setFechaHora(string $fecha_hora): void
    {
        $this->fecha_hora = $fecha_hora;
    }

    public function getFechaHora(): string
    {
        return $this->fecha_hora;
    }

    public function setPrecio(string $precio): void
    {
        $this->precio = $precio;
    }

    public function getPrecio(): string
    {
        return $this->precio;
    }

    public function setImagen(string $imagen): void
    {
        $this->imagen = $imagen;
    }

    public function getImagen(): string
    {
        return $this->imagen;
    }

    #metodos
    #añadir servicio
    public function registrarServicio(): bool
    {
        try {
            $sql = "INSERT INTO servicios (id, nombre, descripcion, categoria_id, fecha_hora, precio, imagen) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->connectionDB->prepare($sql);
            $stmt->execute(array($this->getId(), $this->getNombre(), $this->getDescripcion(), $this->getCategoriaId(), $this->getFechaHora(), $this->getPrecio(), $this->getImagen()));
            $count = $stmt->rowCount();
            return $this->affectedColumns($count);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    #listar servicios
    public function listarServicio()
    {
        try {
            $sql = "SELECT * FROM servicios";
            $stmt = $this->connectionDB->prepare($sql);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $arrayQuery = $stmt->fetchAll();
            return $arrayQuery;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return [];
    }

    //borrar servicio
    public function eliminarServicio(): bool
    {
        try {
            $sql = "DELETE FROM servicios WHERE id = ?";
            $stmt = $this->connectionDB->prepare($sql);
            $stmt->execute(array($this->getId()));
            $count = $stmt->rowCount();
            return $this->affectedColumns($count);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function editarServicio()
    {
        try {
            $sql = "UPDATE servicios SET nombre = ?, descripcion = ?, categoria_id = ?, fecha_hora = ?, precio = ?, imagen = ? WHERE id = ?";
            $stmt = $this->connectionDB->prepare($sql);
            $stmt->execute(array($this->getNombre(), $this->getDescripcion(), $this->getCategoriaId(), $this->getFechaHora(), $this->getPrecio(), $this->getImagen(), $this->getId()));
            $count = $stmt->rowCount();
            return $this->affectedColumns($count);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    
    public function affectedColumns($numer): bool
    {
        if ($numer <> null && $numer > 0) {
            $msm = true;
        } else {
            $msm = false;
        }
        return $msm;
    }
}
?>
