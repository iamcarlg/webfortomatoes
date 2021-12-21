<?php echo validation_errors(); ?>
<?php echo form_open('compte/update_password');?>
<?php
    if($_SESSION['statut'] != 'Organisateur'){
        redirect(base_url()."index.php/compte/connecter");
    }
    else{
    
        // $nom = $org["org_nom"];
        // $prenom = $org["org_prenom"];
        // $pseudo = $org["cpt_login"];
    
    ?>
<br><br>
            <center>
            <h1>Modifiez vos données ici :</h1><br>
                <p>Pseudo : <input type="text" name="id" value="<?php echo $org->cpt_login;?>" disabled></p>
                <p>Nom : <input type="text" name="nom" value="<?php echo $org->org_nom;?>" disabled></p>
                <p>Prénom : <input type="text" name="prenom" value="<?php echo $org->org_prenom;?>" disabled></p>
                <p>Nouveau mot de passe : <input type="password" name="mdp" /></p>
                <p>Confirmez votre nouveau mot de passe : <input type="password" name="mdp_new" /></p>
                <button name="submit" class="btn btn-primary" type="submit">Valider</button>
                <a href="<?php echo base_url();?>index.php/compte/accueil_admin" name="submit" role="button" class="btn btn-primary" type="submit">Annuler</a>

            </center>
<?php
}
?>
</form>
