<?php

namespace Source\Models;

use Source\Core\Connect;

class User
{
    private $id;
    private $id_client;
    private $name;
    private $email;
    private $password;
    private $document;
    private $photo;
    private $message;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * Get the value of id_client
     */ 
    public function getId_client()
    {
        return $this->id_client;
    }

    /**
     * Set the value of id_client
     *
     * @return  self
     */ 
    public function setId_client($id_client)
    {
        $this->id_client = $id_client;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string|null $password
     */
    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string|null
     */
    public function getDocument(): ?string
    {
        return $this->document;
    }

    /**
     * @param string|null $document
     */
    public function setDocument(?string $document): void
    {
        $this->document = $document;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * @return mixed
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param mixed $photo
     */
    public function setPhoto($photo): void
    {
        $this->photo = $photo;
    }

    public function __construct(
        int $id = NULL,
        int $id_client = NULL,
        string $name = NULL,
        string $email = NULL,
        string $password = NULL,
        string $document = NULL,
        string $photo = NULL
    )
    {
        $this->id = $id;
        $this->id_client = $id_client;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->document = $document;
        $this->photo = $photo;
    }

    public function selectAll()
    {
        $query = "SELECT * FROM users";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->execute();

        if($stmt->rowCount() == 0){
            return false;
        } else {
            return $stmt->fetchAll();
        }
    }

    public function delete($id, $email)
    {
        $query = "DELETE FROM users WHERE id = :id AND email = :email";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            return true;

        } else {
            return false;
            
        }
    }

    public function findById() : bool
    {
        $query = "SELECT * FROM users WHERE id = :id";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":id",$this->id);
        $stmt->execute();

        if($stmt->rowCount() == 0){
            return false;
        } else {
            $user = $stmt->fetch();
            $this->name = $user->name;
            $this->email = $user->email;
            $this->document = $user->document;
            $this->photo = $user->photo;
            return true;
        }
    }

    public function findByEmail(string $email) : bool
    {
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        if($stmt->rowCount() == 1){
            return true;
        } else {
            return false;
        }
    }

    public function update()
    {
        $query = "UPDATE users SET name = :name, email = :email, photo = :photo, document = :document WHERE id = :id";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":name",$this->name);
        $stmt->bindParam(":email",$this->email);
        $stmt->bindParam(":photo",$this->photo);
        $stmt->bindParam(":document",$this->document);
        $stmt->bindParam(":id",$this->id);
        $stmt->execute();
        $arrayUser = [
            "id" => $this->id,
            "id_client" => $this->id_client,
            "name" => $this->name,
            "email" => $this->email,
            "document" => $this->document,
            "photo" => $this->photo
        ];
        $_SESSION["user"] = $arrayUser;
        $this->message = "Usuário alterado com sucesso!";
    }

    public function insert() : bool
    {
        $query = "INSERT INTO users (id_client, name, email, password) VALUES (:id_client, :name, :email, :password)";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":id_client", $this->id_client);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindValue(":password", password_hash($this->password,PASSWORD_DEFAULT));
        $stmt->execute();
        $this->id = Connect::getInstance()->lastInsertId();
        $this->message = "Usuário cadastrado com sucesso!";
        $_SESSION["user"] = $this;
        return true;
    }

    public function validate (string $email, string $password) : bool
    {
        $query = "SELECT * FROM users WHERE email LIKE :email";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        if($stmt->rowCount() == 0){
            $this->message = "Usuário e/ou Senha não cadastrados!";
            return false;
        } else {
            $user = $stmt->fetch();
            if(!password_verify($password, $user->password)){
                $this->message = "Usuário e/ou Senha não cadastrados!";
                return false;
            }
        }

        $this->id = $user->id;
        $this->id_client = $user->id_client;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->document = $user->document;
        $this->message = "Usuário Autorizado, redirect to APP!";

        $arrayUser = [
            "id" => $this->id,
            "id_client" => $this->id_client,
            "name" => $this->name,
            "email" => $this->email
        ];

        $_SESSION["user"] = $arrayUser;
        setcookie("user","Logado",time()+60*60,"/");
        return true;
    }

    public function getArray() : array
    {

        return ["user" => [
            "id" => $this->id,
            "name" => $this->name,
            "id_client" => $this->id_client,
            "email" => $this->email,
            "document" => $this->document,
            "photo" => $this->photo
            ]];

    }
}