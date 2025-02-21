<?php
//LA CLASSE ABSTRAITE AbstractController.php
abstract class AbstractController{
    //Attributs
    private ?ViewHeader $header;
    private ?ViewFooter $footer;
    private ?InterfaceModel $model;

    //Getters et setters
    /**
     * recupère la valeur de header
     *
     * @return ?ViewHeader
     */
    public function getHeader(): ?ViewHeader {
        return $this->header;
    }

    /**
     * définit la valeur de header
     *
     * @param ?ViewHeader $header
     *
     * @return self
     */
    public function setHeader(?ViewHeader $header): self {
        $this->header = $header;
        return $this;
    }

    /**
     * recupère la valeur de footer
     *
     * @return ?ViewFooter
     */
    public function getFooter(): ?ViewFooter {
        return $this->footer;
    }

    /**
     * définit la valeur de footer
     *
     * @param ?ViewFooter $footer
     *
     * @return self
     */
    public function setFooter(?ViewFooter $footer): self {
        $this->footer = $footer;
        return $this;
    }

    /**
     * recupère la valeur model
     *
     * @return ?InterfaceModel
     */
    public function getModel(): ?InterfaceModel {
        return $this->model;
    }

    /**
     * définit la valeur de model
     *
     * @param ?InterfaceModel $model
     *
     * @return self
     */
    public function setModel(?InterfaceModel $model): self {
        $this->model = $model;
        return $this;
    }

    //Méthodes
    public abstract function render(): void;
}