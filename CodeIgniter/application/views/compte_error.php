<!-- Controle de la validation du formulaire -->
<?php echo validation_errors(); ?>

<?php echo form_open('compte/connecter'); ?>

<center>
<form>
    <label>Saisissez vos identifiants ici :</label><br>

    <h3 style="color:red; font-weight : bold;">Identifiants erronés ou inexistants !</h3>

    <label for="mdp">Pseudo</label>
    <input type="input" name="pseudo" /><br>

    <label for="mdp">Mot de passe</label>
    <input type="password" name="mdp" /><br>
    
    <input type="submit" value="Connexion"/>

</form>
</center>