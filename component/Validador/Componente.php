<?php
namespace component\Validador;

use component\Component;
use component\Validador\Clase;
use component\Validador\interfaz;

// Compilación de clausulas SQL utilizadas por el bloque
include_once ("Sql.class.php");



class Componente extends Component implements INotificador{
    
    
    
    private $miNotificador;
    private $miSql;
    
    
    
    //El componente actua como Fachada
    
    /**
     * 
     * @param \INotificador $notificador Un objeto de una clase que implemente la interfaz INotificador
     */
    public function __construct()
    {
        
        $this->miNotificador = new RegistradorNotificacion();
        $this->miSql= new Sql();
        $this->miNotificador->setSql($this->miSql);
        
    }
    
    public function datosNotificacionSistema($notificacion) {
        return $this->miNotificador->datosNotificacionSistema($notificacion);
    }
    
    
    
    
}

