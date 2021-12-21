
<!-- PAGE DE CONNEXION A LA PARTIE PRIVEE -->

<div id="contact">
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <h2 class="centered">Page d'inscription au showroom</h2>
          <form class="contact-form php-mail-form" role="form" action="contactform/contactform.php" method="POST">

            <div class="form-group">
              <input type="name" name="name" class="form-control" id="contact-name" placeholder="Prénom" data-rule="minlen:4" data-msg="Please enter at least 4 chars" >
              <div class="validate"></div>
            </div>
            <div class="form-group">
              <input type="name" name="name" class="form-control" id="contact-name" placeholder="Nom" data-rule="minlen:4" data-msg="Please enter at least 4 chars" >
              <div class="validate"></div>
            </div>
            <div class="form-group">
              <input type="email" name="email" class="form-control" id="contact-email" placeholder="Email" data-rule="email" data-msg="Please enter a valid email">
              <div class="validate"></div>
            </div>

            <div class="form-group">
              <input type="password" name="password" class="form-control" id="contact-email" placeholder="Entrez le mot de passe" data-rule="password" data-msg="Please enter a valid password">
              <div class="validate"></div>
            </div>

            <div class="form-group">
              <input type="password" name="password" class="form-control" id="contact-email" placeholder="Ré-entrez le mot de passe" data-rule="email" data-msg="Please enter a valid password">
              <div class="validate"></div>
            </div>

            <div class="form-send">
              <button type="submit" class="btn btn-large">Inscription</button>
            </div>

          </form>

        </div>
      </div>
    </div>
  </div>
  <!-- / contact -->