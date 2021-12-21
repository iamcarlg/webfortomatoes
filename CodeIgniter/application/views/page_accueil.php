
<?php
    echo "<h1><strong><center>"; echo "Liste des actualités"; echo "</center></strong></h1>";

    // S'il y a une actualité dans la table et que cette dernière n'est pas nulle
    if($actu != NULL) {

        ?>
    
        <div class = 'container'>

        <table class ='table-dark table-hover' style = 'border-collapse: separate;'>

        <thead>

                <tr>
                    <th><strong>Titre</strong></th>
                    <th><strong>Description</strong></th>
                    <th><strong>Date de publication</strong></th>
                    <th><strong>Auteurs</strong></th>
                    
                </tr>
                    
        </thead>

        <tbody>
            
        <?php 
        foreach($actu as $actualite){

    
                echo "<tr>";
                    echo "<td>"; echo $actualite['act_titre']; echo "</td>";
                    echo "<td>"; echo $actualite['act_descriptif']; echo "</td>";
                    echo "<td>"; echo $actualite['act_date']; echo "</td>";
                    echo "<td>"; echo $actualite['cpt_login']; echo "</td>";
                echo "</tr>";
            


            }

        ?>
            <tbody>
            </table>
    
            <br>
            <br>
            
        </div>

        
<?php 
        }

    else {
        echo "<br />";
        echo "<div style = 'border: 1px solid black; padding : 20px; margin : 10px;'>";
            echo "<h2 style = 'font-size:30px; text-align : center; '>Aucune actualité disponible pour l'instant !</h2>";

        echo "</div>";

        echo "<br>";
        echo "<br>";

    }
?>
