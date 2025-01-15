<?php

namespace Source\App;

use League\Plates\Engine;
use Source\Models\Archive;
use Source\Models\Client;
use Source\Models\User;
use Source\Models\Note;

class App
{
    private $view;

    public function __construct()
    {
        if (empty($_SESSION["user"]) || empty($_COOKIE["user"])) {
            header("Location:http://www.localhost/valen/entrar");
        }
        setcookie("user", "Logado", time() + 60 * 60, "/");
        $this->view = new Engine(CONF_VIEW_APP, 'php');
    }

    public function home(): void
    {

        $user = new User($_SESSION["user"]["id"]);
        $user->findById();

        $client = new Client();
        $clients_All = $client->selectAll();
        $client_Name = $client->findNameClient($_SESSION["user"]["id_client"]);
        

        echo $this->view->render(
            "home",
            [
                "user" => $user,
                "clients_All" => $clients_All,
                "client_Name" => $client_Name
            ]
        );

    }

    public function note(): void
    {
        $note = new Note();
        $notes = $note->selectAll($_SESSION["user"]["id"]);

        echo $this->view->render(
            "note",
            [
                "notes" => $notes
            ]
        );
    }

    public function archive(): void
    {
        $archive = new Archive();
        $archives = $archive->selectAll($_SESSION["user"]["id_client"]);

        echo $this->view->render("archive", [
            "archives" => $archives
        ]);
    }

    public function noteUpdate(array $data): void
    {

        if (!empty($data)) {

            if (in_array("", $data)) {
                $noteJson = [
                    "message" => "Informe todos os campos!",
                    "type" => "alert-danger"
                ];
                echo json_encode($noteJson);
                return;
            }

            $note = new Note(
                $_SESSION["user"]["id"],
                $data["name"],
                $data["description"],
                $data["time"]
            );

            $note->insert();

            $noteJson = [
                "message" => $note->getMessage(),
                "type" => "alert-success",
                "name" => $note->getName(),
                "description" => $note->getDescription(),
                "time" => $note->getTime()
            ];
            echo json_encode($noteJson);
        }
    }

    public function list(): void
    {
        require __DIR__ . "/../../themes/app/list.php";
    }

    public function createPDF(): void
    {
        require __DIR__ . "/../../themes/app/create-pdf.php";
    }

    public function logout()
    {
        session_destroy();
        setcookie("user", "", time() - 3600, "/");
        header("Location:http://www.localhost/valen/");
    }

    public function profile()
    {
        // buscar as informações do usuário da SESSION.
        // $user = $_SESSION["user"];
        // buscar as informações do usuário no BD
        $user = new User($_SESSION["user"]["id"]);
        $user->findById();

        //var_dump($user->getPhoto());

        echo $this->view->render("profile", [
            "user" => $user
        ]);
    }

    public function profileUpdate(array $data): void
    {
        if (!empty($data)) {

            if (in_array("", $data)) {
                $userJson = [
                    "message" => "Informe todos os campos!",
                    "type" => "alert-danger"
                ];
                echo json_encode($userJson);
                return;
            }

            if (!empty($_FILES['photo']['tmp_name'])) {
                $upload = uploadImage($_FILES['photo']);
                unlink($_SESSION["user"]["photo"]);
            } else {
                // se não houve alteração da imagem, manda a imagem que está na sessão
                $upload = $_SESSION["user"]["photo"];
            }

            $user = new User(
                $_SESSION["user"]["id"],
                $_SESSION["user"]["id_client"],
                $data["name"],
                $data["email"],
                null,
                null,
                $upload
            );
            $user->update();
            $userJson = [
                "message" => $user->getMessage(),
                "type" => "alert-success",
                "name" => $user->getName(),
                "email" => $user->getEmail(),
                "photo" => url($user->getPhoto())
            ];
            echo json_encode($userJson);
        }
    }
}