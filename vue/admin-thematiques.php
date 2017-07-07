<?php include('header.inc.php'); ?>

<section class="container-infos-user">
    <h2 class="text-center">Gestion des thématiques<br><small>ou <a href="index.php?page=supprimerCompte">gestion des utilisateurs</a></small></h3><br><br><hr>
        <div class="row row-sm-offset-3">
            <div class="col-xs-12 col-sm-6">
                <form action="index.php?page=ajoutThematique" method='POST' id='ajoutThematique'>
                    <div class="input-group input-group-lg">
                        <input type="text" class="form-control" name="titre_thematique" id="titre_thematique" autofocus/>
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-info add-thematique">Ajouter une nouvelle thématique</button>
                        </span>
                    </div>
                </form>
                <br><br>
                <hr>
                <hr>

                <?php
                foreach ($listeThematique as $thematique) {
                    echo "<form class='loginForm' action='index.php?page=modifierThematique' autocomplete='off' method='POST' id='modifThematique'>
                    <div class='input-group'>";
                    echo "<input type='hidden' name='id_thematique' value='" . $thematique['id_thematique'] . "'/>";
                    echo "<input type='text' name='titre_thematique' value='" . $thematique['nom'] . "' />";
                    echo "</div>
                    <button class='btn btn-warning btn-modif-thematiques'>Modifier la thématique</button>
                    <span class='help-block'></span><hr>
                    </form>";
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
<script type="text/javascript">
    $('#modifThematique').on('click', '.btn-modif', function () {
        $(this).siblings().each(
            function () {
                if ($(this).find('input').length) {
                    $(this).text($(this).find('input').val());
                }
                else {
                    var t = $(this).text();
                    $(this).html($('<input />', {'value': t}).val(t));
                }
            });
    });

</script>
</body>
</html>