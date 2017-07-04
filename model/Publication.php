<?php

class Publication
{
    private $id_publication;
    private $titre;
    private $contenu;
    private $date;
    private $id_user;
    private $path_media;
    private $id_thematique;

    /**
     * @return mixed
     */
    public function getIdPublication()
    {
        return $this->id_publication;
    }

    /**
     * @param mixed $id_publication
     */
    public function setIdPublication($id_publication)
    {
        $this->id_publication = $id_publication;
    }

    /**
     * @return mixed
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param mixed $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * @return mixed
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * @param mixed $contenu
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->id_user;
    }

    /**
     * @param mixed $id_user
     */
    public function setIdUser($id_user)
    {
        $this->id_user = $id_user;
    }

    /**
     * @return mixed
     */
    public function getPathMedia()
    {
        return $this->path_media;
    }

    /**
     * @param mixed $path_media
     */
    public function setPathMedia($path_media)
    {
        $this->path_media = $path_media;
    }

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

    public static function createPublication ($titre,$contenu,$id_user,$path_media,$id_thematique){
        global $pdo;
        $titre = filter_var($titre, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $contenu = filter_var($contenu, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $date = $date = new DateTime();
        $id_user = filter_var($id_user, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $path_media = filter_var($path_media, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $id_thematique = filter_var($id_thematique, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if ($titre && $contenu && $id_user && $id_thematique){
            $req = $pdo->prepare("INSERT INTO publication (titre,contenu,date,id_user,path_media,id_thematique) VALUES (:titre,:contenu,:date,:id_user,:path_media,:id_thematique)");
            $req->execute(array(
                "titre" => $titre,
                "contenu" => $contenu,
                "id_user" => $id_user,
                "path_media" => $path_media,
                "id_thematique" => $id_thematique,
                "date" =>$date
            ));
        }
    }
    public static function updatePublication ($id_publication, Array $publication){
    
    public  function updatePublication ($id_publication, Array $publication){
        global $pdo;

        $oldPublication = Publication::selectPublication($id_publication);

        $req = $pdo->prepare("UPDATE publication SET titre = :titre, contenu = :contenu, path_media = :path_media, date = :date WHERE id_publication = :id_publication ");

        $isTitreChanged = !empty($publication->titre) && $publication->titre !== $oldPublication["titre"] && $publication->titre === NULL  &&  $publication->titre !== '';
        $titre = $isTitreChanged && filter_var($publication->titre, FILTER_SANITIZE_FULL_SPECIAL_CHARS) ? $publication->titre : $oldPublication["titre"];

        $isContenuChanged = !empty($publication->contenu) && $publication->contenu !== $oldPublication["contenu"] && $publication->contenu === NULL  &&  $publication->contenu !== '';
        $contenu = $isContenuChanged && filter_var($publication->contenu, FILTER_SANITIZE_FULL_SPECIAL_CHARS) ? $publication->contenu : $oldPublication["contenu"];

        $date = $date = new DateTime();

        $isPath_mediaChanged = !empty($publication->path_media) && $publication->path_media !== $oldPublication["path_media"] && $publication->path_media === NULL  &&  $publication->path_media !== '';
        $path_media= $isPath_mediaChanged && filter_var($publication->path_media, FILTER_SANITIZE_FULL_SPECIAL_CHARS) ? $publication->path_media : $oldPublication["path_media"];

        $rowCount = $req->execute(array(
            "id_publication" => $id_publication,
            "titre" => $titre,
            "contenu" => $contenu,
            "path_media" => $path_media,
            "date" =>$date
        ));
        return $rowCount;
    }
    public static function selectAllPublication (){
        global $pdo;

        $req = $pdo->prerare("SELECT * FROM publication");
        $rowCount = $req->execute();
        return $rowCount;
}
    public static function selectPublication ($id_publication){
        global $pdo;

        $req = $pdo->prerare("SELECT * FROM publication WHERE id_publication = :id_publication");
        $rowCount = $req->execute(array(
            "id_thematique" => $id_publication
        ));
        return $rowCount;
    }

    public static function deletePublication ($id_publication){
        global $pdo;

        $req = $pdo->prepare("DELETE FROM publication WHERE id_publication = :id_publication");
        $rowCount = $req->execute(array(
            "id_publication" => $id_publication
        ));
        return $rowCount;
    }
}