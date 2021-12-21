
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
                <th>Horaire fin</th>
                <th>Lieu</th>
                <th>Invité(s)</th>  
                <th>Détails</th>

            </tr>
        </thead>

        <tbody>
        
        <?php

            // Boucle de parcours de toutes les lignes du résultat obtenu
            foreach($ani as $animation){
                // Affichage d’une ligne de tableau pour un pseudo non encore traité
                if (!isset($traite[$animation["ani_intitule"]])){

                    $cpt_id=$animation["ani_intitule"];
                    
                // Boucle d’affichage des actualités liées au pseudo
                echo "<tr>";

                    echo "<td>"; 

                    // Gestion de la programmation des animations 
                        if($animation["ani_horairedebut"] > date('Y-m-d H:i:s', time())){ // Animations à venir 
                            echo "<span style = 'background-color:green; color:white; padding:10px;'>A venir</span>";

                        }else if($animation["ani_horairefin"] < date('Y-m-d H:i:s', time())){ // Animations passées
                            echo "<span style = 'background-color:red; color:white; padding:10px;'>Passée</span>";

                        }else{ // Animations en cours 
                            echo "<span style = 'background-color:blue; color:white; padding:10px;'>En cours</span>";

                        }

                    echo "</td>";

                    echo "<td>"; 

                        // Les animation qui sont passées sont mises en rouges et une ligne passe à travers le texte
                        if($animation["ani_horairefin"] < date('Y-m-d H:i:s', time())){
                            echo "<span style = 'text-decoration:line-through;'>"; echo $animation["ani_intitule"]; echo "</span>";

                        }else {
                            echo "<span>"; echo $animation["ani_intitule"]; echo "</span>";

                        }

                    echo "</td>";

                    echo "<td>"; echo $animation["ani_horairedebut"]; echo "</td>";
                    echo "<td>"; echo $animation["ani_horairefin"]; echo "</td>";

                    echo "<td>"; 

                    // Vérification du lieu pour une animation
                    if($animation['lie_nom'] == NULL){
                         echo "Aucun lieu pour l'instant !"; 
                         break;
                    }
                        echo $animation["lie_nom"]; 
                    
                
                    echo "</td>";

                    echo "<td>";
                            echo "<table class='table table-dark table-bordered'>";

                            echo "<thead>";
                                echo "<tr>";
                                    echo "<td> Nom </td>";
                                    
                                echo "</tr";
                            echo "</thead>";

                            echo "<tr>";

                                echo "<td>";

                                if($animation['inv_nom'] == NULL){
                                    echo "Aucun invité !";
                                    
                                    
                                }else{

                                    // Boucle de parcours de tous les invités qui participent à une animation
                                    foreach($ani as $ani1){
    
                                            if(strcmp($cpt_id, $ani1['ani_intitule']) == 0){
    
                                                echo $ani1['inv_nom']; echo "<br>";
                                                
                                            }
                                        }
                                        
                                }
                                
                                
                                echo "</td>";


                            echo "</tr>";


                        echo "</table>";      
                    echo "</td>";
                    
                    echo "<td>";
                    ?>

                        <a href = "<?php echo base_url();?>index.php/programmation/detail_anim/<?php echo $animation["ani_id"]; ?>"><button class='btn btn-lg btn-green subscribe-submit' style = 'background-color:white; color:black;' type='submit'>détails de l'animation!</button></a><br><br>
                        <a href = "<?php echo base_url();?>index.php/programmation/detail_invite/<?php echo $animation["ani_id"]; ?>"><button class='btn btn-lg btn-green subscribe-submit' style = 'background-color:white; color:black;' type='submit'>détails de l'invité!</button></a><br><br>
                        <a href = "<?php echo base_url();?>index.php/programmation/detail_lieu/<?php echo $animation["ani_id"]; ?>"><button class='btn btn-lg btn-green subscribe-submit' style = 'background-color:white; color:black;' type='submit'>détails du lieu!</button></a><br><br>
                        
                        <?php 
                    echo "</td>";

                
                    // Conservation du traitement de l'animation
                    $traite[$animation["ani_intitule"]]=1;
                    
                    echo "</tr>";
                
            }
        }
        } 
        else {
            echo "<br />";
            echo "<div style = 'border: 1px solid black; padding : 20px; margin : 10px;'>";
                echo "<h2 style = 'font-size:30px; text-align : center; '>Aucune animation programmée pour l'instant !</h2>";
    
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