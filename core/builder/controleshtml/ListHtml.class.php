<?php
/**
 * 
 */


require_once ("core/builder/HtmlBase.class.php");


class ListHTML extends HtmlBase{
    
    
    function listaNoOrdenada($atributos) {
        
        $this->setAtributos ( $atributos );
        $this->campoSeguro();
    
        if (isset ( $this->atributos ['id'] )) {
            $this->cadenaHTML = "<ul id='" . $this->atributos ['id'] . "' ";
        } else {
            $this->cadenaHTML = "<ul ";
        }        
        
        if(isset ( $this->atributos ['menu'] ) && $this->atributos ['menu']){
            $this->cadenaHTML .= "class='listaMenu' ";
        }
        
        $this->cadenaHTML .= ">";
    
        foreach ( $this->atributos ["items"] as $clave => $valor ) {
            // La clave es la fila, el valor es un arreglo con los datos de cada columna
            // $arreglo[fila][columna] 
            
            $this->cadenaHTML .= '<li ';
            
            if (isset ( $valor ['toolTip'] )) {
                $this->cadenaHTML.= " title='" . $valor ['toolTip'] . "' ";
            }
            
            $this->cadenaHTML .= '>';
    
            $this->procesarValor ( $valor, $clave );
    
            $this->cadenaHTML .= "</li>";
        }
    
        $this->cadenaHTML .= "</ul>";
    
        return $this->cadenaHTML;
    
    }
    
    private function procesarValor($valor, $clave) {
        
        if(isset ( $this->atributos ['menu'] ) && $this->atributos ['menu']){
            $claseEnlace= "class='enlaceMenu' ";
        }else{
            $claseEnlace='';
        }
        
        if (is_array ( $valor )) {
    
            if (isset ( $valor ['icono'] )) {
                $icono = '<span class="ui-accordion-header-icon ui-icon ' . $valor ['icono'] . '"></span>';
            } else {
                $icono = '';
            }
    
            if (isset ( $valor ['enlace'] ) && $this->atributos ['estilo'] == self::JQUERYUI) {
                $this->cadenaHTML .= "<a  id='pes" . $clave . "' ".$claseEnlace." href='" . $valor ['urlCodificada'] . "'>";
                $this->cadenaHTML .= "<div id='tab" . $clave . "' class='ui-accordion ui-widget ui-helper-reset'>";
                $this->cadenaHTML .= "<span class='ui-accordion-header ui-state-default ui-accordion-icons ui-corner-all'>" . $icono . $valor ['nombre'] . "</span>";
                $this->cadenaHTML .= "</div>";
                $this->cadenaHTML .= "</a>";
            }
        } else {
            // Podría implementarse llamando a $this->enlace
            if (isset ( $this->atributos ["pestañas"] ) && $this->atributos ["pestañas"] == "true") {
                $this->cadenaHTML .= "<a id='pes" . $clave . "' ".$claseEnlace." href='#" . $clave . "'><div id='tab" . $clave . "'>" . $valor . "</div></a>";
            }
    
            if (isset ( $this->atributos ["enlaces"] ) && $this->atributos ["enlaces"] == "true") {
                $enlace = explode ( '|', $valor );
                $this->cadenaHTML .= "<a href='" . $enlace [1] . "' ".$claseEnlace.">" . $enlace [0] . "</a>";
            }
        }
    
        return true;
    }
    
    
    
}