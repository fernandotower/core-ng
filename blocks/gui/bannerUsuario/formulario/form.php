<?php

namespace blocks\gui\bannerUsuario\formulario;


use component\GestorNotificaciones\Componente;

if (! isset ( $GLOBALS ["autorizado"] )) {
    include ("../index.php");
    exit ();
}

class Formulario {
    
    var $miConfigurador;
    var $lenguaje;
    var $miFormulario;
    
    
    function __construct($lenguaje, $formulario) {
        
        $this->miConfigurador = \Configurador::singleton ();
        
        $this->miConfigurador->fabricaConexiones->setRecursoDB ( 'principal' );
        
        $this->lenguaje = $lenguaje;
        
        $this->miFormulario = $formulario;
    
    }    
    
    function formulario() {
        
        $this->estructura();
        $this->formPasoVariables();
        
    
    }
    
    function estructura(){
        // ------------------- Inicio División -------------------------------
        $esteCampo = 'divGeneral';
        $atributos ['id'] = $esteCampo;
        $atributos ['estilo'] = 'jquery divGeneral';
        $atributos ['estiloEnLinea'] = '';
        $atributos ['titulo'] = $this->lenguaje->getCadena ( $esteCampo . 'Titulo' );
        echo $this->miFormulario->division ( "inicio", $atributos );
        {
        
            // ------------------- Inicio División -------------------------------
            $esteCampo = 'divDatosUsuario';
            $atributos ['id'] = $esteCampo;
            $atributos ['estilo'] = 'jquery divDatosUsuario';
            $atributos ['estiloEnLinea'] = '';
            $atributos ['titulo'] = $this->lenguaje->getCadena ( $esteCampo . 'Titulo' );
            echo $this->miFormulario->division ( "inicio", $atributos );
        
            // ---------------------Fin Division -----------------------------------
            echo $this->miFormulario->division ( "fin" );
            unset($atributos);
        
            // ------------------- Inicio División -------------------------------
            $esteCampo = 'divLogoNotificador';
            $atributos ['id'] = $esteCampo;
            $atributos ['estilo'] = 'divLogoNotificador';
            $atributos ['estiloEnLinea'] = '';
            $atributos ['titulo'] = $this->lenguaje->getCadena ( $esteCampo . 'Titulo' );
            echo $this->miFormulario->division ( "inicio", $atributos );
            unset($atributos);
        
            //--------------------Imagen ---------------------------------------------
            $esteCampo = 'divImagenLogoNotificador';
            $atributos ['id'] = $esteCampo;
            $atributos['imagen']=$this->miConfigurador->getVariableConfiguracion('rutaUrlBloque').'css/images/iconoNotificacion.png';
            $atributos['estilo']=$esteCampo;
            $atributos['etiqueta']=$this->lenguaje->getCadena ( $esteCampo . 'Titulo' );;
            $atributos['ancho']='40px';
            $atributos['alto']='40px';
            echo $this->miFormulario->campoImagen($atributos );;
            unset($atributos);
        
            {
                // ------------------- Inicio División -------------------------------
                $esteCampo = 'divContenidoNotificador';
                $atributos ['id'] = $esteCampo;
                $atributos ['estilo'] = 'jquery divContenidoNotificador flechita';
                $atributos ['estiloEnLinea'] = '';
                $atributos ['titulo'] = $this->lenguaje->getCadena ( $esteCampo . 'Titulo' );
                echo $this->miFormulario->division ( "inicio", $atributos );
        
                // ---------------------Fin Division -----------------------------------
                echo $this->miFormulario->division ( "fin" );
            }
            // ---------------------Fin Division -----------------------------------
            echo $this->miFormulario->division ( "fin" );
        
            // ------------------- Inicio División -------------------------------
            $esteCampo = 'divCalendario';
            $atributos ['id'] = $esteCampo;
            $atributos ['estilo'] = 'jquery divCalendario';
            $atributos ['estiloEnLinea'] = '';
            $atributos ['titulo'] = $this->lenguaje->getCadena ( $esteCampo . 'Titulo' );
            echo $this->miFormulario->division ( "inicio", $atributos );
        
            // ---------------------Fin Division -----------------------------------
            echo $this->miFormulario->division ( "fin" );
        
            // ------------------- Inicio División -------------------------------
            $esteCampo = 'divLogo';
            $atributos ['id'] = $esteCampo;
            $atributos ['estilo'] = 'jquery divLogo';
            $atributos ['estiloEnLinea'] = '';
            $atributos ['titulo'] = $this->lenguaje->getCadena ( $esteCampo . 'Titulo' );
            echo $this->miFormulario->division ( "inicio", $atributos );
        
            // ---------------------Fin Division -----------------------------------
            echo $this->miFormulario->division ( "fin" );
        
        }
        
        // ---------------------Fin Division -----------------------------------
        echo $this->miFormulario->division ( "fin" );
    }
    
    function formPasoVariables(){
        // ------------------- SECCION: Paso de variables ------------------------------------------------
        
        /**
         * En algunas ocasiones es útil pasar variables entre las diferentes páginas. SARA permite realizar esto a través de tres
         * mecanismos:
         * (a). Registrando las variables como variables de sesión. Estarán disponibles durante toda la sesión de usuario. Requiere acceso a
         * la base de datos.
         * (b). Incluirlas de manera codificada como campos de los formularios. Para ello se utiliza un campo especial denominado
         * formsara, cuyo valor será una cadena codificada que contiene las variables.
         * (c) a través de campos ocultos en los formularios. (deprecated)
         */
        
        //En este formulario se utiliza el mecanismo (b) para pasar las siguientes variables:
        
        // Paso 1: crear el listado de variables
        
        $valorCodificado = "idUsario=" . $esteBloque ["grupo"];
        /**
         * SARA permite que los nombres de los campos sean dinámicos. Para ello utiliza la hora en que es creado el formulario para
         * codificar el nombre de cada campo. Si se utiliza esta técnica es necesario pasar dicho tiempo como una variable:
         * (a) invocando a la variable $_REQUEST ['tiempo'] que se ha declarado en ready.php o
         * (b) asociando el tiempo en que se está creando el formulario
        */
        $valorCodificado .= "&tiempo=" . $_REQUEST ['tiempo'];
        //Paso 2: codificar la cadena resultante
        $valorCodificado = $this->miConfigurador->fabricaConexiones->crypto->codificar ( $valorCodificado );
        
        
        $atributos ["id"] = "formSaraData"; // No cambiar este nombre
        $atributos ["tipo"] = "hidden";
        $atributos ['estilo']='';
        $atributos ["obligatorio"] = false;
        $atributos ['marco']=true;
        $atributos ["etiqueta"] = "";
        $atributos ["valor"] = $valorCodificado;
        echo $this->miFormulario->campoCuadroTexto ( $atributos );
        unset ( $atributos );
        
        // ----------------FIN SECCION: Paso de variables -------------------------------------------------
    } 

}

$miFormulario = new Formulario ( $this->lenguaje, $this->miFormulario );

$miFormulario->formulario ();

?>