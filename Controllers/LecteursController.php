<?php
namespace App\Controllers;
use App\Core\Form;
use App\Entities\Lecteurs;
use App\Models\LecteursModel;

class LecteursController extends Controller {
    // Méthode pour afficher la liste
    public function index() {
        $lecteursModel = new LecteursModel();
        $list = $lecteursModel->findAll();
        $this->render('lecteurs/index', ['list' => $list]);
    }

    public function add() {
        // On contrôle si les champs du formulaire sont remplis
        if (Form::validatePost($_POST, ['nom', 'prenom'])) {
            $lecteur = new Lecteurs();

            // On hydrate l'objet Lecteurs
            $lecteur->setNom($_POST['nom']);
            $lecteur->setPrenom($_POST['prenom']);

            // On instancie le modèle LecteursModel
            $lecteursModel = new LecteursModel();
            $lecteursModel->create($lecteur);

            // On redirige l'utilisateur vers la liste des lecteurs
            header("Location: index.php?controller=lecteurs&action=index");
            exit(); // Terminer le script après la redirection
        } else {
            // On affiche un message d'erreur
            $erreur = !empty($_POST) ? "Le formulaire n'a pas été correctement rempli" : "";
        }

        // On instancie la classe Form pour construire le formulaire d'ajout
        $form = new Form();

        // On construit le formulaire d'ajout
        $form->startForm("#", "POST", ["enctype" => "multipart/form-data"]);
        $form->addLabel("nom", "Nom", ["class" => "form-label text-light"]);
        $form->addInput("text", "nom", ["id" => "nom", "class" => "form-control", "placeholder" => "Nom"]);
        $form->addLabel("prenom", "Prénom", ["class" => "form-label text-light"]);
        $form->addInput("text", "prenom", ["id" => "prenom", "class" => "form-control", "placeholder" => "Prénom"]);
        $form->addInput("submit", "add", ["value" => "Ajouter", "class" => "btn btn-dark text-warning"]);
        $form->endForm();

        // On envoie le formulaire dans la vue add.php avec éventuellement un message d'erreur
        $this->render('lecteurs/add', ["addForm" => $form->getFormElements(), "erreur" => $erreur]);
    }
}
