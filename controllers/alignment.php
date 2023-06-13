<?php

require '../tools/helpers.php';
require '../models/Alignment.php';

$alignment = new Alignment();

if (isset($_GET['operacion'])){

    if($_GET['operacion'] == 'listar'){
        renderJSON($alignment->listar());
        
    }
}