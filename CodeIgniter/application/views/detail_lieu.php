
<center>
<h1><?php echo $titre;?></h1>
<br><br>
 
    
</center>




    <?php


 

    echo "<br>";

   

    // S'il y a une actualité dans la table et que cette dernière n'est pas nulle

    if($ser != NULL) {

        // Boucle de parcours de toutes les actualités qui sont activées dans la table

 

        ?>


       <table class="table table-dark table-hover">
     <thead>
         <tr>
                <th><strong>Nom du lieu</strong></th>
                <th><strong>Adresse du lieu</strong></th>
                <th><strong>Services proposés</strong></th>
            </tr>
        </thead>
        <tbody>

        <?php
        foreach($ser as $lieu){
            if(!isset($traite[$lieu['lie_nom']])){
                $lie_id=$lieu["lie_nom"];
                echo "<tr scope = 'col'>";
                    echo "<td>"; echo $lieu['lie_nom']; echo "</td>";
                    echo "<td>";
                        if($lieu['lie_adresse'] == NULL){
                            echo "Aucune adresse disponible";
                        }
                        echo $lieu['lie_adresse'];
                    echo "</td>";
                    echo "<td>";
                    foreach($ser as $service){
                        if($lieu['ser_type'] == NULL){
                            echo "Aucun service proposé disponible";
                            break;

                        }else{

                            if(strcmp($lie_id, $service['lie_nom']) == 0){
                                echo "⚪ ";
                                echo $service['ser_type'];  echo "<br>";

 

                            }

                        }

                    }

 

                    echo '</td>';

                    // Conservation du traitement de lanimation

                    $traite[$lieu["lie_nom"]]=1;

                   

 

                echo "</tr>";

            }

 

        }

 

        echo "<tbody>";

        echo "</table>";

   

        echo "<br>";

        echo "<br>";

         

 

       

 

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
