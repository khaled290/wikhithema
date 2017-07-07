<?php 
if (isset($_SESSION['user']['pseudo'])) {
    if ($_SESSION['user']['role']==1){

include('header.inc.php'); ?>

<section class="container-infos-user">
    <h2 class="text-center">Gestion des utilisateurs<br><small> ou <a class="text-center" href="index.php?page=formThematique">gestion des thématiques</a></small></h2><br><br>
    <div class="row row-sm-offset-3">
        <div class="col-xs-12 col-sm-6">
            <?php

            foreach ($listeUsers as $users) {
                echo "<section><form class='loginForm' action='index.php?page=supprimerCompte' autocomplete='off' method='POST' id='modifThematique'>
                    <div class='input-group'>";
                echo "<input type=\"hidden\" name=\"id_user\" value=\"" . $users['id_user'] . "\"/>";
                echo "<span><strong>" . $users['pseudo'] . "</strong></span> est un ";
                if ($users['role'] == 1) {
                    echo "<span> administrateur</span>";
                } elseif ($users['role'] == 2) {
                    echo "<span> auteur</span>";
                } elseif ($users['role'] == 3) {
                    echo "<span> utilisateur</span>";
                }
                if($users['role']>1){
                    echo "<br>Attribuer un nouveau rôle : 
                        <span><a href='index.php?page=modificationRole&role=3&id=" . $users['id_user'] . "'>Utilisateur</a>  ||  </span>
                        <span><a href='index.php?page=modificationRole&role=2&id=" . $users['id_user'] . "'>Auteur</a>  ||  </span>
                        <span><a href='index.php?page=modificationRole&role=1&id=" . $users['id_user'] . "'>Administrateur</a>  </span>
                            </div>
                    
                    <button class='btn btn-danger btn-supprUser' type=\"submit\">Supprimer l'utilisateur</button>
                    <span class='help-block'></span>
                    </form><hr></section>";
                }   
                else {echo"</div>
                    </form><hr></section></br></br>";
                }
            }
            ?>

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
<!-- jQuery -->
<script src="vue/js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="vue/js/bootstrap.min.js"></script>
<script type="text/javascript"></script>
</body>
</html>
    <?php 
    
    }
    else{
        $_SESSION['user']['error']="Vous n'avez pas les droits d'acces à cette page.";
        header('Location: http://localhost/wikhitema/index.php?page=index');
    }
}else{
    header('Location: http://localhost/wikhitema/index.php?page=connect');
}
    