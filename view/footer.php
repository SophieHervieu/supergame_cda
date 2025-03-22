<?php
class ViewFooter{
    //Fonction permettant l'affichage du footer dans la vue au format HTML
    public function displayView(): string {
        ob_start();
    ?>
        </main>
        <footer>
            <p>Mentions légales</p>
        </footer>
    </body>
    </html>
    <?php
        return ob_get_clean();
    }
}
?>