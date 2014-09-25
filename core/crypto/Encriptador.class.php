<?php

/**
 * IMPORTANTE: Cambiar la frase de seguridad predeterminada afecta el aplicativo si este depende de variables codificadas 
 * con la clave anterior (p.e. si se guardaron datos codificados en la base de datos o en config.inc.php).
 * 
 * 
 * @todo Mejorar la clase para que acepte otras semillas. Tener cuidado pues esta clase se utiliza en bootstrap para decodificar
 * las variables de cofig.inc.php
 */
require_once ("aes.class.php");
require_once ("aesctr.class.php");

class Encriptador {
    
    private static $instance;
    private $llave;
    private $iv;
    const SEMILLA='0xel0t1l';
    
    // Constructor
    function __construct($llave='') {
        
        if($llave===''){
            //Llave predeterminada
            $this->llave=self::SEMILLA;
        }else{
            $this->llave=$llave;
        }
        
    
    }
    
    
    public static function singleton() {
    
        if (! isset ( self::$instance )) {
            $className = __CLASS__;
            self::$instance = new $className ();
        }
        return self::$instance;
    
    }
    
    function codificar($cadena) {
        
        if(function_exists('mcrypt_encrypt'))
        {
            $cadena=base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $this->llave, $cadena, MCRYPT_MODE_ECB));
    
        }else {
            $cadena=base64_encode(AesCtr::encrypt ($cadena, $this->llave, 256 ));
        }
        return $cadena;
    }
    
    function decodificar($cadena) {
        

        if(function_exists('mcrypt_decrypt'))
        {
            $cadena=trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $this->llave, base64_decode($input), MCRYPT_MODE_ECB));            
        
        }else {
            $cadena=AesCtr::decrypt (base64_decode($cadena), $this->llave, 256 );
        }
        

        return  $cadena;
    
    }
    
    
    function codificar_url($cadena, $enlace = '') { 
    
    
        $cadena=$this->codificar($cadena);    
        
        return $enlace . "=" . $cadena;
    
    }
    
    /**
     *
     * Método para decodificar la cadena GET para obtener las variables de la petición
     *
     * @param
     *            $cadena
     * @return boolean
     */
    function decodificar_url($cadena) { 
        
        $cadena = $this->decodificar($cadena);;
        
        parse_str ( $cadena, $matriz);
        
        foreach ( $matriz as $clave => $valor ) {
            $_REQUEST [$clave] = $valor;
        }
        
        return true;
    
    }
    

    function codificarClave($cadena) {
        
        return sha1 ( md5 ( $cadena ) );
    
    }

}

?>
