<?php

require '../tools/helpers.php';
require '../models/SuperHero.php';

$superHero = new Alignment();

if(isset($_GET['operacion'])){
    if($_GET['operacion'] == 'listarAlignment'){
        renderJSON($superHero->listByAlignment([
            "publisher_id" => $_GET['publisher_id'],
            "alignment_id" => $_GET['alignment_id']
        ]));
    }
}