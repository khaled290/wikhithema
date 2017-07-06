<?php
if (isset($_SESSION['user']['pseudo'])){ 
    $token = generer_token();
?>
<?php include('header.inc.php'); ?>

<body>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand logo" href="index.php">WikHiTema</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <button class="btn btn-warning add-publication-btn">
                            <a href="new-publication.php" class="btn-new-post">Ajouter une publication</a>
                        </button>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Catégories <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="publications-cat.php">Informatique</a>
                            </li>
                            <li>
                                <a href="publications-cat.php">High Tech</a>
                            </li>
                            <li>
                                <a href="publications-cat.php">Sport</a>
                            </li>
                            <li>
                                <a href="publications-cat.php">Cuisine</a>
                            </li>
                            <li>
                                <a href="publications-cat.php">Managment</a>
                            </li>
                            
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Compte <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="index.php">Parametres</a>
                            </li>
                            <li>
                                <a href="index.php">Mes publication</a>
                            </li>
                            <li>
                                <a href="index.php">Déconnexion</a>
                            </li>
                            <li>
                                <a href="index.php?page=supprimerCompte">Supprimer votre compte</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
   
    <section class="container-infos-user">
    	<h1 class="text-center"><i class="fa fa-exclamation-triangle" aria-hidden="true"> </i>  Modifiez les champs que vous voulez mettre à jour <br><small>aucun champ n'est obligatoire</small></h1>
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
<?php }
else{
    header('Location: http://localhost/wikhitema/index.php?page=connect');
}