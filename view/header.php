<?php
class ViewHeader{
    //Fonction permettant l'affichage du header dans la vue au format HTML
    public function displayView(): string {
        ob_start();
    ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Supergame</title>
        </head>
        <body>
            <header>
                <nav>
                    <a href='/supergame_cda/'>Accueil</a>
                </nav>
            </header>
            <main>
    <?php
        return ob_get_clean();
    }
}
?>