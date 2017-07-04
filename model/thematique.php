<?php
include_once 'connect.php';
/**
 * Description of thematique
 *
 * @author TheBoss
 */
class thematique
{
    private $id_thematique;
    private $nom;

    /**
     * @return mixed
     */
    public function getIdThematique()
    {
        return $this->id_thematique;
    }

    /**
     * @param mixed $id_thematique
     */
    public function setIdThematique($id_thematique)
    {
        $this->id_thematique = $id_thematique;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    function createThematique ($nom){
        global $pdo;
        $nom = filter_var($nom, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $req = $pdo->prepare("INSERT INTO thematique (nom) VALUES (:nom)");
        $req->execute(array(
            "nom" => $nom
        ));

    }
    function updateThematique ($id,$nom){
        global $pdo;

        $req = $pdo->prepare("UPDATE thematique SET nom = :nom WHERE id_thematique = :id_thematique ");

        $isThematiqueChanged = !empty($nom) && $nom !== $this->getNom() && $nom === NULL  &&  $nom !== '';
        $name = $isThematiqueChanged && filter_var($nom, FILTER_SANITIZE_FULL_SPECIAL_CHARS) ? $nom : $this->getNom();

        $req->execute(array(
            "nom" => $name,
            "id_thematique" => $id
        ));
    }
    function deleteThematique ($id){
        global $pdo;

        $req = $pdo->prepare("DELETE FROM thematique WHERE id_thematique = :id_thematique ");
        $req->execute(array(
            "id_thematique" => $id
        ));
    }
}