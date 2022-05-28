$(document).ready(function() {
    verificar_sesion();
    async function verificar_sesion() {
        let funcion = "verificar_sesion";
        let data = await fetch('/farmaciav2/Controllers/UsuarioController.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'funcion=' + funcion
        })
        if(data.ok) {
            let response = await data.text();
            try {
                let respuesta = JSON.parse(response);
                if(respuesta.length != 0) {

                } else {
                    location.href = "/farmaciav2/";
                }
            } catch (error) {
                console.error(error);
                console.log(response);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo confilcto en el sistema, póngase en contacto con el administrador'
                })
            }
        } else {
            Swal.fire({
                icon: 'error',
                title: data.statusText,
                text: 'Hubo confilcto de código: ' + data.status
            })
        }
    }
});