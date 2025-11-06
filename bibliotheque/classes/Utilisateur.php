<?php

class Utilisateur {
    public int $id;
    public string $nom;
    public string $email;
    public string $password;

    public function  __construct(int $id, string $nom, string $email, string $password) {
        $this->id=$id;
        $this->nom=$nom;
        $this->email=$email;
        $this->password=$password;
    }
  
}
?>