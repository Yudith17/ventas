<?php
class vistaModelo{

    protected static function obtener_vista($vista){
        $palabras_permitidas =[ 'usuario', 'nuevo_usuario','usuario','producto','nuevo_producto','abrigosn','inicio','detallecarrito',
        'conjunton','pantalonn','polon','vestidosn','abrigoh','chortsh','conjuntoh','pantalonh','poloh','abrigom','conjuntom','polom','pantalonm','vestidom','faldam','topsm','sudaderasm',
          'carrito','nosotros','detallepantalon','contacto','pagar','detalleproducto']; //carpetas de html
        if(in_array($vista, $palabras_permitidas)){
            if (is_file("./views/".$vista.".php")) {
                $contenido = "./views/".$vista.".php";
                
            }else{
                $contenido = "404"; // si esta permitido
            }

        }elseif($vista=="login" || $vista=="index"){
            $contenido = "login";

        }else{
            $contenido = "404"; // no esta permitido
        }
        return $contenido;
    }
}
?>