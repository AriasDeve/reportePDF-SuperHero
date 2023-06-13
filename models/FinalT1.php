<?php
require 'Conexion.php';

class  FinalT1 extends  Conexion{

    private $conexion;

    public function __CONSTRUCT(){
        $this->conexion = parent::getConexion();
    }

    public function listByAlignment($data = []){
        try {
            $consulta = $this->conexion->prepare("CALL spu_alignment_list_t1(?,?)");
            $consulta->execute(
                array(
                    $data['publisher_id'],
                    $data['alignment_id']
                    )
            );
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        }
        catch(Exception $e){
            die($e->getMessage());
        }
    }
}
