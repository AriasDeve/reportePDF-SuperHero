<?php
require 'Conexion.php';

class  SuperHero extends  Conexion{

    private $conexion;

    public function __CONSTRUCT(){
        $this->conexion = parent::getConexion();
    }

    public function listByPublisher($data = []){
        try {
            $consulta = $this->conexion->prepare("CALL spu_superhero_list_publisher(?)");
            $consulta->execute(
                array(
                    $data['publisher_id']
                )
            );
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        }
        catch(Exception $e){
            die($e->getMessage());
        }
    }

    public function listByRace ($data = []){
        try{
            $consulta = $this->conexion->prepare("CALL spu_superhero_listbyrace(?)");
            $consulta->execute(
                array(
                    $data['race_id']
                )
            );
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        }
        catch(Exeption $e){
            die($e->getMessage());
        }
    }
}
