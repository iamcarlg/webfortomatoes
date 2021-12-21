
<?php
    if ($ani != NULL){
        
    ?>
        <div class="container" style = "width:100%;">
            <h1><center>Liste de programmation des animations : </center></h1>
        <table class="table table-dark table-hover">
        <thead>
            <tr>
                <th>Etats</th>
                <th>Animation</th>
                <th>Horaire début</th>
                <th>Horaire Fin</th>

            </tr>
        </thead>

        <tbody>
        
        <?php

            // Boucle de parcours de toutes les lignes du résultat obtenu
            // Affichage d’une ligne de tableau pour un pseudo non encore traité
            
                
            // Boucle d’affichage des actualités liées au pseudo
            echo "<tr>";

            echo "<td>";
                                    // Gestion de la programmation des animations 
                                    if($ani->ani_horairedebut > date('Y-m-d H:i:s', time())){ // Animations à venir 
                                        echo "<span style = 'background-color:green; color:white; padding:10px;'>A venir</span>";
            
                                    }else if($ani->ani_horairefin < date('Y-m-d H:i:s', time())){ // Animations passées
                                        echo "<span style = 'background-color:red; color:white; padding:10px;'>Passée</span>";
            
                                    }else{ // Animations en cours 
                                        echo "<span style = 'background-color:blue; color:white; padding:10px;'>En cours</span>";
            
                                    }

                echo "</td>";

                echo "<td>"; echo $ani->ani_intitule; echo "</td>";
                echo "<td>"; echo $ani->ani_horairedebut; echo "</td>";
                echo "<td>"; echo $ani->ani_horairefin; echo "</td>";                 
            echo "</tr>";
    

        } 
        else {
            echo "<br />";
            echo "<div style = 'border: 1px solid black; padding : 20px; margin : 10px;'>";
                echo "<h2 style = 'font-size:30px; text-align : center; '>Aucune animation disponible pour l'instant !</h2>";
        
            echo "</div>";
        
            echo "<br>";
            echo "<br>";

        }
    

        ?>

     </tbody>

    </table>

    <br>
<br>



    </div>