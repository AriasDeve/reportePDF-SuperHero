<?php

require '../tools/helpers.php';
require '../models/Publisher.php';

$publisher = new Publisher();

if (isset($_GET['operacion'])){

    if($_GET['operacion'] == 'listar'){
        renderJSON($publisher->listAll());
    }
}