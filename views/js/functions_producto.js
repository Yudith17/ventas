async function listar_productos(){
    try{
        let respuesta = await fetch(base_url+'controller/producto.php?tipo=listar');
        let json  = await respuesta.json();
        if (json.status) {
          let datos = json.contenido;
          let cont = 0;
          datos.forEach(item => {
            let nueva_fila = document.createElement("tr");
            nueva_fila.id = "fila"+item.id;
            cont++;
            nueva_fila.innerHTML= `
                                  <th>${cont}</th>
                                  <td>${item.codigo}</td>
                                  <td>${item.nombre}</td>
                                  <td>${item.stock}</td>
                                  <td>${item.categoria.nombre}</td>
                                  <td>${item.proveedor.razon_social}</td>
                                  <td>${item.options}</td>
            `;
            document.querySelector('#tbl_producto').appendChild(nueva_fila);
            //console.log(nueva_fila);

          });

        }
        console.log(json);
    }catch (error)  {
        console.log("Oops salio un error "+error);
    }
}

if (document.querySelector('#tbl_producto')) {
    listar_productos();
}

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

async function listar_Categorias() {
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

async function ver_producto(id){
    const formData = new FormData();
    formData.append ('id_producto', id);
    try {
        let respuesta = await fetch(base_url+ 'controller/producto.php?tipo=ver',{
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body:formData
        });

        json = await respuesta.json();
        if (json.status) {
            document.querySelector('#codigo').value = json.contenido.codigo;
            document.querySelector('#nombre').value = json.contenido.nombre;
            document.querySelector('#detalle').value = json.contenido.detalle;
            document.querySelector('#precio').value = json.contenido.precio;
            document.querySelector('#stock').value = json.contenido.stock;
            document.querySelector('#categoria').value = json.contenido.categoria;
            document.querySelector('#proveedor').value = json.contenido.proveedor;
            
        
        }else{
            window.location= base_url+"producto";
        }


        console.log(json);

    } catch (error) {
        console.log("oopss ocurrio um error "+error);
    }
}

async function actualizarProducto() {
    const frmActualizar = document.getElementById('frmActualizar'); // Asegúrate de obtener correctamente el formulario

    if (!frmActualizar) {
        console.error("Formulario no encontrado");
        return;
    }

    const datos = new FormData(frmActualizar);
    
    try {
        let respuesta = await fetch(base_url + 'controller/producto.php?tipo=actualizar', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });

        // Comprobamos si la respuesta es exitosa
        if (!respuesta.ok) {
            throw new Error('Error en la respuesta del servidor');
        }

        const json = await respuesta.json();
        console.log(json); // Muestra la respuesta del servidor
        
    } catch (e) {
        console.error("Error al actualizar el producto:"+ e);
    }
}



async function Eliminar_producto(id) {
    swal({
        title:"¿Realmente desea eliminar este producto?",
        text:"",
        icon:"warning",
        buttons: true,
        dangerMode: true
    }).then((willDelete)=>{
        if (willDelete) {
            fnt_eliminar(id);
        }
    })
}

async function fnt_eliminar(id) {
    //alert("Producto eliminado: id=" + id);
    const formData = new FormData();
    formData.append('id_producto',id);
    try {
        let respuesta = await fetch(base_url + 'controller/producto.php?tipo=eliminar',{
        method: 'POST',
        mode: 'cors',
        cache: 'no-cache',
        body:formData

        });
        json = await respuesta.json();
        if (json.status) {
            swal("Eliminar","eliminado correctamente","success");
            document.querySelector('#fila'+id).remove();
        }else{
           swal('Eliminar', 'error al eliminar el producto', 'warning');
        }
        
    }catch (error) {
        console.log("ocurrio un error "+ error);
    }
}