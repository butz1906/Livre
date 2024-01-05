<?php $title = "Lecteurs"?>
    <h2 class="text-light">Liste des lecteurs</h2>
    <table class="table text-light">
        <thead>
            <tr class='d-flex'>
                <th class='col-2'>Numéro d'adhérent</th>
                <th class='col-5'>Nom</th>
                <th class='col-5'>Prénom</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($list as $value){
                echo "<tr class='d-flex'>";
                echo "<td class='col-2'>".$value->id_lecteur."</td>";
                echo "<td class='col-5'>".$value->nom."</td>";
                echo "<td class='col-5'>".$value->prenom."</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <a href="index.php?controller=lecteurs&action=add"><button type="button" class="btn btn-dark text-warning">Inscrire un lecteur</button></a>