<br />

<?php
    echo "<h1><strong><center>"; echo $titre; echo "</center></strong></h1>";

    if(isset($actu)) {

        echo "<div class = 'container'>";

        echo "<table class ='table-dark table-hover' style = 'border-collapse: separate;'>";

        echo "<thead>";

            echo "<tr>"; 
                echo "<th><strong>"; echo "Titre"; echo "</strong></th>";
                echo "<th><strong>"; echo "Description"; echo "</strong></th>";  
                echo "<th><strong>"; echo "Date de publication"; echo "</strong></th>";
                echo "<th><strong>"; echo "Auteurs"; echo "</strong></th>";  
                
            echo "</tr>";

        echo "</thead>";

        foreach($actu as $actualite){

            echo "<tr>";
                echo "<td>"; echo $actualite['act_titre']; echo "</td>";
                echo "<td>"; echo $actualite['act_descriptif']; echo "</td>";
                echo "<td>"; echo $actualite['act_date']; echo "</td>";
                echo "<td>"; echo $actualite['cpt_login']; echo "</td>";
            echo "</tr>";

        }

        echo "</table>";

        echo "</div>";

    }

    else {
        echo "<br />";
        echo "Aucune actualité pour l'instant !";

    }
?>

<br>
<br>
