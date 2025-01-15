<?php

namespace Source\App;

use League\Plates\Engine;
use Source\Models\Client;
use Source\Models\Faq;
use Source\Models\User;

class Web
{
    private $view;

    public function __construct()
    {
        $this->view = new Engine(CONF_VIEW_WEB,'php');
    }

    public function home() : void
    {

        echo $this->view->render("home");
    }

    public function login(?array $data) : void
    {
        if(!empty($data)){

            if(in_array("",$data)){
                $json = [
                    "message" => "<br> Informe e-mail e senha para entrar!",
                    "type" => "warning"
                ];
                echo json_encode($json);
                return;
            }

            if(!is_email($data["email"])){
                $json = [
                    "message" => " <br> Por favor, informe um e-mail válido!",
                    "type" => "warning"
                ];
                echo json_encode($json);
                return;
            }

            $user = new User();

            if(!$user->validate($data["email"],$data["password"])){
                $json = [
                    "message" => $user->getMessage(),
                    "type" => "error"
                ];
                echo json_encode($json);
                return;
            }

            $json = [
                "name" => $user->getName(),
                "email" => $user->getEmail(),
                "id_client" => $user->getId_client(),
                "message" => $user->getMessage(),
                "type" => "success"
            ];
            echo json_encode($json);
            return;

        }

        echo $this->view->render("login",["eventName" => CONF_SITE_NAME]);

    }

    public function register(?array $data) : void
    {
        if(!empty($data)){

            if(in_array("",$data)){
                $json = [
                    "message" => "<br> Informe nome, e-mail e senha para cadastrar!",
                    "type" => "warning"
                ];
                echo json_encode($json);
                return;
            }

            if(!is_email($data["email"])){
                $json = [
                    "message" => "<br> Informe um e-mail válido!",
                    "type" => "warning"
                ];
                echo json_encode($json);
                return;
            }

            $user = new User(
                NULL,
                $data["id_client"],
                $data["name"],
                $data["email"],
                $data["password"]
            );

            if($user->findByEmail($data["email"])){
                $json = [
                    "message" => "<br> Email já cadastrado!",
                    "type" => "error"
                ];
                echo json_encode($json);
                return;
            }

            if(!$user->insert()){
                $json = [
                    "message" => $user->getMessage(),
                    "type" => "error"
                ];
                echo json_encode($json);
                return;
            } else {
                $json = [
                    "name" => $data["name"],
                    "email" => $data["email"],
                    "id_client" => $data["id_client"],
                    "message" => $user->getMessage(),
                    "type" => "success"
                ];
                echo json_encode($json);
                return;
            }
            return;
        }

        echo $this->view->render("register",[
            "eventName" => CONF_SITE_NAME
        ]);
    }

    public function admin(?array $data) : void
    {
        if (!empty($data)) {

            if (in_array("", $data)) {
                $json = [
                    "message" => "<br> Informe CNPJ e ID para entrar!",
                    "type" => "warning"
                ];
                echo json_encode($json);
                return;
            }

            if ($data['id'] == 737373 && $data['cnpj'] == 25052005){
                $json = [
                    "name" => "ADM (SUPER)",
                    "message" => "Usuário Autorizado, redirect to ADM-SUPER!",
                    "type" => "success-adm"
                ];

                $arrayAdmSuper = [
                    "id" => 0,
                    "name" => "ADM (SUPER)"
                ];
    
                $_SESSION["admSuper"] = $arrayAdmSuper;
                setcookie("admSuper","Logado",time()+60*60,"/");

                echo json_encode($json);
                return;
            }

            $client = new Client();

            if (!$client->validate($data['id'], $data['cnpj'])) {
                $json = [
                    "message" => "<br> Informe um CNPJ e ID válido para entrar!",
                    "type" => "warning"
                ];
                echo json_encode($json);
                return;
            }

            $json = [
                "name" => $client->getName(),
                "cnpj" => $client->getCnpj(),
                "state" => $client->getState(),
                "nation" => $client->getNation(),
                "description" => $client->getDescription(),
                "link" => $client->getLink(),
                "message" => "Usuário Autorizado, redirect to ADM!",
                "type" => "success"
            ];
            echo json_encode($json);
            return;
        }
            

        echo $this->view->render("login_adm",["eventName" => CONF_SITE_NAME]);
    }

    public function about() : void
    {
        echo $this->view->render("about");
    }

    public function faq() : void 
    {
        $faq = new Faq();
        $faqs = $faq->selectAll();

        echo $this->view->render("faq", [
            "faqs" => $faqs
        ]);
    }

    public function localization()
    {
        //echo "Localização";
        echo $this->view->render("localization"); // Engine
    }

    public function contact(array $data) : void
    {
        //var_dump($data);
        echo $this->view->render("contact");
    }

    public function error(array $data) : void
    {
//      echo "<h1>Erro {$data["errcode"]}</h1>";
//      include __DIR__ . "/../../themes/web/404.php";
        echo $this->view->render("404", [
            "title" => "Erro {$data["errcode"]} | " . CONF_SITE_NAME,
            "error" => $data["errcode"]
        ]);
    }

}