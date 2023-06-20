<?php 

require_once '../tools/helpers.php';
require_once '../models/Race.php';

$race = new Raza();

if (isset($_GET['operacion'])){

  if($_GET['operacion'] == 'listar'){
    renderJSON($race->listAll());
  }

  if($_GET['operacion'] == 'getRazas'){
    renderJSON($race->getRazas(["race_ids" => $_GET["race_ids"]]));
  }
}



?>