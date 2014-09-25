<?php
namespace component\GestorNotificaciones;

require_once ('component/Component.class.php');
require_once ('component/Notificador/Clase/RegistradorNotificacion.class.php');

//Componentes externos
/**
 * Su ubicación (carpeta) se debe definir en el paquete de entrega de desarrollo y ser
 * registrado por el equipo responsable de integración.
 */
use component\Validador as Validador;


/*use component\Validador as Validador;

require_once ('component/Validador/Componente.class.php');
require_once ('component/LoggerAuditoria/Componente.class.php');
require_once ('component/GestorProcesos/Componente.class.php');
require_once ('component/GestorUsuarios/Componente.class.php');
*/

// Compilación de clausulas SQL utilizadas por el bloque
include_once ("Sql.class.php");



class Componente extends Component implements IGestorNotificaciones{
    
    
    
    private $miNotificador;
    private $miSql;
    private $miValidador;
    private $miLogger;
    private $miGestorProcesos;
    private $miGestorUsuarios;
    
    //Esta clase actua como mediador
    
    /**
     * 
     * @param \INotificador $notificador Un objeto de una clase que implemente la interfaz INotificador
     */
    public function __construct()
    {
        //Interfaces internas
        $this->miNotificador = new RegistradorNotificacion();
        
        //Interfaces externas
        
        $this->miValidador = new Validador();
        $this->miLogger=new LoggerAuditoria();
        $this->miGestorProcesos=new GestorProcesos();
        $this->miGestorUsuarios=new GestorUsuarios();
        
        
        $this->miSql= new Sql();
        $this->miNotificador->setSql($this->miSql);
        
    }
        
    function crearNotificacion($cadena){
        
    }
    
    function consultarNotificacion($idNotificacion){
        
    }
    
    function cambiarEstadoNotificacion($idNotificacion){
        return true;
    }
    
    function consultarPendientes($idUsuario){
        return 1;
        
    }
    
}

