<?php
#include file

include ('../dataAccess/conexion/Conexion.php');

class Pedido
{
    #atributos
    private  $id;
    private  $nombre;
    private  $descripcion;
    private  $categoria_id;

    private $connectionDB;

    #constructor  
    public function __construct(ConexionDB $connectionDB)
    {
        $this->connectionDB = $connectionDB->connect();
    }

    // Métodos Get y Set para cada propiedad
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getId(): int
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

    public function setCategoriaId(int $categoria_id): void
    {
        $this->categoria_id = $categoria_id;
    }

    public function getCategoriaId(): int
    {
        return $this->categoria_id;
    }
    #metodos
    #añadir pedido
    public function registrarPedido(): bool
    {
        try {
            $sql = "INSERT INTO pedidos (nombre, descripcion, categoria_id,) VALUES (?, ?, ?)";
            $stmt = $this->connectionDB->prepare($sql);
            $stmt->execute([$this->getNombre(), $this->getDescripcion(), $this->getCategoriaId()]);
            $count = $stmt->rowCount();
            return $this->affectedColumns($count);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    #listar pedidos
    public function listarPedido()
    {
        try {
            $sql = "SELECT * FROM pedidos";
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

    #borrar pedido
    public function eliminarPedido(): bool
    {
        try {
            $sql = "DELETE FROM pedidos WHERE id=?";
            $stmt = $this->connectionDB->prepare($sql);
            $stmt->execute(array($this->getId()));
            $count = $stmt->rowCount();
            return $this->affectedColumns($count);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function editarPedido()
    {
        try {
            $sql = "UPDATE pedidos SET nombre = ?, descripcion = ?,  WHERE id = ?";
            $stmt = $this->connectionDB->prepare($sql);
            $stmt->execute(array($this->getNombre(), $this->getDescripcion(), , $this->getId()));
            $count = $stmt->rowCount();
            return $this->affectedColumns($count);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    
    public function affectedColumns($numer): bool
    {
        return $numer > 0;
    }
}
?>
