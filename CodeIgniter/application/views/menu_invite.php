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

                            <ul>

                            
                                <?php if(isset($inv)){ ?>

                                    <li>Pseudo : <?php echo $this->session->userdata('username');?> </li>
                                    <li>Nom : <?php echo $inv->inv_nom;?></li>
                                    <li>Adresse Mail : </li>
                                    <li>Discipline : <?php echo $inv->inv_discipline;?></li>
                                    <li>Biographie : </li>
                                    <li>URL des réseaux sociaux : </li>
                                  
                            </ul>

                                <?php }

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