
<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}
include 'templates/header.php';
?>

<body>
    <h1>Formulario para nuevos estudiantes</h1>
    <!-- dashboard_company.php -->

<button type="button" class="btn btn-outline-primary" id="btnRegistrarUsuario">Registrar Nuevo Usuario</button>

</br>
<p>
 <a href="logout.php" target="_blank" rel="noopener noreferrer">Cerrar Sesión</a>
</p>
</body>
</html>

<?php
include 'templates/footer.php';
?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Al hacer clic en el botón "Registrar Nuevo Usuario"
    document.getElementById('btnRegistrarUsuario').addEventListener('click', function() {
        Swal.fire({
            title: 'Registrar Nuevo Usuario',
            html:
                '<input id="nombre" class="swal2-input" placeholder="Nombre completo">' +
                '<input id="correo" class="swal2-input" placeholder="Correo electrónico">' +
                '<input id="contrasena" type="password" class="swal2-input" placeholder="Contraseña">',
            focusConfirm: false,
            showCancelButton: true,
            confirmButtonText: 'Registrar',
            cancelButtonText: 'Cancelar',
            preConfirm: () => {
                // Aquí puedes validar los campos si lo necesitas
                const nombre = document.getElementById('nombre').value;
                const correo = document.getElementById('correo').value;
                const contrasena = document.getElementById('contrasena').value;
                return { nombre: nombre, correo: correo, contrasena: contrasena };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Aquí puedes enviar los datos del formulario al servidor para guardar en la base de datos
                const { nombre, correo, contrasena } = result.value;
                // Ejemplo de envío de datos usando fetch
                fetch('guardar_empleado.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ nombre: nombre, correo: correo, contrasena: contrasena }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire('¡Empleado registrado!', '', 'success');
                    } else {
                        Swal.fire('Error', 'No se pudo registrar al empleado', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire('Error', 'Hubo un problema al registrar al empleado', 'error');
                });
            }
        });
    });
});
</script>