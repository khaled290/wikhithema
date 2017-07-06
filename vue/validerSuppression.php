<?php
if (isset($_SESSION['user']['pseudo'])){ 
    $token = generer_token();
?>
<?php include('header.inc.php'); ?>

   
    <section class="container-infos-user">
    	<h1 class="text-center"><i class="fa fa-exclamation-triangle" aria-hidden="true"> </i>  VOulez vous vraiment supprimer votre compte<br><small>Cette action est définitive</small></h1>
        <?php if (isset($_SESSION['user']['error'])){
            echo '<div class="danger">'.$_SESSION['user']['error'].'</div>';
            unset($_SESSION['user']['error']);
        } ?> 	
        <div class="row row-sm-offset-3">
			<div class="col-xs-12 col-sm-6">	
				<form class="loginForm" action="index.php?page=suppressionMonCompte" autocomplete="off" method="POST">
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                <h2> <?php echo $_SESSION['user']['pseudo']; ?></h2>
					</div>
					<span class="help-block"></span>

					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-user"></i></span>
						<h2> <?php echo $_SESSION['user']['email']; ?></h2>
                                        </div>
					<span class="help-block"></span>
                                        <input type="hidden" name="token" id="token" value="<?php
                                        //Le champ caché a pour valeur le jeton
                                        echo $token;
                                        ?>"/>
					<span class="help-block"></span>

					<button class="btn btn-lg btn-primary btn-block" type="submit" style="display:inline;">Supprimer le compte</button>
				</form>
                <hr><hr><br><br>
                <form class="supprAccount" action="index.php?page=supprimerMonCompte" method="POST">
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

		/*$("input").focus((function() {
		    if(($(".pseudo-zone").val().length >= 1) || ($(".email-zone").val().length >= 1) || ($(".mdp-zone").val().length >= 1)) {
		         $(".btn-primary").css({"display":"inline"});
		    } else {
		         $(".btn-primary").css({"display":"none"});
		         // Disable submit button
			}
		});*/
        </script>
    </body>
</html>
<?php }
else{
    header('Location: http://localhost/wikhitema/index.php?page=connect');
}