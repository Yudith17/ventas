async function listar_personas() {
    try {
        let respuesta = await fetch(base_url + 'controller/persona.php?tipo=listar');
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
                    <td>${item.nro_identidad}</td>
                    <td>${item.razon_social}</td>
                    <td>${item.telefono}</td>
                    <td>${item.correo}</td>
                    <td>${item.departamento}</td>
                    <td>${item.provincia}</td>
                    <td>${item.distrito}</td>
                    <td>${item.cod_postal}</td>
                    <td>${item.direccion}</td>
                    <td>${item.rol}</td>
                    <td>${item.password}</td>
                    <td>${item.estado}</td>
                    <td>${item.fecha_reg}</td>
                     <td>${items.options}</td>
                `;
                document.querySelector('#tbl_persona').appendChild(nueva_fila);
                 //console.log(nueva_fila);
                 
            });
        }
        console.log(json);
    } catch (error) {
        console.log("Oops, ocurrió un error: " + error);
    }
}

if (document.querySelector('#tbl_persona')) {
    listar_personas();
}

async function registrar_persona() {
    let nro_identidad = document.getElementById('nro_identidad').value;
    let razon_social = document.getElementById('razon_social').value;
    let telefono = document.getElementById('telefono').value;
    let correo = document.getElementById('correo').value;
    let departamento = document.getElementById('departamento').value;
    let provincia = document.getElementById('provincia').value;
    let distrito = document.getElementById('distrito').value;
    let cod_postal = document.getElementById('cod_postal').value;
    let direccion = document.getElementById('direccion').value;
    let rol = document.getElementById('rol').value;
    let password = document.getElementById('password').value;
    let estado = document.getElementById('estado').value;
    let fecha_reg = document.getElementById('fecha_reg').value;

    // Validate that all fields are filled
    if (nro_identidad === "" || razon_social === "" || telefono === "" || correo === "" ||
        departamento === "" || provincia === "" || distrito === "" || cod_postal === "" ||
        direccion === "" || rol === "" || password === "" || estado === "" || fecha_reg === "") {
        alert("Error, campos vacíos");
        return;
    }

    try {
        // Create FormData with person data
        const datos = new FormData();
        datos.append("nro_identidad", nro_identidad);
        datos.append("razon_social", razon_social);
        datos.append("telefono", telefono);
        datos.append("correo", correo);
        datos.append("departamento", departamento);
        datos.append("provincia", provincia);
        datos.append("distrito", distrito);
        datos.append("cod_postal", cod_postal);
        datos.append("direccion", direccion);
        datos.append("rol", rol);
        datos.append("password", password);
        datos.append("estado", estado);
        datos.append("fecha_reg", fecha_reg);

        // Send data to the controller
        let respuesta = await fetch(base_url + 'controller/persona.php?tipo=registrar', {
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
