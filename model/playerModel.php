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
    public function __construct(){
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
    //Méthode qui permet l'ajout d'un joueur en bdd en liant chaque paramètre à une colonne de la table
    public function add(): ?string {
        try{
            $bdd = $this->getBdd();
            $pseudo = $this->getPseudo();
            $email = $this->getEmail();
            $score = $this->getScore();
            $psswrd = $this->getPassword();

            $requete = "INSERT INTO players(pseudo, email, score, psswrd)
            VALUE(?,?,?,?)";
            $req = $bdd->prepare($requete);
            $req->bindParam(1,$pseudo, PDO::PARAM_STR);
            $req->bindParam(2,$email, PDO::PARAM_STR);
            $req->bindParam(3,$score, PDO::PARAM_INT);
            $req->bindParam(4,$psswrd, PDO::PARAM_STR);
            $req->execute();
            return "Le joueur a été ajouté avec succès";
        }
        catch(Exception $e) {
            return "Erreur : " . $e->getMessage();
        }
    }
    //Méthode qui permet de récupérer tous les joueurs présents en bdd grâce à la méthode fetchAll
    public function getAll(): array | null {
        try {
            $bdd = $this->getBdd();

            $requete = "SELECT id, pseudo, email, score FROM players";
            $req = $bdd->prepare($requete);
            $req->execute();
            $data = $req->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage();
            return null;
        }
    }
    //Méthode qui permet de récupérer un joueur en bdd par son adresse email en liant le paramètre email à la colonne correspondante et grâce à la méthode fetch
    public function getByEmail(): array | null | bool {
        try {
            $bdd = $this->getBdd();
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
            return null;
        }
    }
}
