<?php
require_once 'includes/db.php'; // Incluye el archivo de conexión a la base de datos si es necesario
include 'includes/init.php'; // Incluye cualquier archivo de inicialización si es necesario
// Aquí puedes agregar lógica adicional si es necesaria antes del contenido principal
?>

<head>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
<!-- SweetAlert2 -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.1/dist/sweetalert2.min.css">

<!-- Additional CSS Files -->
<link rel="stylesheet" href="assets/css/templatemo-574-mexant.css">
<link rel="stylesheet" href="assets/css/owl.css">
<link rel="stylesheet" href="assets/css/animate.css">
<link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css">

</head>

<body>

<!-- ***** Main Banner Area Start ***** -->
<div class="swiper-container" id="top">
    <div class="swiper-wrapper">
        <div class="swiper-slide">
            <div class="slide-inner" style="background-image:url(assets/images/slide-01.jpg)">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="header-text">
                                <h2>Bienvenidos a el <em>curso </em>de manipulación  de alimentos<br> de <em>certificando.com.co</em></h2>
                                <div class="div-dec"></div>
                                <p>Este curso tiene como objetivo  capacitar a las personas que van a trabajar en la industria alimenticia principalmente  contiene los conceptos básicos de las BPM o buenas prácticas de manufactura y las  exigencias establecidas para las personas que manipulan alimentos según las resoluciones  2674 de 2013, 683 de 2012, 2184 de 2019 y 5109 de 2005.</p>
                                <div class="buttons">
                                    <div class="green-button">
                                        <a id="loginLink" href="#">INICIAR</a>
                                    </div>
                                    <div class="orange-button">
                                        <a href="#">Contactenos</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ***** Main Banner Area End ***** -->


<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.1/dist/sweetalert2.all.min.js"></script>


</body>
</html>



<script>
    // SweetAlert2 para mostrar formulario de inicio de sesión
    document.getElementById('loginLink').addEventListener('click', function() {
        Swal.fire({
            title: 'Iniciar Sesión',
            html:
                '<form id="loginForm">' +
                '<input type="email" id="email" class="swal2-input" placeholder="Correo Electrónico" required>' +
                '<input type="password" id="password" class="swal2-input" placeholder="Contraseña" required>' +
                '<select id="userType" class="swal2-select" required>' +
                '<option value="" disabled selected>Seleccionar tipo de usuario</option>' +
                '<option value="company">Empresa</option>' +
                '<option value="employee">Empleado</option>' +
                '</select>' +
                // '<button type="submit" class="btn btn-primary mt-2">Iniciar Sesión</button>' +
                '</form>',
            showCancelButton: true,
            confirmButtonText: 'Iniciar Sesión',
            cancelButtonText: 'Cancelar',
            showLoaderOnConfirm: true,
            preConfirm: () => {
                const email = document.getElementById('email').value.trim();
                const password = document.getElementById('password').value.trim();
                const userType = document.getElementById('userType').value;

                if (!email || !password || !userType) {
                    Swal.showValidationMessage('Todos los campos son obligatorios');
                    return false;
                }

                return { email: email, password: password, userType: userType };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Envía el formulario con AJAX
                const formData = result.value;
                submitLogin(formData);
            }
        });
    });

    // Función para enviar el formulario de inicio de sesión
    function submitLogin(formData) {
        // Aquí puedes enviar el formulario utilizando AJAX o un formulario normal
        // Por ejemplo, podrías hacer una petición AJAX a process_login.php
        // con los datos formData: formData.email, formData.password, formData.userType

        // Ejemplo de AJAX (usando fetch)
        fetch('process_login.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(formData)
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            // Redirige según el tipo de usuario
            if (formData.userType === 'company') {
                window.location.href = 'dashboard_company.php'; // Página de empresa
            } else if (formData.userType === 'employee') {
                window.location.href = 'dashboard_employee.php'; // Página de empleado
            }
        })
        .catch(error => {
            console.error('Error al iniciar sesión:', error);
            Swal.fire('Error', 'Hubo un problema al iniciar sesión.', 'error');
        });
    }
</script>
