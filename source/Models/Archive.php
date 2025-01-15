<?php

namespace Source\Models;

use Source\Core\Connect;

class Archive 
{
    private $id_client;
    private $name;
    private $description;
    private $category;
    private $message;

    public function __construct(
        $id_client = NULL,
        $name = NULL, 
        $description = NULL,
        $category = NULL
    ) 
    {
        $this->id_client = $id_client;
        $this->name = $name;
        $this->description = $description;
        $this->category = $category;
    }

    public function getId_client()
    {
        return $this->id_client;
    }

    public function setId_client($id_client)
    {
        $this->id_client = $id_client;

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

    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function insert()
    {
        $query = "INSERT INTO archives (id_client, name, description, category) 
        VALUES (:id_client, :name, :description, :category)";

        $stmt = Connect::getInstance()->prepare($query);

        $stmt->bindParam(":id_client", $this->id_client);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":category", $this->category);
        $stmt->execute();

        return true;
    }

    public function delete($id)
    {
        $query = "DELETE FROM archives WHERE id = :id";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            return true;

        } else {
            return false;
            
        }
    }

    public function selectAll(int $id_client)
    {
        $query = "SELECT * FROM archives WHERE id_client = :id_client";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":id_client", $id_client);
        $stmt->execute();

        if($stmt->rowCount() == 0){
            return false;
        } else {
            return $stmt->fetchAll();
        }
    }

}