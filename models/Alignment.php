<?php
require 'Conexion.php';

class  Alignment extends  Conexion{

    private $conexion;

    public function __CONSTRUCT(){
        $this->conexion = parent::getConexion();
    }

    public function listar(){
        try {
            $consulta = $this->conexion->prepare("CALL spu_alignment_list_t1_1()");
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        }
        catch(Exception $e){
            die($e->getMessage());
        }
    }
}
?>