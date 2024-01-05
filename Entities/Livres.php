<?php
namespace App\Entities;

class Livres
{
    private $id_livre;
    private $auteur;
    private $titre;

    /**
     * Get the value of id_livre
     */
    public function getId_livre()
    {
        return $this->id_livre;
    }

    /**
     * Set the value of id_livre
     * @return self
     */
    public function setId_livre($id_livre)
    {
        $this->id_livre = $id_livre;
        return $this;
    }

    /**
     * Get the value of titre
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set the value of titre
     * @return self
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
        return $this;
    }

    /**
     * Get the value of auteur
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * Set the value of auteur
     * @return self
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;
        return $this;
    }
}