<?php
namespace App\Models;

use Exception;
use App\Core\DbConnect;
use App\Entities\Livres;

class LivresModel extends DbConnect
{
    public function findAll()
    {
        $this->request = 'SELECT * FROM livre ORDER BY titre';
        $result = $this->connection->query($this->request);
        $list = $result->fetchAll();
        return $list;
    }

    public function create(Livres $livres)
    {
        $this->request = $this->connection->prepare("INSERT INTO livre VALUES (NULL, :auteur, :titre)");
        $this->request->bindValue(":auteur", $livres->getAuteur());
        $this->request->bindValue(":titre", $livres->getTitre());
        $this->executeTryCatch();
    }

    private function executeTryCatch()
    {
        try{
            $this->request->execute();
        }catch (Exception $e){
            die('Erreur : ' . $e->getMessage());
        }
        //Ferme le curseur, permettant à la requête d'être de nouveau uexécutée
        $this->request->closeCursor();
    }
}