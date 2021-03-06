<?php 
    //Si on accède à la page sans passer par le controleur on redirige
    if (!isset($page)){
        session_destroy();
        header('Location: http://localhost/wikhitema/index.php?page=connect');
    }
    else if(isset ($_SESSION['user']['pseudo'])){
        header('Location: http://localhost/wikhitema/index.php?page=index');
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
	<h1 class="text-center logo"><i class="fa fa-graduation-cap" aria-hidden="true"></i> WikHiTema</h1>

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

				<br><br><br><br>

				<div class="col-xs-12 col-sm-6">	
				    <a href="index.php?page=formInscription"><button class="btn btn-lg btn-success btn-block">Créer un compte</button></a>
				</div>

			</div>	    	


	    	
			
		</div>
	</div>
</body>
</html>
    <?php } 