<?php
class ViewHeader extends AbstractController{
    public function displayView(): string {
        ob_start();
    ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
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