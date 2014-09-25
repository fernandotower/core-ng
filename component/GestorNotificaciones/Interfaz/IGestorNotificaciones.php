<?php
namespace component\GestorNotificaciones\interfaz;

interface IGestorNotificaciones{
    
    function crearNotificacion($cadena);
    function consultarNotificacion($idNotificacion);
    function cambiarEstadoNotificacion($idNotificacion);
    function consultarPendientes($idUsuario);
    
}


?>