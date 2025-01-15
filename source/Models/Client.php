<?php

namespace Source\Models;

use Source\Core\Connect;

class Client 
{
    private $id;
    private $name;
    private $cnpj;
    private $state;
    private $nation;
    private $description;
    private $link;

    public function __construct(
        $name = NULL,
        $cnpj = NULL,
        $state = NULL,
        $nation = NULL,
        $description = NULL,
        $link = NULL
    )
    {
        $this->name = $name;
        $this->cnpj = $cnpj;
        $this->state = $state;
        $this->nation = $nation;
        $this->description = $description;
        $this->link = $link;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

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
 
    public function getCnpj()
    {
        return $this->cnpj;
    }
 
    public function setCnpj($cnpj)
    {
        $this->cnpj = $cnpj;

        return $this;
    }

    public function getState()
    {
        return $this->state;
    }

    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    public function getNation()
    {
        return $this->nation;
    }

    public function setNation($nation)
    {
        $this->nation = $nation;

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

    
    public function getLink()
    {
        return $this->link;
    }
 
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    public function insert() 
    {
        $query = "INSERT INTO clients (name, cnpj, state, nation, description, link) 
        VALUES (:name, :cnpj, :state, :nation, :description, :link)";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":cnpj", $this->cnpj);
        $stmt->bindParam(":state", $this->state);
        $stmt->bindParam(":nation", $this->nation);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":link", $this->link);
        $stmt->execute();
        
        return true;
    }

    public function delete($id, $cnpj)
    {
        $query = "DELETE FROM clients WHERE id = :id AND cnpj = :cnpj";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":cnpj", $cnpj);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            return true;

        } else {
            return false;
            
        }
    }

    public function selectAll()
    {
        $query = "SELECT * FROM clients";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            return $stmt->fetchAll();

        } else {
            return false;
            
        }
    }

    public function findNameClient(int $id)
    {
        $query = "SELECT name FROM clients WHERE id = :id";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            return $stmt->fetch();

        } else {
            return false;
            
        }
    }

    public function findByCnpj()
    {
        $query = "SELECT * FROM clients WHERE cnpj = :cnpj";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":cnpj", $this->cnpj);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            return true;

        } else {
            return false;
            
        }
    }

    public function validate($id, $cnpj)
    {
        $query = "SELECT * FROM clients WHERE id = :id AND cnpj = :cnpj";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":cnpj", $cnpj);
        $stmt->execute();

        if($stmt->rowCount() == 1){
            $client = $stmt->fetch();
            $this->id = $client->id;
            $this->name = $client->name;
            $this->cnpj = $client->cnpj;
            $this->state = $client->state;
            $this->nation = $client->nation;
            $this->description = $client->description;
            $this->link = $client->link;

            $arrayClient = [
                "id" => $this->id,
                "name" => $this->name,
                "cnpj" => $this->cnpj,
                "state" => $this->state,
                "nation" => $this->nation
            ];

            $_SESSION["client"] = $arrayClient;
            setcookie("client","Logado",time()+60*60,"/");

            return true;

        } else {
            return false;
            
        }
    }

    public function CountUsers($id_client)
    {
        $query = "SELECT * FROM users WHERE id_client = :id_client";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":id_client", $id_client);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->rowCount();
        } else {
            return 0;
        }


    }

}