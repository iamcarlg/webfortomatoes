<main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Bienvenue Mr l'administrateur</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Tableau de bord</li>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Voici toutes vos Informations personnelles de l'administrateur
                            </div>
                            <div class="card-body">

                            <ul>
                                <?php 
                                    if(isset($admin)){

                                    ?>
                                        <li>Pseudo : <?php echo $this->session->userdata('username');?> </li>
                                        <li>Nom : <?php echo $admin->org_nom;?></li>
                                        <li>Prénom : <?php echo $admin->org_prenom;?></li>
                                        <li>Mail : <?php echo $admin->org_mail;?></li>
                                        <li>Adresse : <?php echo $admin->org_adresse;?></li>
                                  
                                <?php 
                                    }
                                    else{
                                        echo "Aucune information disponible pour l'instant !";
                                    }
                                ?>
                            </ul>

                                            
                            </div>
                        </div>
                    </div>
                </main>