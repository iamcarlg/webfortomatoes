
<?php

if($ani!= NULL){

?>

<br><br><br>
    <h1>Confirmation de la suppresion de l'animation </h1>
    <!-- <button name="submit" class="btn btn-primary" type="submit"><a href = "index.php/programmation/confirm_deletion/">Valider</a></button>
    <a href="index.php/compte/accueil_admin" name="submit" role="button" class="btn btn-primary" type="submit">Annuler</a> -->


        <button name="submit" class="btn btn-primary" type="submit"><a style = "text-decoration:none; color:white;"href="<?php echo base_url().'index.php/programmation/confirm_deletion/'.$ani;?>">Valider</a></button><br>
        <a href="<?php echo base_url();?>index.php/compte/accueil_admin" name="submit" role="button" class="btn btn-primary" type="submit">Annuler</a>
    <?php

    }
    else{
        echo "Aucune animation à supprimer !";

    }


?>

</center>
