<?php
#include file

include ('../dataAccess/conexion/Conexion.php');

class Categoria
{
    #atributos
    private string $id;
    private string $nombre;
    private string $descripcion;
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

    public function setImagen(string $imagen): void
    {
        $this->imagen = $imagen;
    }

    public function getImagen(): string
    {
        return $this->imagen;
    }

    #metodos
    #añadir categoria
    public function registrarCategoria(): bool
    {
        try {
        $sql="INSERT INTO categorias (nombre, descripcion, imagen) VALUES (?, ?, ?)";
        $stmt=$this->connectionDB->prepare($sql);
        $stmt->execute(array( $this->getNombre(), $this->getDescripcion(),  $this->getImagen()));
        $count =$stmt->rowCount();
        return $this->affectedColumns($count);
        } catch (PDOException $e) { 
            echo $e->getMessage();
            return false;
        }
    }
    #listar categorias
    public function listarCategoria()
    {
        try {
            $sql= "SELECT * FROM categorias";
            $stmt= $this->connectionDB->prepare($sql);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $arrayQuery=$stmt->fetchAll();
            return $arrayQuery;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return [];

    }

    //borrar categoria
    public function eliminarCategoria():bool
    {
        try {
            $sql= "DELETE FROM categorias WHERE id=?";
            $stmt= $this->connectionDB->prepare($sql);
            $stmt->execute(array($this->getId()));
            $count=$stmt->rowCount();
            return $this->affectedColumns($count);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function editarCategoria(){
        try {
            $sql="UPDATE categorias SET nombre = ?, descripcion = ?, imagen = ? WHERE id = ?";
            $stmt=$this->connectionDB->prepare($sql);
            $stmt->execute(array($this->getNombre(), $this->getDescripcion(), $this->getImagen(), $this->getId()));
            $count=$stmt->rowCount();
            return $this->affectedColumns($count);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    
    public function affectedColumns($numer): bool
    {
        if ($numer<>null && $numer>0) {
            $msm=true;
        } else {
            $msm=false;
        }
        return $msm;
    }
}

?>
