
async function listar_categorias() {
    try {
        let respuesta = await fetch(base_url + 'controller/categoria.php?tipo=listar');
        let json = await respuesta.json();
        if (json.status) {
            let datos = json.contenido;
            let cont = 0;
            datos.forEach(item => {
                let nueva_fila = document.createElement("tr");
                nueva_fila.id = "fila" + item.id;
                cont++;
                nueva_fila.innerHTML = `
                    <th>${cont}</th>
                    <td>${item.nombre}</td>
                    <td>${item.detalle}</td>
                    <td>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editarModal">Editar</button>
                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#eliminarModal">Eliminar</button>
                    </td>
                `;
                document.querySelector('#tbl_categoria').appendChild(nueva_fila);
            });
        }
        console.log(json);
    } catch (error) {
        console.log("Oops, ocurrió un error: " + error);
    }
}

if (document.querySelector('#tbl_categoria')) {
    listar_categorias();
}

async function registrar_categoria() {
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


