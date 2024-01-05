<?php
namespace App\Controllers;
use App\Core\Form;
use App\Entities\Emprunt;
use App\Models\EmpruntModel;


    class EmpruntController extends Controller{
        //methode pour afficher la liste
        public function index()
        {
            $emprunts = new EmpruntModel();
            $list = $emprunts->findAll();
            $this->render('emprunt/index', ['list'=>$list]);
        }

        //methode pour réalisé un emprunt
        public function add()
        {
            //on controle si les champs du formulaires sont remplis
            if (Form::validatePost($_POST,['id_lecteur','id_livre','date_emprunt'])){
                $emprunt = new Emprunt();
    
                //on l'hydrate
                $emprunt->setId_lecteur($_POST['id_lecteur']);
                $emprunt->setId_livre($_POST['id_livre']);
                $emprunt->setDate_emprunt($_POST['date_emprunt']);
    
                //on instancie le model "creation"
                $model = new EmpruntModel();
                $model->create($emprunt);
    
                //on redirige l'utilisateur vers la liste des créatons
                header("Location:index.php?controller=emprunt&action=index");
            }else {
                //on affiche un messsage d'erreur
                $erreur = !empty($_POST) ? "Le formulaire n'a pas été correctement rempli" :"";
            }
            //on instancie la classe Form pour construire le formulaire d'ajout
            $form = new Form();

            //on construit le formulaire d'ajout
            $form->startForm("#","POST",["entype"=>"multipart/form-data"]);
            $form->addLabel("id_livre","Titre du livre",["class"=>"form-label text-light"]);
            $form->addSelect("id_livre",["id"=>"id_livre", "class"=>"form-control"]);
            $livre = new EmpruntModel();
            $listLivre = $livre->findLivre();
            foreach($listLivre as $element){
                $valeur = $element->id_livre;
                $titre = $element->titre;
                $form->addOption($valeur, $titre);
            }
            $form->endSelect();
            $form->addLabel("id_lecteur","Nom de l'emprunteur",["class"=>"form-label text-light"]);
            $form->addSelect("id_lecteur",["id"=>"id_lecteur", "class"=>"form-control"]);
            $lecteur = new EmpruntModel();
            $listLecteur = $lecteur->findLecteur();
            foreach($listLecteur as $element){
                $valeur = $element->id_lecteur;
                $titre = $element->nom ." " .$element->prenom;
                $form->addOption($valeur, $titre);
            }
            $form->endSelect();
            $form->addLabel("date_emprunt","Date de l'emprunt",["class"=>"form-label text-light"]);
            $form->addInput("date","date_emprunt",["id"=>"date_emprunt", "class"=>"form-control"]);
            $form->addInput("submit","add",["value"=>"Emprunter", "class"=>"btn btn-dark text-warning"]);
            $form->endForm();

            //on envoie le formulaire dans la vue add.php
            $this->render('emprunt/add',["addForm"=>$form->getFormElements()]);
        }

        public function retour($id)
        {
            if (isset($_POST['true'])){
                //on instancie la classe EmpruntModel pour exécuter le retour avec la méthode retour()
                //en récupérant l'id de la création du lien "oui"
                $retour = new EmpruntModel();
                $id = $_GET['id'];

                $retour->retour($id);
                //on redirige l'utilisateur
                header("Location:index.php?controller=emprunt&action=index");
            }elseif (isset($_POST['false'])){

                //on redirige l'utilisateur vers la liste des emprunts
                header("Location:index.php?controller=emprunt&action=index");
            }else {
                //on récupére l'emprunt avec la methode find()
                $retour = new EmpruntModel();

            $form = new Form();
    
            $form->startForm("#","POST",["entype"=>"multipart/form-data"]);
            $form->addInput("submit","true",["value"=>"Oui", "class"=>"btn btn-dark"]);
            $form->addInput("submit","false",['value'=>"Non", "class"=>'btn btn-dark']);
            $form->endForm();
        
            //on renvoie vers la vue la categorie sélectionnée
            $this->render('emprunt/retour',["retourForm"=>$form->getFormElements()]);
            }
        }
    }