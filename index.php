<?php
//FICHIER D'EXECUTION
session_start();

include './env.php';
include './utils/utils.php';
include './interface/interfaceModel.php';
include './abstract/abstractController.php';
include './view/header.php';
include './view/viewPlayer.php';
include './view/footer.php';
include './controller/playerController.php';
include './model/playerModel.php';

$home = new PlayerController(['PlayerModel'=>new PlayerModel(new $bdd)], ['header'=>new ViewHeader(), 'footer'=>new ViewFooter(), 'accueil'=>new ViewPlayer()]);
$home = render();