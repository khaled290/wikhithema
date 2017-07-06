<?php
if (isset($_SESSION['user']['pseudo'])){ 
    $token = generer_token();
?>
<?php include('header.inc.php'); ?>

   
    <section class="container-infos-user">
    	<h2 class="text-center"><i class="fa fa-exclamation-triangle" aria-hidden="true"> </i> Modifiez les champs que vous voulez mettre à jour <br><small>aucun champ n'est obligatoire</small></h2>
        <?php if (isset($_SESSION['user']['error'])){
            echo '<div class="danger">'.$_SESSION['user']['error'].'</div>';
            unset($_SESSION['user']['error']);
        } ?> 	
        <div class="row row-sm-offset-3">
			<div class="col-xs-12 col-sm-6">	
				<form class="loginForm" action="index.php?page=modifierCompte" autocomplete="off" method="POST">
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                <input type="text" class="form-control pseudo-zone" name="pseudo" placeholder="Votre NOUVEAU pseudo" autocomplete="on" value="<?php echo $_SESSION['user']['pseudo'] ?>">
                                                <?php echo isset($pseudo) && $pseudo ? '<div class="warning">Ce Pseudo à déjà été utilisé</div>' : ''; unset($pseudo);?>
					</div>
					<span class="help-block"></span>

					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-user"></i></span>
						<input type="email" class="form-control email-zone" name="email" placeholder="Votre NOUVELLE adresse e-mail" autocomplete="on" value="<?php echo $_SESSION['user']['email'] ?>">
                                                 <?php echo isset($email) && $email ? '<div class="warning">Cet email à déjà été utilisé</div>' : ''; unset($email);?>
                                        </div>
					<span class="help-block"></span>
									
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-lock"></i></span>
						<input  type="password" class="form-control mdp-zone" name="password" placeholder="Votre NOUVEAU mot de passe">
					</div>
                                        <span class="help-block"></span>
                                        <div class="input-group">
						<span class="input-group-addon"><i class="fa fa-lock"></i></span>
						<input  type="password" class="form-control mdp-zone" name="passwordConfirme" placeholder="Confirmez votre nouveau mot de passe">
					</div>
                                        <input type="hidden" name="token" id="token" value="<?php
                                        //Le champ caché a pour valeur le jeton
                                        echo $token;
                                        ?>"/>
					<span class="help-block"></span>

					<button class="btn btn-lg btn-primary btn-block" type="submit" style="display:inline;">Valider les modifications</button>
					<button class="btn btn-lg btn-danger btn-block btn-return" type="submit"><a href="index.php">Ne rien modifier (retour à l'accueil)</a></button>
				</form>
                <hr><hr><br><br>
                <form class="supprAccount" action="index.php?page=supprimerMonCompte" method="POST">
                    <button class="btn btn-lg btn-danger btn-block" type="submit">Supprimer le compte</button>
                </form>
			</div>
		</div>

    </section>

        <!-- jQuery -->
    <script src="vue/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vue/js/bootstrap.min.js"></script>

    <script src="vue/js/text-editor.js"></script>

    </style>
<!--<script type="text/javascript">

$("input").focus((function() {
    if(($(".pseudo-zone").val().length >= 1) || ($(".email-zone").val().length >= 1) || ($(".mdp-zone").val().length >= 1)) {
         $(".btn-primary").css({"display":"inline"});
    } else {
         $(".btn-primary").css({"display":"none"});
         // Disable submit button
	}
});
</script>-->
    </body>
</html>
<?php }
else{
    header('Location: http://localhost/wikhitema/index.php?page=connect');
}