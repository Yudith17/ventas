async function registrar_producto (){
let codigo = document.getElementById('codigo').value;
let nombre = document.querySelector('#nombre').value;
let detalle = document.querySelector('#detalle').value;
let precio = document.querySelector('#precio').value;
let stock = document.querySelector('#stock').value;
let categoria = document.querySelector('#categoria').value;
let imagen = document.querySelector('#imagen').value;
let proveedor = document.querySelector('#proveedor').value;
if (codigo=="" || nombre=="" || detalle=="" || precio=="" ||
    stock=="" || categoria=="" || imagen=="" || proveedor=="") {
    alert("error,campos vacios");
    return; 
}
try {
    //capturamos datos del formulario html
    const datos = new FormData(frmRegistrar);
    // enviar datos hacia el controlador 
    let respuesta = await fetch(base_url+'controller/producto.php?tipo=registrar',{
        method: 'POST',
        mode: 'cors',
        cache: 'no-cache',
        body: datos
    });
    json = await respuesta.json();
    if(json.status){
        swal("Registro", json.mensaje,"success");
    }else{
        swal("Registro", json.mensaje,"error");
    }
    console.log(json);
} catch (e) {
    console.log("opss, ocurrio un error"+e);

}
}

async function listar_Categoria() {
    try{
        let respuesta = await fetch(base_url+'/controller/categoria.php?tipo=listar');
        json = await respuesta.json();
        if (json.status) {
            let datos = json.contenido;
            let contenido_select = '<option values="">Seleccione</option>';
            datos.forEach(element => {
                contenido_select += '<option value="' + element.id + '">' + element.nombre + '</option>';
              //se trabaja con jquery  
              /*  $('#categoria').append($('<option />',{
                    text:`${element.nombre}`,
                    value:`${element.id}`
                }));*/
                
            });
            document.getElementById('categoria').innerHTML = contenido_select;
        }

        console.log(respuesta);

    } catch (e) {
        console.log("Error al cargar categorias"+e);
    }
    
}


async function listar_proveedor() {
    try {
        let respuesta = await fetch(base_url+'controller/Proveedores.php?tipo=listar');
        json = await respuesta.json();
        if (json.status) {
            let datos = json.contenido;
            let contenido_select = '<option value="">Seleccione</option>';
            datos.forEach(element => {
                contenido_select += '<option value="' + element.id + '">' + element.razon_social + '</option>';
                /*$('#categoria').append($('<option />',{
                    text:${element.nombre},
                    value:${element.id}
                }));*/
            });
            document.getElementById('proveedor').innerHTML =
            contenido_select;
        }
        console.log(respuesta);
    } catch (e) {
        console.log("Error  al cargar categorias " + e);
    }
}
