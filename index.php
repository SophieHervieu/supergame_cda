<?php
//FICHIER D'EXECUTION
session_start();

include './utils/utils.php';
include './interface/interfaceModel.php';
include './abstract/abstractController.php';
include './model/playerModel.php';
include './controller/playerController.php';
include './view/header.php';
include './view/viewPlayer.php';
include './view/footer.php';

//Affichage via la méthode render de la vue et du controller
$home = new PlayerController(new ViewHeader(), new ViewFooter(), new PlayerModel(), new ViewPlayer());
$home->render();