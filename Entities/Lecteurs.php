<?php
namespace App\Entities;

class Lecteurs
{
    private $id_lecteur;
    private $nom;
    private $prenom;

    /**
     * Get the value of id
     */
    public function getId_lecteur()
    {
        return $this->id_lecteur;
    }

    /**
     * Set the value of id
     * @return self
     */
    public function setId_lecteur($id_lecteur)
    {
        $this->id_lecteur = $id_lecteur;
        return $this;
    }

    /**
     * Get the value of nom
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     * @return self
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * Get the value of prenom
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set the value of prenom
     * @return self
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
        return $this;
    }
}