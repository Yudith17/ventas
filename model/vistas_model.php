<?php
session_start();
class vistaModelo{

    protected static function obtener_vista($vista){
        $palabras_permitidas =[ 'usuario', 'nuevo_usuario','personas','categorias','producto','usuario','nuevo-producto','abrigosn','inicio','detallecarrito',
        'conjunton','pantalonn','polon','vestidosn','abrigoh','chortsh','conjuntoh','pantalonh','poloh','abrigom','conjuntom','polom','pantalonm','vestidom','faldam','topsm','sudaderasm',
          'carrito','nosotros','detallepantalon','contacto','pagar','detalleproducto', 'registrar-categoria', 'registrar-compras',
           'registrar-persona','productos','compra','editar-producto','editar-categoria','editar-persona','panel']; //carpetas de html

/*           if (!isset ($_SESSION['sesion_ventas_id'])) {
           return "login";
          }
 */
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