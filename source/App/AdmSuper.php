<?php

namespace Source\App;

use League\Plates\Engine;
use Dompdf\Dompdf;
use Source\Models\Client;
use Source\Models\Faq;


class AdmSuper
{
    private $view;

    public function __construct()
    {
        if (empty($_SESSION["admSuper"]) || empty($_COOKIE["admSuper"])) {
           header("Location:http://www.localhost/valen/entrar-adm");
        }
        setcookie("admSuper", "Logado", time() + 60 * 60, "/");
        $this->view = new Engine(CONF_VIEW_ADMIN_SUPER, 'php');
    }
    public function home () : void
    {
        echo $this->view->render("home");
    }

    public function record () : void
    {
        echo $this->view->render("record");
    }

    public function newClient (?array $data)
    {
        if(!empty($data)){

            if(in_array("",$data)){
                $json = [
                    "message" => "<br> Informe nome, cnpj, estado, nação, descrição e link para cadastrar!",
                    "type" => "warning"
                ];
                echo json_encode($json);
                return;
            }

            $client = new Client(
                $data['name'],
                $data['cnpj'],
                $data['state'],
                $data['nation'],
                $data['description'],
                $data['link']
            );

            if($client->findByCnpj()){
                $json = [
                    "message" => "Cnpj já cadastrado, informe um diferente!",
                    "type" => "error"
                ];
                echo json_encode($json);
                return;
            }


            if(!$client->insert()){
                $json = [
                    "message" => "Não foi possível efetuar o cadastro!",
                    "type" => "error"
                ];
                echo json_encode($json);
                return;
            } else {
                $json = [
                    "name" => $data['name'],
                    "cnpj" => $data['cnpj'],
                    "state" => $data['state'],
                    "nation" => $data['nation'],
                    "description" => $data['description'],
                    "link" => $data['link'],
                    "message" => "Novo Cliente Cadastrado!",
                    "type" => "success"
                ];
                echo json_encode($json);
                return;
            }
        }

        echo $this->view->render("insert-client");

    }

    public function deleteClient (?array $data) : void
    {
        if(!empty($data)){

            if(in_array("",$data)){
                $json = [
                    "message" => "<br> Informe cnpj e id para deletar!",
                    "type" => "warning"
                ];
                echo json_encode($json);
                return;
            }

            $client = new Client();

            if(!$client->delete($data["id"], $data["cnpj"])){
                $json = [
                    "message" => "Não foi possível deletar, informe os dados novamente!",
                    "type" => "error"
                ];
                echo json_encode($json);
                return;
            } else {
                $json = [
                    "message" => "Cliente Deletado com Sucesso!",
                    "type" => "success"
                ];
                echo json_encode($json);
                return;
            }
        }

        echo $this->view->render("delete-client");
    }

    public function newFaq (?array $data) 
    {

        if(!empty($data)){

            if(in_array("",$data)){
                $json = [
                    "message" => "<br> Informe a pergunta e a resposta para cadastrar!",
                    "type" => "warning"
                ];
                echo json_encode($json);
                return;
            }

            $faq = new Faq(
                $data['question'],
                $data['answer']
            );


            if(!$faq->insert()){
                $json = [
                    "message" => "Não foi possível efetuar o cadastro!",
                    "type" => "error"
                ];
                echo json_encode($json);
                return;
            } else {
                $json = [
                    "question" => $data['question'],
                    "answer" => $data['answer'],
                    "message" => "Novo FAQ Cadastrado!",
                    "type" => "success"
                ];
                echo json_encode($json);
                return;
            }
        }

        echo $this->view->render("insert-faq");
    }
    public function deleteFaq (?array $data) : void
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

            $faq = new Faq();

            if(!$faq->delete($data['id'])){
                $json = [
                    "message" => "Não foi possível deletar, informe os dados novamente!",
                    "type" => "error"
                ];
                echo json_encode($json);
                return;
            } else {
                $json = [
                    "message" => "Cliente Deletado com Sucesso!",
                    "type" => "success"
                ];
                echo json_encode($json);
                return;
            }
        }
        echo $this->view->render("delete-faq");
    }

    public function createPDF()
    {
        require __DIR__ . "/../../themes/adm-super/create-pdf.php";
    }

    public function logout()
    {
        session_destroy();
        setcookie("admSuper", "", time() - 3600, "/");
        header("Location:http://www.localhost/valen/");
    }
}