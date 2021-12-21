
<?php
    if ($pas != NULL){
        
    ?>
        <div class="container" style = "width:100%;">

            <h1><center>Liste des passeports et posts associés : </center></h1>
        <table class="table table-dark table-hover">

        <thead>
            <tr>
                <th>Pseudo des passeports</th>
                <th>Description des posts</th>

            </tr>
        </thead>

        <tbody>
        
        <?php

            foreach($pas as $passeport){
                // Affichage d’une ligne de tableau pour un pseudo non encore traité
                if (!isset($traite[$passeport["pas_login"]])){
                    $pas_login=$passeport["pas_login"];

                    echo "<tr>";

                    echo "<td>";

                    if($passeport['pas_login'] == NULL){
                        echo "<span style = 'color:red;'>"; echo "Aucun pseudo de passeport disponible !"; echo "</span>";

                    }
                    echo $passeport['pas_login']; 

                    echo "</td>";

                        echo "<td>"; 
                        
                        if($passeport['pos_libelle'] == NULL){
                            echo "<span style = 'color:red;'>"; echo "Aucun post pour l'instant !"; echo "</span>";

                        }
                        foreach($pas as $pas_post){

                                    if(strcmp($pas_login, $pas_post['pas_login'])== 0){
                                        echo $pas_post['pos_libelle'];  echo "   ---------------------------------------------------------  "; echo $pas_post['pos_datepost']; echo "<br>";echo "<br>";
                                    }

                            }
                            echo "</td>";
            
                            echo "<td>"; 
                            
                            // if($passeport['pos_datepost'] == NULL){
                            //     echo "<span style = 'color:red;'>"; echo "Aucune date de publication mentionnée !"; echo "</span>";

                            // }
                            // foreach($pas as $pas_post){

                            //         if(strcmp($pas_login, $pas_post['pas_login'])== 0){
                            //             echo $pas_post['pos_datepost']; echo "<br>";
                            //         }

                            // }
                            
                            echo "</td>";
                                                    

                        // Conservation du traitement de l'animation
                       $traite[$passeport["pas_login"]]=1;
   
                           
                        echo "</tr>";
                }
            } 
    
    
    
    
    }
        else {
            echo "<br />";
            echo "Aucun passeport disponible pour l'instant !";

        }


        ?>

     </tbody>

    </table>

    </div>