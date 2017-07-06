<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="meilleur wiki au monde - WikHiTema">
    <meta name="author" content="AMLYS KHALED JASON">
    <title>WikHiTema</title>
    <link href="vue/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="vue/css/wiki-style.css">
    <link href="vue/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="vue/css/wiki-blog-articles.css">
</head>

<body>
    <?php include('header.inc.php'); ?>
<section class="container-infos-user">
    <h2 class="text-center">Modifiez les champs que vous voulez mettre à jour</h2><br><br>
    <div class="row row-sm-offset-3">
        <div class="col-xs-12 col-sm-6">
            <form action="index.php?page=ajoutThematique" method="POST">
                <div class="input-group input-group-lg">
                    <input type="text" name="titre_thematique" class="form-control" autofocus/>
                    <span class="input-group-btn">
                            <button type="submit" class="btn btn-info add-thematique">Ajouter la thématique</button>
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
                echo "<input type=\"hidden\" name=\"id_thematique\" value=\"" . $thematique['id_thematique'] . "\"/>";
                echo "<input type='text' name='titre_thematique' value=\"" . $thematique['nom'] . "\" />";
                echo "</div>
                    <hr>
                    <button class='btn btn-info'>Envoyer les modifications</button>
                    <span class='help-block'></span>
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