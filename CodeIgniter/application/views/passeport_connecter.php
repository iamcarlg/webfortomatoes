<!-- Controle de la validation du formulaire -->
<?php echo validation_errors(); ?>

<?php echo form_open('invite/post'); ?>

<center>
<form>
    <h1>Ajouter un post :</h1><br>

    <label for="mdp">Pseudo Passeport</label>
    <input type="input" name="pas_login" /><br>

    <label for="mdp">Mot de passe Passeport</label>
    <input type="password" name="pas_mdp" /><br>

    <label for="pos_text">Texte du Post</label>

    <textarea id = "message_area" rows="6" onkeyup = "alert(hello);"cols="70" name="pos_texte" maxlength="140" placeholder="Veuillez entrer votre post"></textarea><br>
    <span class="hint" id="textarea_message">

    <input type="submit" value="Valider"/>

</form>
</center>



