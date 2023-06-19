<?php 

require_once '../tools/helpers.php';
require_once '../models/Race.php';

$race = new Race();

if (isset($_GET['operacion'])){

    if($_GET['operacion'] == 'listar'){
        renderJSON($race->listAll());
        
    }
}
?>