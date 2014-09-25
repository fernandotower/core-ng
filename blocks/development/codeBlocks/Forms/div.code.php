<?php
// ------------------- Inicio División -------------------------------
$esteCampo='identificadorDelControl';
$atributos['id'] = $esteCampo;
$atributos['estilo']='estiloAUtilizar';
$atributos['estiloEnLinea']='estiloEnLineaAUtilizar'; 
$atributos['titulo']=$this->lenguaje->getCadena ( $esteCampo.'Titulo' );
echo $this->miFormulario->division ( "inicio", $atributos );



// ---------------------Fin Division -----------------------------------
echo $this->miFormulario->division ( "fin" );
?>