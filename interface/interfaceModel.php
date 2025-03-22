<?php
//LE FICHIER POUR L'INTERFACE InterfaceModel
interface InterfaceModel{
    //Méthodes add pour l'ajout d'un joueur en bdd, et getAll pour l'affichage de tous les joueurs présents en bdd
    public function add(): ?string;
    public function getAll(): array | null;
}