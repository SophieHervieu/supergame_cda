<?php
//LE CONTROLLER pour la class PlayerController
class PlayerController extends AbstractController{
    //Attributs
    private ?ViewPlayer $player;

    public function __construct(?ViewPlayer $player) {
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
    public function addPlayer(): string {
        if(isset($_POST['submit'])){
            if(empty($_POST['pseudo']) || empty($_POST['email']) || empty($_POST['password'])){
                return "Veuillez remplir les champs !";
            }
    
            if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
                return "Email pas au bon format !";
            }
    
            $pseudo = sanitize($_POST['pseudo']);
            $email = sanitize($_POST['email']);
            $password = sanitize($_POST['password']);
    
            $password = password_hash($password, PASSWORD_BCRYPT);

            if(!empty($this->getPlayersList()['PlayerModel']->setEmail($email)->getByEmail())){
                return "Cet email existe déjà !";
            }
    
            $player = [$pseudo, $email, $password];
            $this->getPlayersList()['PlayerModel']->setPlayer($player)->add();
        
            return "$pseudo a été enregistré avec succès !";
        }
        return '';
    }

    public function getAllPlayers(): string {
        $data = $this->getPlayersList()['PlayerModel']->setPlayer($player)->getAll();
        $listPlayers = "";

        foreach($data as $player){
            $listPlayers= $listPlayers."<li><h2>".$player['pseudo'] ." ". $player['email']."</h2>      <p>".$player['score']."</p></li>";
        }
        return $listPlayers;
    }

    public function render(): void {
        $getSingUpMessage = $this->addPlayer();
        $getPlayersList = $this->getAllPlayers();

        echo $this->getHeader()->displayView();
        echo $this->getPlayersList()['accueil']->displayView();
        echo $this->getFooter()->displayView();
    }
}