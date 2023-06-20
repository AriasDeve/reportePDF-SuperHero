<?php

require 'Conexion.php';

class Race extends Conexion{
    private $conexion;

    public function __CONSTRUCT(){
        $this->conexion = parent::getConexion();
    }

    public function listAll(){
        try{
            $consulta = $this->conexion->prepare("CALL spu_race_list(?)");
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        }
        catch(Exception $e){
            die($e->getMessage());  
        }
    }

    public function getRazas($data=[]){
      try{
        $consulta = $this->conexion->prepare("CALL spu_superhero_multi_race	(?)");
        $consulta->execute(array(
          $data['race_ids']
        ));
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
      }catch(Exception $e){
        die($e->getMessage());
      }
  
    }
  
}