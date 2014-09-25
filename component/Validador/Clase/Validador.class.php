<?php

namespace component\Validador\Clase;

use component\Validador\interfaz\IValidador;


class Validador implements IValidador {
    
    private $miNotificacion;
    var $miConfigurador;
    var $miSql;
    
    function __construct() {
        
        $this->miConfigurador = \Configurador::singleton ();
    }
    
    function setSql($sql){
        $this->miSql=$sql;
    }
    
    function validarDato($dato) {
        
    }
    
    private function buscarDatos() {
        
        $resultado=false;
        /*
        $conexion = 'aplicativo';
        $esteRecursoDB = $this->miConfigurador->fabricaConexiones->getRecursoDB ( $conexion );
        if ($esteRecursoDB) {
            
            $cadenaSql=$this->miSql->getCadenaSql('insertarRegistro',$this->miNotificacion);
            $resultado=$esteRecursoDB->ejecutarAcceso ( $cadenaSql, 'acceso' );
        }
        */
        return $resultado;
    }

}
