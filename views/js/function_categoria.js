
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
                cont+=1
                nueva_fila.innerHTML = `
                    <th>${cont}</th>
                    <td>${item.nombre}</td>
                    <td>${item.detalle}</td>
                    <td>${item.options}</td>
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

/* async function listar_Categoria() {
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
 */

async function ver_categoria(id) {
    const formData = new FormData();
    formData.append('id_categoria', id);  // Usamos 'id_categoria' en lugar de 'id_producto'
    
    try {
        let respuesta = await fetch(base_url + 'controller/categoria.php?tipo=ver', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: formData
        });

        let json = await respuesta.json();
        
        if (json.status) {
            // Asignar los valores obtenidos a los campos del formulario
            document.querySelector('#nombre').value = json.contenido.nombre;
            document.querySelector('#detalle').value = json.contenido.detalle;
        } else {
            window.location = base_url + "categoria";  // Redirigir si no se encuentra la categoría
        }

        console.log(json);

    } catch (error) {
        console.log("Oops, ocurrió un error: " + error);
    }
}


async function actualizarCategoria() {
    const frmActualizar = document.getElementById('frmActualizar'); // Asegúrate de obtener correctamente el formulario

    if (!frmActualizar) {
        console.error("Formulario no encontrado");
        return;
    }

    const datos = new FormData(frmActualizar);
    
    try {
        let respuesta = await fetch(base_url + 'controller/categoria.php?tipo=actualizar', {
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

        // Aquí puedes manejar la respuesta del servidor
        if (json.status) {
            alert('Categoría actualizada correctamente');
            // Realiza cualquier otra acción que desees después de una actualización exitosa
        } else {
            alert('Error al actualizar la categoría: ' + json.mensaje);
        }

    } catch (e) {
        console.error("Error al actualizar la categoría:", e);
    }
}


async function Eliminar_categoria(id) {
    swal({
        title: "¿Realmente desea eliminar esta categoría?",
        text: "",
        icon: "warning",
        buttons: true,
        dangerMode: true
    }).then((willDelete) => {
        if (willDelete) {
            fnt_eliminar_categoria(id);
        }
    })
}

async function fnt_eliminar_categoria(id) {
    const formData = new FormData();
    formData.append('id_categoria', id);
    try {
        let respuesta = await fetch(base_url + 'controller/categoria.php?tipo=eliminar', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: formData
        });

        const json = await respuesta.json();
        if (json.status) {
            swal("Eliminar", "Categoría eliminada correctamente", "success");
            document.querySelector('#fila' + id).remove();
        } else {
            swal('Eliminar', 'Error al eliminar la categoría', 'warning');
        }

    } catch (error) {
        console.log("Ocurrió un error: " + error);
    }
}
