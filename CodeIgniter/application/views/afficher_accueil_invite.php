<main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Bienvenue <?php echo $this->session->userdata('username');?></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Tableau de bord</li>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Voici toutes vos Informations personnelles
                            </div>
                            <div class="card-body">

                                
                                
                            <?php if(isset($inv)){ ?>

                                    <img src="<?php echo base_url(); echo "style/img/"; echo $inv->inv_photo; ?>" alt="" width = 300 height = 300 style = "border:2px solid black; border-radius : 5px;">
                                    <br>
                                    
                                <ul>

                                    <li>Pseudo : <?php echo $this->session->userdata('username');?> </li>
                                    <li>Nom : <?php echo $inv->inv_nom;?></li>
                                    <li>Discipline : <?php echo $inv->inv_discipline;?></li>
                                    <li>URL des réseaux sociaux : <?php 
                                    
                                    if(isset($url)){

                                        

                                            foreach($url as $lien){

                                                if($lien['url_hyperlien']== NULL){
                                                     echo "Aucun lien disponible pour cet invité !";
                                                    
                                                }else{

                                                    echo "<ul>";
    
                                                        echo "<li>";
    
                                                        echo '<a href="'; echo $lien["url_hyperlien"]; echo'" target="_blank"> Lien réseau social </a>';
                                                            echo "<br>";
    
                                                        echo "</li>";
                                                    echo "</ul>";
                                                }

                                            }


                                    }
                                
                                    ?>
                                </li>

                                </ul>

                                <?php 
                            }
                                    else{
                                        echo "Aucune information disponible pour l'instant !";

                                    }
                                ?>
                                            
<!-- 
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>

                                        </tr>
                                       
                                    </tbody>
                                </table> -->
                            </div>
                        </div>
                    </div>
                </main>
