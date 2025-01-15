<?php

namespace Source\App;

use League\Plates\Engine;
use Source\Models\Archive;
use Source\Models\Client;
use Source\Models\User;

class Adm
{
    private $view;

    public function __construct()
    {
        if (empty($_SESSION["client"]) || empty($_COOKIE["client"])) {
            header("Location:http://www.localhost/valen/entrar-adm");
        }
        setcookie("client", "Logado", time() + 60 * 60, "/");
        $this->view = new Engine(CONF_VIEW_ADMIN, 'php');
    }
    public function home () : void
    {
        $client = new Client();
        $clients = $client->CountUsers($_SESSION["client"]["id"]);
        echo $this->view->render("home", [
            "clients" => $clients
        ]);
    }

    public function newArchive (?array $data)
    {

        if(!empty($data)){

            if(in_array("",$data)){
                $json = [
                    "message" => "<br> Informe todos os campos para cadastrar!",
                    "type" => "warning"
                ];
                echo json_encode($json);
                return;
            }

            $archive = new Archive(
                $data['id_client'],
                $data['name'],
                $data['description'],
                $data['category']
            );


            if(!$archive->insert()){
                $json = [
                    "message" => "Não foi possível efetuar o cadastro!",
                    "type" => "error"
                ];
                echo json_encode($json);
                return;
            } else {
                $json = [
                    "id_client" => $data['id_client'],
                    "name" => $data['name'],
                    "description" => $data['description'],
                    "category" => $data['category'],
                    "message" => "Novo Arquivo Cadastrado!",
                    "type" => "success"
                ];
                echo json_encode($json);
                return;
            }
        }

        echo $this->view->render("insert-archive");
    }

    public function deleteArchive (?array $data)
    {
        if(!empty($data)){

            if(in_array("",$data)){
                $json = [
                    "message" => "<br> Informe o id para deletar!",
                    "type" => "warning"
                ];
                echo json_encode($json);
                return;
            }

            $archive = new Archive();

            if(!$archive->delete($data['id'])){
                $json = [
                    "message" => "Não foi possível deletar, informe os dados novamente!",
                    "type" => "error"
                ];
                echo json_encode($json);
                return;
            } else {
                $json = [
                    "message" => "Arquivo Deletado com Sucesso!",
                    "type" => "success"
                ];
                echo json_encode($json);
                return;
            }
        }

        echo $this->view->render("delete-archive");
    }

    public function deleteUser (?array $data)
    {

        if(!empty($data)){

            if(in_array("",$data)){
                $json = [
                    "message" => "<br> Informe o id e o gmail para deletar!",
                    "type" => "warning"
                ];
                echo json_encode($json);
                return;
            }

            $user = new User();

            if(!$user->delete($data['id'], $data['email'])){
                $json = [
                    "message" => "Não foi possível deletar, informe os dados novamente!",
                    "type" => "error"
                ];
                echo json_encode($json);
                return;
            } else {
                $json = [
                    "message" => "Usuário Deletado com Sucesso!",
                    "type" => "success"
                ];
                echo json_encode($json);
                return;
            }
        }

        echo $this->view->render("delete-user");
    }

    public function logout()
    {
        session_destroy();
        setcookie("client", "", time() - 3600, "/");
        header("Location:http://www.localhost/valen/");
    }
}