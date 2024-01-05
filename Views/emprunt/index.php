<?php $title = "Emprunts"?>
    <h2 class="text-light">Liste des emprunt(s)</h2>
    <table class="table text-light">
        <thead>
            <tr>
                <th scope="col">Titre du livre</th>
                <th scope='col'>Nom du lecteur</th>
                <th scope='col'>Date d'emprunt</th>
                <th scope='col'>Date du retour</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($list as $value){
                echo "<tr>";
                echo "<td>".$value->titre."</td>";
                echo "<td>".$value->nom." ".$value->prenom."</td>";
                echo "<td>".$value->date_emprunt."</td>";
                echo "<td>".$value->date_retour."</td>";
                echo "<td><a class='text-danger' href='index.php?controller=emprunt&action=retour&id=$value->id_livre'>Retour du livre</i></a></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <a href="index.php?controller=emprunt&action=add"><button type="button" class="btn btn-dark text-warning">Emprunter un livre</button></a>