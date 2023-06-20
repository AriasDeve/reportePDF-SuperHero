<?php
require 'Conexion.php';

class  Ejemplo1 extends  Conexion{

    private $conexion;

    public function __CONSTRUCT(){
        $this->conexion = parent::getConexion();
    }

    public function ejemplo1($data=[]){
        try {
            $consulta = $this->conexion->prepare("CALL sp_getAlignment_publisher(?)");
            $consulta->execute(
              array(
                $data['publisher']
              )
            );
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        }
        catch(Exception $e){
            die($e->getMessage());
        }
    }
}
?>