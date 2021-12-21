
<?php
    echo "<h1><strong><center>"; echo "Liste des services"; echo "</center></strong></h1>";

    // S'il y a une actualité dans la table et que cette dernière n'est pas nulle
    if($ser != NULL) {

        // Boucle de parcours de toutes les actualités qui sont activées dans la table

        echo "<div class = 'container'>";

        echo "<table class ='table-dark table-hover'>";

        echo "<thead>";

            echo "<tr scope = 'col'>"; 
                echo "<th><strong>"; echo "ID"; echo "</strong></th>";
                echo "<th><strong>"; echo "Type de service"; echo "</strong></th>";  

            echo "</tr>";

        echo "</thead>";

        foreach($ser as $service){


    
                echo "<tr scope = 'col'>";
                    echo "<td>"; echo $service['ser_id']; echo "</td>";
                    
                    echo "<td>"; 
                        if($service['ser_type'] == NULL){
                            echo "Aucun service disponible";
                            
                        }else{

                            foreach($service as $ser){
                                echo $ser['ser_type']; 
                            }
                        }
                    
                    echo "</td>";


                echo "</tr>";
            


            }
            echo "</table>";
    
                echo "<br>";
                echo "<br>";
            
            echo "</div>";

        

        }

    else {
        echo "<br />";
        echo "<div style = 'border: 1px solid black; padding : 20px; margin : 10px;'>";
            echo "<h2 style = 'font-size:30px; text-align : center; '>Aucun lieu disponible pour l'instant !</h2>";

        echo "</div>";

        echo "<br>";
        echo "<br>";

    }
?>
