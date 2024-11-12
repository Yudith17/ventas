
async function 	insertarCategoria() {
    let nombre = document.querySelector('#nombre').value;
    let detalle = document.querySelector('#detalle').value;

    
    if (nombre === "" || detalle === "") {
        alert("Error, campos vacíos");
        return; 
    }

    try {
        
        const datos = new FormData();
        datos.append("nombre", nombre);
        datos.append("detalle", detalle);

       
        let respuesta = await fetch(base_url + 'controller/categoria.php?tipo=registrar', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });

        let json = await respuesta.json();
        if (json.status) {
            swal("Registro", json.mensaje, "success");
        } else {
            swal("Registro", json.mensaje, "error");
        }
        console.log(json);

    } catch (e) {
        console.log("Opss, ocurrió un error: " + e);
    }
}

async function listar_Categoria() {
    try {
        let respuesta = await fetch(base_url + '/controller/categoria.php?tipo=listar');
        let json = await respuesta.json();

        if (json.status) {
            let datos = json.contenido;
            let contenido_select = '<option value="">Seleccione</option>';
            datos.forEach(element => {
                contenido_select += '<option value="' + element.nombre + '">' + element.nombre + ' - ' + element.detalle + '</option>';
            });
            document.getElementById('categoria').innerHTML = contenido_select;
        }

        console.log(respuesta);

    } catch (e) {
        console.log("Error al cargar categorías: " + e);
    }
}




