<?php
namespace App\Models;
session_start();

use Exception;
use App\Core\DbConnect;
use App\Entities\Emprunt;
use App\Core\Form;

class EmpruntModel extends DbConnect
{
    public function findAll()
    {
        $this->request = 'SELECT * FROM ((emprunter LEFT JOIN lecteur ON emprunter.id_lecteur = lecteur.id_lecteur)LEFT JOIN livre ON emprunter.id_livre = livre.id_livre)';
        $result = $this->connection->query($this->request);
        $list = $result->fetchAll();
        return $list;
    }

    public function findLivre()
    {
        $this->request = 'SELECT * FROM livre WHERE id_livre NOT IN (SELECT id_livre FROM emprunter) ORDER BY titre';
        $result = $this->connection->query($this->request);
        $listLivre = $result->fetchAll();
        return $listLivre;
    }

    public function findLecteur()
    {
        $this->request = 'SELECT * FROM lecteur ORDER BY nom';
        $result = $this->connection->query($this->request);
        $listLecteur = $result->fetchAll();
        return $listLecteur;
    }

    public function create(Emprunt $emprunts)
    {
        $this->request = $this->connection->prepare("INSERT INTO emprunter VALUES (:id_lecteur, :id_livre, :date_emprunt, :date_emprunt + INTERVAL 21 DAY)");
        $this->request->bindValue(":id_lecteur", $emprunts->getId_lecteur());
        $this->request->bindValue(":id_livre", $emprunts->getId_livre());
        $this->request->bindValue(":date_emprunt", $emprunts->getDate_emprunt());
        $this->executeTryCatch();
    }

    public function retour(int $id_livre)
    {
        $this->request = $this->connection->prepare('DELETE FROM emprunter WHERE id_livre = :id_livre');
        $this->request->bindParam('id_livre', $id_livre);
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