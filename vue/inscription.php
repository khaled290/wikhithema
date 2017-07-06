<?php 
    //Si on accède à la page sans passer par le controleur on redirige
    session_destroy();
    if (!isset($page)){
        header('Location: http://localhost/wikhitema/index.php?page=connect');
    }
    else{

?>
<!DOCTYPE html>
<html>
<head>
	<title>WikHiTema - créer un compte</title>
	<link rel="stylesheet" type="text/css" href="vue/css/demo.css" />
    <link rel="stylesheet" type="text/css" href="vue/css/slideshow.css" />
	<link rel="stylesheet" href="vue/css/bootstrap.css">
	<link href="vue/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="vue/css/wiki-style.css">

</head>

<body id="page">
	<h1 class="text-center logo">WikHiTema</h1>

    <ul class="slideshow">
        <li><span>Image 01</span></li>
        <li><span>Image 02</span></li>
        <li><span>Image 03</span></li>
        <li><span>Image 04</span></li>
        <li><span>Image 05</span></li>
        <li><span>Image 06</span></li>
    </ul>

    <div class="col-xs-12 back-black"></div>

	<div class="container container-connexion-inscription">
	    <div class="login">

	    	<div class="container-social">			
                    <div class="row row-sm-offset-3 socialButtons">
                    <div class="col-xs-4 col-sm-2">
                                <a href="#" class="btn btn-lg btn-block btn-facebook">
                                        <i class="fa fa-facebook visible-xs"></i>
                                        <span>Facebook</span>
                                </a>
                        </div>
                        <div class="col-xs-4 col-sm-2">
                                <a href="#" class="btn btn-lg btn-block btn-twitter">
                                        <i class="fa fa-twitter visible-xs"></i>
                                        <span>Twitter</span>
                                </a>
                        </div>	
                        <div class="col-xs-4 col-sm-2">
                                <a href="#" class="btn btn-lg btn-block btn-google">
                                        <i class="fa fa-google-plus visible-xs"></i>
                                        <span>Google+</span>
                                </a>
                        </div>	
                        </div>

                        <div></div>
                </div>

			<div class="row row-sm-offset-3">
				<div class="col-xs-12 col-sm-6">	
				    <form class="loginForm" action="index.php?page=inscription" autocomplete="off" method="POST">

				    	<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-user"></i></span>
							<input type="text" class="form-control pseudo-zone" name="pseudo" placeholder="Votre pseudo" autofocus autocomplete="on" required>
                                                        <?php echo isset($pseudo) && $pseudo ? '<div class="warning">Ce Pseudo à déjà été utilisé</div>' : ''; ?>
						</div>
						<span class="help-block"></span>

						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-user"></i></span>
							<input type="email" class="form-control email-zone" name="email" placeholder="Votre e-mail" required>
                                                        <?php echo isset($email) && $email ? '<div class="warning">Cet email à déjà été utilisé</div>' : ''; ?>
						</div>
						<span class="help-block"></span>
											
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-lock"></i></span>
							<input  type="password" class="form-control mdp-zone" name="password" placeholder="Votre mot de passe" required>
						</div>
						<span class="help-block"></span>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-lock"></i></span>
							<input  type="password" class="form-control mdp-zone" name="passwordConfirm" placeholder="Confirmez le mot de passe" required>
						</div>
                                                <span class="help-block"> </span>

						<button class="btn btn-lg btn-success btn-block" type="submit">Créer un compte</button>
					</form>
				</div>
				</div>
	    	</div>	    	


	    	
			
		</div>
	</div>
</body>
</html>
    <?php }