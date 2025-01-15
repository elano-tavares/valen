<?php 

namespace Source\App;
use Source\Models\Orientation;
use Source\Models\User;

class Api 
{

    private $user;

    public function __construct()
    {
        header('Content-Type: application/json; charset=UTF-8');

        $headers = getallheaders();

        $this->user = new User();
        $this->orientation = new Orientation();

        if($headers["rule"] === "C"){
            return;
        }

        if(empty($headers["email"]) || empty($headers["password"]) || empty($headers["rule"])){
            $answer = [
                "code" => 400,
                "type" => "bad_request",
                "message" => "Por favor, informe email e senha!"
            ];

            echo json_encode($answer, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return;
        }

        if(!$this->user->validate($headers["email"], $headers["password"])){
            $answer = [
                "code" => 401,
                "type" => "unauthorized",
                "message" => $this->user->getMessage()
            ];

            echo json_encode($answer, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return;
        }
    }

    public function getUser()
    {
        if($this->user->getId() != null){
            echo json_encode($this->user->getArray(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }
    }

    public function updateUser(array $data): void
    {
        if($this->user->getId() != null){
            $this->user->setName($data["name"]);
            $this->user->setEmail($data["email"]);
            $this->user->setDocument($data["document"]);
            $this->user->update();

            $answer = [
                "code" => 200,
                "type" => "success",
                "message" => "Usuário alterado com sucesso!"
            ];

            echo json_encode($answer, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }
        
    }

    public function createUser(array $data): void
    {

        if($this->user->findByEmail($data["email"])){
            $answer = [
                "code" => 400,
                "type" => "bad_request",
                "message" => "Email já cadastrado"
            ];
            echo json_encode($answer, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return;
        }

        $this->user->setName($data["name"]);
        $this->user->setEmail($data["email"]);
        $this->user->setPassword($data["password"]);
        $this->user->insert();

        $answer = [
            "code" => 200,
            "type" => "success",
            "message" => "Usuário cadastrado com sucesso!"
        ];

        echo json_encode($answer, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function getOrientation(array $data): void
    {
        var_dump($this->orientation->findByNumber($data["number"]));
        if($this->orientation->findByNumber($data["number"])){
            echo json_encode($this->orientation->findByNumber($data["number"]), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return;
        }
        
        $answer = [
            "code" => 404,
            "type" => "not_found",
            "message" => "Orientação não encontrada!"
        ];

        echo json_encode($answer, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        return;

    }

}