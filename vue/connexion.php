<?php 
    //Si on accède à la page sans passer par le controleur on redirige
    if (!isset($page)){
        header('Location: http://localhost/wikhitema/index.php?page=connect');
    }
    else{

?>
<!DOCTYPE html>
<html>
<head>
	<title>WikHiTema - Connexion</title>
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
                
                       <?php if (isset($_SESSION["user"]["error"])){ ?>
                            <div class ="warning"> <?php 
                            echo $_SESSION["user"]["error"]; 
                            unset($_SESSION['user']['error']);
                            ?> </div>
                       <?php } ?>     
			<div class="row row-sm-offset-3">
				<div class="col-xs-12 col-sm-6">	
                                    <form class="loginForm" action="index.php?page=connexion" autocomplete="off" method="POST">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-user"></i></span>
							<input type="text" class="form-control email-zone" name="login" placeholder="Votre login" autofocus autocomplete="on" required>
						</div>
						<span class="help-block"></span>
											
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-lock"></i></span>
							<input  type="password" class="form-control mdp-zone" name="password" placeholder="Password" required>
						</div>
	                    <span class="help-block"></span>

						<button class="btn btn-lg btn-primary btn-block" type="submit">Connexion</button>
					</form>
				</div>
	    	</div>

	    	<div class="row row-sm-offset-3">
				<div class="col-xs-12 col-sm-3 garder-session">
					<label class="checkbox">
						<input type="checkbox" value="remember-me">Garder ma session
					</label>
				</div>
				<div class="col-xs-12 col-sm-3">
					<p class="forgotPwd">
						<a href="oublie-mdp.php">Mot de passe oublié</a>
					</p>
				</div>
				<br><br><br><br>

				<div class="col-xs-12 col-sm-6">	
				    <button class="btn btn-lg btn-success btn-block"><a href="index.php?page=inscription">Créer un compte</a></button>
				</div>

			</div>	    	


	    	
			
		</div>
	</div>
</body>
</html>
    <?php }