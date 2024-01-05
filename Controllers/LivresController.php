<?php
namespace App\Controllers;
use App\Core\Form;
use App\Entities\Livres;
use App\Models\LivresModel;

class LivresController extends Controller
{
    //methode pour afficher la liste des livres disponibles
    public function index()
    {
        $livres = new LivresModel();
        $list = $livres->findAll();
        $this->render('livres/index', ['list'=>$list]);
    }

    //methode d'ajout d'un livre
    public function add()
        {
            if(Form::validatePost($_FILES, ['file'])){
                $tmpName = $_FILES['file']['tmp_name'];
                $name = $_FILES['file']['name'];
                $tabExtension = explode('.',$name);
                $extension = strtolower(end($tabExtension));
                $extensions = ['jpg'];
                if(in_array($extension, $extensions)){
                move_uploaded_file($tmpName,'image/'.$name);}
                else{
                    echo "Mauvaise extension";
                }
            }
            //on controle si les champs du formulaires sont remplis
            if (Form::validatePost($_POST,['titre','auteur'])){
                $livres = new Livres();
    
                //on l'hydrate
                $livres->setTitre($_POST['titre']);
                $livres->setAuteur($_POST['auteur']);
    
                //on instancie le model "livres"
                $model = new LivresModel();
                $model->create($livres);
    
                //on redirige l'utilisateur vers la liste des livres
                header("Location:index.php?controller=livres&action=index");
            }else {
                //on affiche un messsage d'erreur
                $erreur = !empty($_POST) ? "Le formulaire n'a pas été correctement rempli" :"";
            }
            //on instancie la classe Form pour construire le formulaire d'ajout
            $form = new Form();
    
            //on construit le formulaire d'ajout
            $form->startForm("#","POST",["entype"=>"multipart/form-data"]);
            $form->addLabel("auteur","Auteur",["class"=>"form-label text-light"]);
            $form->addInput("text","auteur",["id"=>"auteur", "class"=>"form-control", "placeholder"=>"Auteur du livre"]);
            $form->addLabel("titre","Titre",["class"=>"form-label text-light"]);
            $form->addInput("text","titre",["id"=>"titre", "class"=>"form-control", "placeholder"=>"Titre du livre"]);
            $form->addLabel("file", "Ajouter une image pour la couverture en .jpg",["class"=>"form-label text-light"]);
            $form->addInput("file", "file", ["id"=>"file", "class"=>"form-control"]);
            $form->addInput("submit","add",["value"=>"Ajouter", "class"=>"btn btn-dark text-warning"]);
            $form->endForm();
    
            //on envoie le formulaire dans la vue add.php
            $this->render('livres/add',["addForm"=>$form->getFormElements()]);
        }
}