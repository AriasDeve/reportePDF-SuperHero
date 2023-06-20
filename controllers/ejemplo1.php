<?php

require '../tools/helpers.php';
require '../models/Ejemplo1.php';

$ejemplo1 = new Ejemplo1();

if (isset($_GET['operacion'])){

    if($_GET['operacion'] == 'listar'){
        renderJSON($ejemplo1->ejemplo1(
          [
            'publisher' => $_GET['publisher']
          ]
        ));
    }
}