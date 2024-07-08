<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}
include 'templates/header.php';
?>

<body>
    <h1>Empleados Registrados</h1>

    <!-- Tabla para listar empleados -->
    <table id="empleadosTable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Fecha Registro</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

    <button type="button" class="btn btn-outline-primary" id="btnRegistrarUsuario">Registrar Nuevo Usuario</button>

    <p>
        <a href="logout.php" target="_blank" rel="noopener noreferrer" class="btn btn-outline-danger">Cerrar Sesión</a>
    </p>
</body>
</html>

<?php
include 'templates/footer.php';
?>

<!-- Incluir jQuery y DataTables -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Inicializar DataTable
    $('#empleadosTable').DataTable({
        ajax: {
            url: 'get_empleados.php',
            dataSrc: ''
        },
        columns: [
            { data: 'id' },
            { data: 'nombre' },
            { data: 'email' },
            { data: 'created_at' }
        ]
    });

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
                const nombre = document.getElementById('nombre').value;
                const correo = document.getElementById('correo').value;
                const contrasena = document.getElementById('contrasena').value;
                return { nombre: nombre, correo: correo, contrasena: contrasena };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                const { nombre, correo, contrasena } = result.value;
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
                        // Recargar la tabla de empleados
                        $('#empleadosTable').DataTable().ajax.reload();
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
