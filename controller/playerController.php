<?php
//LE CONTROLLER pour la class PlayerController
class PlayerController extends AbstractController{
    //Attributs
    private ?ViewPlayer $player;

    public function __construct(ViewHeader $header, ViewFooter $footer, InterfaceModel $model, ViewPlayer $player) {
        $this->setHeader($header);
        $this->setFooter($footer);
        $this->setModel($model);
        $this->player = $player;
    }

    //Getters et setters
    /**
     * récupère la valeur de player
     *
     * @return ?ViewPlayer
     */
    public function getPlayer(): ?ViewPlayer {
        return $this->player;
    }

    /**
     * définit la valeur de player
     *
     * @param ?ViewPlayer $player
     *
     * @return self
     */
    public function setPlayer(?ViewPlayer $player): self {
        $this->player = $player;
        return $this;
    }

    //Méthodes
    //Méthode qui vérifie les champs étape par étape et ajoute un joueur en bdd si les conditions sont remplies
    public function addPlayer(): string {
        //Vérifie qu'on reçoit le formulaire
        if(isset($_POST['submit'])){
            //Vérifie si les champs sont vides
            if(empty($_POST['pseudo']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['score'])){
                return "Veuillez remplir les champs !";
            }
            //Vérifie le format des données
            if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
                return "Email pas au bon format !";
            }
            //Nettoie les données
            $pseudo = sanitize($_POST['pseudo']);
            $email = sanitize($_POST['email']);
            $password = sanitize($_POST['password']);
            $score= sanitize($_POST['score']);
            //Hashe le mot de passe
            $password = password_hash($password, PASSWORD_BCRYPT);
            //Vérifie que le mot de passe n'existe pas déjà en bdd
            if(!empty($this->getModel()->setEmail($email)->getByEmail())){
                return "Cet email existe déjà !";
            }
            //Donne les informations au modèle qui les ajoute grâce à la méthode add
            $this->getModel()->setPseudo($pseudo)->setEmail($email)->setPassword($password)->setScore($score)->add();
            //Retourne un message de succès de l'action
            return "$pseudo a été enregistré avec succès !";
        }
        return '';
    }
    //Méthode qui ajoute chaque joueur à la liste des joueurs affichée grâce au return
    public function getAllPlayers(): string {
        $data = $this->getModel()->getAll();
        $listPlayers = "";

        foreach($data as $player){
            $listPlayers= $listPlayers."<li><h2>".$player['pseudo'] ." ". $player['email']."</h2>      <p>".$player['score']."</p></li>";
        }
        return $listPlayers;
    }
    //Méthode render permettant l'affichage du header, du footer et de la vue viewPlayer
    public function render(): void {
        $getSingUpMessage = $this->addPlayer();
        $getPlayersList = $this->getAllPlayers();

        echo $this->getHeader()->displayView();
        echo $this->getPlayer()->setSignUpMessage($this->addPlayer())->setPlayersList($this->getAllPlayers())->displayView();
        echo $this->getFooter()->displayView();
    }
}