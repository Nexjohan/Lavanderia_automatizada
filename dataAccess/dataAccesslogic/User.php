<?php
#include file

include ('../dataAccess/conexion/Conexion.php');

class Usuario
{
    #atributos
    private string $id;
    private string $nombre;
    private string $correo;
    private string $password;
    private string $rol;

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

    public function setCorreo(string $correo): void
    {
        $this->correo = $correo;
    }

    public function getCorreo(): string
    {
        return $this->correo;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setRol(string $rol): void
    {
        $this->rol = $rol;
    }

    public function getRol(): string
    {
        return $this->rol;
    }

    #metodos
    #añadir usuario
    public function registrarUsuario(): bool
    {
        try {
            $sql = "INSERT INTO usuarios (nombre, correo, password, rol) VALUES (?, ?, ?, ?)";
            $stmt = $this->connectionDB->prepare($sql);
            $stmt->execute(array($this->getNombre(), $this->getCorreo(), $this->getPassword(), $this->getRol()));
            $count = $stmt->rowCount();
            return $this->affectedColumns($count);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    #listar usuarios
    public function listarUsuario()
    {
        try {
            $sql = "SELECT * FROM usuarios";
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

    //borrar usuario
    public function eliminarUsuario(): bool
    {
        try {
            $sql = "DELETE FROM usuarios WHERE id = ?";
            $stmt = $this->connectionDB->prepare($sql);
            $stmt->execute(array($this->getId()));
            $count = $stmt->rowCount();
            return $this->affectedColumns($count);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function editarUsuario()
    {
        try {
            $sql = "UPDATE usuarios SET nombre = ?, correo = ?, password = ?, rol = ? WHERE id = ?";
            $stmt = $this->connectionDB->prepare($sql);
            $stmt->execute(array($this->getNombre(), $this->getCorreo(), $this->getPassword(), $this->getRol(), $this->getId()));
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

    public function login(string $correo, string $password)
    {
        try {
            $sql = "SELECT * FROM usuarios WHERE correo = ? AND password = ?";
            $stmt = $this->connectionDB->prepare($sql);
            $stmt->execute(array($correo, $password));
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            return $user;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    
}
?>
