<?php

namespace Source\Models;
use Source\Core\Connect;

class Note
{

    private $id_user;
    private $name;
    private $description;
    private $time;
    private $message;

    public function __construct(
        $id_user = NULL,
        $name = NULL,
        $description = NULL,
        $time = NULL
    )
    {
        $this->id_user = $id_user;
        $this->name = $name;
        $this->description = $description;
        $this->time = $time;
    }
    
    public function getId_user()
    {
        return $this->id_user;
    }

    public function setId_user($id_user)
    {
        $this->id_user = $id_user;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    public function getTime()
    {
        return $this->time;
    }

    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function insert()
    {
        $query = "INSERT INTO notes (id_user, name, description, time) VALUES (:id_user, :name, :description, :time)";
        $stmt = Connect::getInstance()->prepare($query);
        
        $stmt->bindParam(":id_user", $this->id_user);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":time", $this->time);
        $stmt->execute();
        $this->message = "Nota cadastrada com sucesso!";
        return true;
    }

    public function selectAll(int $id_user)
    {
        $query = "SELECT * FROM notes WHERE id_user = :id_user";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam("id_user", $id_user);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            return $stmt->fetchAll();

        } else {
            return false;
            
        }
    }

    public function findByIdUser(int $id_user)
    {
        $query = "SELECT * FROM notes WHERE id_user = :id_user";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":id_user", $id_user);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            return $stmt->fetchAll();

        } else {
            return false;
            
        }
    }
}