<?php
namespace App\Models;
session_start();

use Exception;
use App\Core\DbConnect;
use App\Entities\Lecteurs;

class LecteursModel extends DbConnect
{
    public function findAll()
    {
        $this->request = 'SELECT * FROM lecteur ORDER BY nom';
        $result = $this->connection->query($this->request);
        $list = $result->fetchAll();
        return $list;
    }

    public function create(Lecteurs $lecteurs)
    {
        $this->request = $this->connection->prepare("INSERT INTO lecteur VALUES (NULL, :nom, :prenom)");
        $this->request->bindValue(":nom", $lecteurs->getNom());
        $this->request->bindValue(":prenom", $lecteurs->getPrenom());
        $this->executeTryCatch();
    }

    private function executeTryCatch()
    {
        try{
            $this->request->execute();
        }catch (Exception $e){
            die('Erreur : ' . $e->getMessage());
        }
        //Ferme le curseur, permettant à la requête d'être de nouvea uexécutée
        $this->request->closeCursor();
    }
}   