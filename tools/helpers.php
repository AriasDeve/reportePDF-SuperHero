<?php
// Función renderiza en el VIEW un JSON si el origen NO está vacio
function renderJSON($data) {
    if($data){
        echo json_encode($data);
    }
} 