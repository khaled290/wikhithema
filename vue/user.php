<?php include('header.inc.php'); ?>

    <section class="container-infos-user">
    	<h1 class="text-center"><i class="fa fa-exclamation-triangle" aria-hidden="true"> </i>  Modifiez les champs que vous voulez mettre à jour <br><small>aucun champ n'est obligatoire<small></h1>
		<div class="row row-sm-offset-3">
			<div class="col-xs-12 col-sm-6">	
				<form class="loginForm" action="" autocomplete="off" method="POST">
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-user"></i></span>
						<input type="text" class="form-control pseudo-zone" name="pseudo" placeholder="Votre NOUVEAU pseudo" autocomplete="on">
					</div>
					<span class="help-block"></span>

					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-user"></i></span>
						<input type="email" class="form-control email-zone" name="email" placeholder="Votre NOUVELLE adresse e-mail" autocomplete="on">
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
					<span class="help-block"></span>

					<button class="btn btn-lg btn-primary btn-block" type="submit">Valider les modifications</button>
					<button class="btn btn-lg btn-danger btn-block" type="submit"><a href="index.php">Ne rien modifier (retour à l'accueil)</a></button>
				</form>
                <hr><hr><br><br>
                <form class="supprAccount" action="" method="POST">
                    <button class="btn btn-lg btn-danger btn-block" type="submit">Supprimer le compte</button>
                </form>
			</div>
		</div>

    </section>

    <style type="text/css">
    	h1 {
    		color: #993333;
    	}
    	.btn-primary {
    		display: none;
    	}
    </style>
    <script type="text/javascript">

		$("input").mouseleave(function() {
		    if(($(".pseudo-zone").val().length >= 1) || ($(".email-zone").val().length >= 1) || ($(".mdp-zone").val().length >= 1)) {
		         $(".btn-primary").css({"display":"inline"});
		    } else {
		         $(".btn-primary").css({"display":"none"});
		         // Disable submit button
			}
		});
    </script>
</body>
</html>