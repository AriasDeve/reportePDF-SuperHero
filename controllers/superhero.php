<?php

require '../tools/helpers.php';
require '../models/SuperHero.php';

$superHero = new SuperHero();

if(isset($_GET['operacion'])){
    if($_GET['operacion'] == 'listarCasas'){
        renderJSON($superHero->listByPublisher(["publisher_id" => $_GET['publisher_id']]));
    }
}