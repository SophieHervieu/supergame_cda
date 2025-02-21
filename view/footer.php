<?php
class ViewFooter extends AbstractController{
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