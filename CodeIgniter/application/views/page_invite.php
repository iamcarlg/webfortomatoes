
<br><br><br><br>



<h1><?php echo "<h1 class = 'card-title'><center>"; echo $titre; echo "</center></h1>";?></h1>
<br />
<br />


<center><h2>Il y a au total <span style = 'color:red;'><?php echo $n_inv->nombre_invite; ?></span> invités</h2></center>
<?php

        if ($inv != NULL){



echo'<div class="card-body">';                 
     foreach($inv as $invite){
        if (!isset($traite[$invite["inv_nom"]])){
        $a=$invite["inv_nom"]; 
     echo"<div >";

        echo'<div class="contain">';
            echo'<h4 class="card-title">';  echo"<br>"; echo"-       -"; echo $invite["inv_nom"]; echo"</h4>";
            echo'<br>';
                
                echo"<figure>";                
                    echo "<img src='"; echo base_url(); echo "style/img/"; echo $invite['inv_photo']; echo "'"; echo "class='card-img-top' width = '350' height = '350' />";
                echo"</figure>";
            

                echo "<br>";
                            if($invite["url_hyperlien"]== NULL) {echo'<br>'; echo" Pas d'URL "; echo'<br>';}
                                else{
                                    foreach($url as $url_lien){
                                        if(strcmp($a,$url_lien["inv_nom"])==0 ){
                            echo'<div class="inv_url">';
                                echo'<div style="display: inline-block;"><a href="'; echo $url_lien["url_hyperlien"]; echo' " target="_blank"> lien réseau social </a>
                                </div>';
                            echo'</div>';
                               $traite[$invite["inv_nom"]]=1;
                         }
                    }
            }

                            echo'<br>';
                                       echo' <div class="inv_post">';
                                            echo'<h4>LES POSTS: </h4>';
                                            echo'<div>';
                                                echo'<table class="table table-condensed">';
                                                    echo'<tbody style="font-size: 10px;">';

                                                    if($invite["pos_libelle"]== NULL && $invite["pos_datepost"]== NULL) { echo" Pas de posts ";}
                                                       else{
                                                            foreach($inv as $invite){
                                                                if(strcmp($a,$invite["inv_nom"])==0){
                                                                    echo'  <tr><td style="text-align: justify;">'; echo $invite["pos_datepost"]; echo" : ";   echo $invite["pos_libelle"]; echo'</td>';
                                                                     $traite[$invite["inv_nom"]]=1;  
                                                                    echo'</tr>';
                                                                        
                                                  }
                                                }
                                              }
                                                    echo'</tbody>';
                                                echo' </table>';
                                            echo'</div>';
                                        echo'</div>';

        echo" </div>";  
    echo" </div>";  
                     
      }
  }
echo" </div>";  

}

        else{
            echo "Aucun résultat !";
        }

?>


<style>
        .contain{
        border-radius : 20%;

    }
    .card-body{
        
        display : grid;
        grid-template-columns : 1fr 1fr 1fr;
        grid-gap : 20px;
        margin-left : 100px;
    }

    h1, h3, h4{
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