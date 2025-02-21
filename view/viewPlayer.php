<?php
//LA VIEW POUR LA CLASS ViewPlayer
class ViewPlayer extends PlayerController{
    //Attributs
    private ?string $signUpMessage = '';
    private ?string $playersList = '';
    
    //Getters et setters
    public function getSignUpMessage(): ?string {
        return $this->signUpMessage;
    }

    public function setSignUpMessage(?string $signUpMessage): self {
        $this->signUpMessage = $signUpMessage;
        return $this;
    }

    public function getPlayersList(): ?string {
        return $this->playersList;
    }

    public function setPlayersList(?string $playersList): self {
        $this->playersList = $playersList;
        return $this;
    }

    //Méthodes
    public function displayView(): string {
        ob_start()
        ?>
        
            <h1>Enregistrer un nouveau joueur</h1>
            <form action="" method="post">
                <label for="pseudo">Pseudonyme</label>
                <input type="text" name="pseudo">
                <label for="email">Email</label>
                <input type="text" name="email">
                <label for="password">Mot de passe</label>
                <input type="text" name="password">
                <input type="submit" value="enregistrer" name="submit">
            </form>
            <?php echo $this->getSignUpMessage() ?>
            <section>
                <h1>Liste des joueurs</h1>
                <ul>
                    <?php echo $this->getPlayersList() ?>
                </ul>
            </section>
        
        <?php
                return ob_get_clean();
    }
}