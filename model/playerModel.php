<?php
//MODEL POUR LA CLASS ModelPlayer
class PlayerModel implements InterfaceModel{
    //Attributs
    private ?int $id;
    private ?string $pseudo;
    private ?string $email;
    private ?int $score;
    private ?string $password;
    private ?PDO $bdd;

    //Constructeur
    public function __construct(?PDO $bdd){
        $this->bdd = connect();
    }

    //Getters et setters
    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $id): self {
        $this->id = $id;
        return $this;
    }

    public function getPseudo(): ?string {
        return $this->pseudo;
    }

    public function setPseudo(?string $pseudo): self {
        $this->pseudo = $pseudo;
        return $this;
    }

    public function getEmail(): ?string {
        return $this->email;
    }

    public function setEmail(?string $email): self {
        $this->email = $email;
        return $this;
    }

    public function getScore(): ?int {
        return $this->score;
    }

    public function setScore(?int $score): self {
        $this->score = $score;
        return $this;
    }

    public function getPassword(): ?string {
        return $this->password;
    }

    public function setPassword(?string $password): self {
        $this->password = $password;
        return $this;
    }

    public function getBdd(): ?Object {
        return $this->bdd;
    }

    public function setBdd(?Object $bdd): self {
        $this->bdd = $bdd;
        return $this;
    }

    //Méthodes
    public function add(): ?string {
        try{
            $bdd = $this->getBdd()->connect();
            $pseudo = $this->getPseudo();

            $requete = "INSERT INTO players(pseudo, email, score, psswrd)
            VALUE(?,?,?,?)";
            $req = $bdd->prepare($requete);
            $req->bindParam(1,$pseudo[0], PDO::PARAM_STR);
            $req->bindParam(2,$pseudo[1], PDO::PARAM_STR);
            $req->bindParam(3,$pseudo[2], PDO::PARAM_STR);
            $req->bindParam(4,$pseudo[3], PDO::PARAM_STR);
            $req->execute();
        }
        catch(Exception $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }

    public function getAll(): array | null {
        try {
            $bdd = $this->getBdd()->connect();

            $requete = "SELECT id, pseudo, email, score FROM players";
            $req = $bdd->prepare($requete);
            $req->execute();
            $data = $req->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }

    public function getByEmail(): array | null | bool {
        try {
            $bdd = $this->getBdd()->connect();
            $email = $this->getEmail();

            $requete = "SELECT id, pseudo, email, score, psswrd FROM players
            WHERE email = ?";
            $req = $bdd->prepare($requete);
            $req->bindParam(1,$email, PDO::PARAM_STR);
            $req->execute();
            $data = $req->fetch(PDO::FETCH_ASSOC);
            return $data;
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }
}
