async function listar_compras() {
    try {
        // Realiza la solicitud fetch para obtener las compras
        let respuesta = await fetch(base_url + 'controller/compras.php?tipo=listar');
        let json = await respuesta.json();

        if (json.status) {
            let datos = json.contenido;
            let cont = 0;
            
            // Itera sobre los datos de las compras obtenidas
            datos.forEach(item => {
                let nueva_fila = document.createElement("tr");
                nueva_fila.id = "fila" + item.id;

                // Asume que cada compra tiene un id, producto, cantidad, precio y trabajador
                cont++;

                nueva_fila.innerHTML = `
                    <th>${cont}</th>
                    <td>${item.producto.nombre}</td> <!-- Producto nombre -->
                    <td>${item.cantidad}</td> <!-- Cantidad de la compra -->
                    <td>${item.precio}</td> <!-- Precio de la compra -->
                    <td>${item.trabajador.razon_social}</td> <!-- Trabajador que realizó la compra -->
                     <td>${item.options}</td> <!-- Acciones: Editar y Eliminar -->
                `;

                // Añadir la fila de datos a la tabla
                document.querySelector('#tbl_compra').appendChild(nueva_fila);
            });

        }

        console.log(json);
    } catch (error) {
        console.log("Oops, salió un error "+error);
    }
}
// Verificar si la tabla de compras existe y cargar los datos
if (document.querySelector('#tbl_compra')) {
    listar_compras();
}

async function registrar_compra() {
    let producto = document.getElementById('#producto').value;
    let cantidad = document.querySelector('#cantidad').value;
    let precio = document.querySelector('#precio').value;
    let trabajador = document.querySelector('#trabajador').value;

    // Verificar que los campos no estén vacíos
    if (producto == "" || cantidad == "" || precio == "" || trabajador == "") {
        alert("Error, campos vacíos");
        return;
    }

    try {
        // Capturamos datos del formulario HTML
        const datos = new FormData(frmRegistrarCompra);  // Asumiendo que el formulario tiene el id 'frmRegistrarCompra'

        // Enviar los datos hacia el controlador
        let respuesta = await fetch(base_url + 'controller/compras.php?tipo=registrar',{
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });

        let json = await respuesta.json();
        if (json.status) {
            swal("Compra Registrada", json.mensaje, "success");
        } else {
            swal("Error en la Compra", json.mensaje, "error");
        }
        console.log(json);

    } catch (e) {
        console.log("Ocurrió un error: " + e);
    }
}

async function listar_productos() {
    try {
        let respuesta = await fetch(base_url + 'controller/producto.php?tipo=listar');
        let json = await respuesta.json();
        if (json.status) {
            let datos = json.contenido;
            let contenido_select = '<option value="">Seleccione un Producto</option>';
            datos.forEach(element => {
                contenido_select += '<option value="' + element.id + '">' + element.nombre + '</option>';
            });
            document.getElementById('producto').innerHTML = contenido_select;
        }

        console.log(respuesta);

    } catch (e) {
        console.log("Error al cargar productos: " + e);
    }
}

async function listar_trabajadores() {
    try {
        let respuesta = await fetch(base_url + 'controller/persona.php?tipo=listar');
        let json = await respuesta.json();
        if (json.status) {
            let datos = json.contenido;
            let contenido_select = '<option value="">Seleccione un Trabajador</option>';
            datos.forEach(element => {
                contenido_select += '<option value="' + element.id + '">' + element.razon_social+ '</option>';
            });
            document.getElementById('trabajador').innerHTML = contenido_select;
        }
        console.log(respuesta);
    } catch (e) {
        console.log("Error al cargar trabajadores: " + e);
    }
}


async function ver_compra(id){
    const formData = new FormData();
    formData.append('id_compra', id);
    try {
        let respuesta = await fetch(base_url+'controller/Compras.php?tipo=ver',{
            method: 'POST',
            mode: 'cors',
            cache:'no-cache',
            body: formData
        });
        json = await respuesta.json();
        if (json.status) {
            document.querySelector('#codigo').value = json.contenido.codigo;
            document.querySelector('#id_producto').value = json.contenido.id_producto;
            document.querySelector('#cantidad').value = json.contenido.cantidad;
            document.querySelector('#precio').value = json.contenido.precio;
            document.querySelector('#trabajador').value = json.contenido.trabajador;
        }else{
            window.location = base_url+"compras";
        }

        console.log(json);
    } catch (error) {
        console.log("Opps ocurrio un error" + error);
    }
}