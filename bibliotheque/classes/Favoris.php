<?php

class Favoris {
    public int $id;
    public int $utilisateur_id;
    public int $livre_id;

    public function __construct(int $id, int $utilisateur_id, int $livre_id) {
        $this->id = $id;
        $this->utilisateur_id = $utilisateur_id;
        $this->livre_id = $livre_id;
    }

}
?>