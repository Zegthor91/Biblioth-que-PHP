<?php

class Livre {
    public int $id;
    public int $utilisateur_id;
    public string $titre;
    public string $auteur;

    public function __construct(int $id, int $utilisateur_id, string $titre, string $auteur) {
        $this->id = $id;
        $this->titre = $titre;
        $this->auteur = $auteur;
        $this->utilisateur_id = $utilisateur_id;
    }

}
?>