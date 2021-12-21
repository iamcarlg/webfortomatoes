<?php

if($inv != NULL){

    echo "<h1 class = 'card-title'><center> NOS INVITES </h1></h1>";

    echo "<div class='card-body'>";
    
    // Boucle de parcours de toutes les lignes du résultat obtenu
    foreach($inv as $invite){

        if(!isset($traite[$invite['inv_nom']])){

            $inv_id = $invite['inv_nom'];

            echo "<div class = 'contain'>";
    
            echo "<h3 class='card-title'>"; 
                echo $invite['inv_nom'];
            echo "</h3>";

            echo "<img src='"; echo base_url(); echo "style/img/"; echo $invite['inv_photo']; echo "'"; echo "class='card-img-top' width = '350' height = '350' />";
            echo "<p class='card-text'>"; echo $invite['inv_discipline']; echo "</p>";
            
            if($invite['url_hyperlien'] == NULL){
                echo "Pas de réseau social pour cet invité ! <br>";

            }else{

                foreach($url as $url_lien){
                    if(strcmp($inv_id, $url_lien['inv_nom']) == 0){
                        
                        echo "<a href = '"; echo $url_lien['url_hyperlien']; echo "' target = '_blank'>"; echo "Lien vers le réseau social"; echo "</a><br>";

                        // Conservation du traitement du nom de l'invité
                        $traite[$invite["inv_nom"]]=1;

                    }
                }

            }

            echo "<br>";

    
                echo "<h3> LES POSTS : </h3>";
    
                
                if($invite['pos_libelle'] == NULL && $invite['pos_datepost'] == NULL){
                    echo "Pas de post pour cet invité ! <br>";
                    
                }else{
                    echo "<table class='table table-dark table-borderless'>";
                            echo "<thead>";
                                echo "<tr>";
    
                                    echo "<td> Libellé du post </td>";
                                    echo "<td> Date de publication </td>";
    
                                echo "</tr>";
                            echo "</thead>";
    
                            echo "<tbody>";


                                foreach($inv as $invite){

                                    if(strcmp($inv_id, $invite["inv_nom"]) == 0 && $invite["pos_etat"] == 1){

                                        echo "<tr>";
                                            echo "<td>"; echo $invite['pos_libelle']; echo "</td>";
                                            echo "<td>"; echo $invite['pos_datepost']; echo "</td>";
                                            
                                            $traite[$invite["inv_nom"]]=1;  
                                            echo "</tr>";
                                    }

                                }

                            echo "</tbody>";

                    echo "</table>";
                }
    
                echo "<br><br>";

    
            echo "</div>";
        }

    }


    echo "</div>";
}else{

    echo "<br />";
    echo "<div style = 'border: 1px solid black; padding : 20px; margin : 10px;'>";
        echo "<h2 style = 'font-size:30px; text-align : center; '>Aucun invité disponible pour cette animation !</h2>";

    echo "</div>";

    echo "<br>";
    echo "<br>";
}

?>

<style>

    .contain{
        border-radius : 20%;

    }
    .card-body{
        
        display : grid;
        grid-template-columns : 1fr 1fr 1fr;
        margin-left : 150px;
    }

    h1, h3{
        font-weight : bolder;
        color : #f3456e;
        text-transform : capitalize;

    }

    a{
        font-size:15px;

    }

    @media (max-width : 450px){
        .card-body{
            display: flex;
            
        }
    }
</style>