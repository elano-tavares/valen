<?php

namespace Source\Models;

use Source\Core\Connect;

class Faq
{
    private $question;
    private $answer;

    public function __construct(
        $question = NULL,
        $answer = NULL
    )
    {
        $this->question = $question;
        $this->answer = $answer;
    }

    public function getQuestion()
    {
        return $this->question;
    }

    public function setQuestion($question)
    {
        $this->question = $question;

        return $this;
    }

    public function getAnswer()
    {
        return $this->answer;
    }

    public function setAnswer($answer)
    {
        $this->answer = $answer;

        return $this;
    }

    public function insert() 
    {
        $query = "INSERT INTO faqs (question, answer) VALUES (:question, :answer)";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":question", $this->question);
        $stmt->bindParam(":answer", $this->answer);
        $stmt->execute();
        
        return true;
    }

    public function delete($id)
    {
        $query = "DELETE FROM faqs WHERE id = :id";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            return true;

        } else {
            return false;
            
        }
    }

    public function selectAll()
    {
        $query = "SELECT * FROM faqs";
        $stmt = Connect::getInstance()->prepare($query);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            return $stmt->fetchAll();

        } else {
            return false;
            
        }
    }
}