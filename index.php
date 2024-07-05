<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Capacitación en Alimentos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/templatemo-574-mexant.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.1/dist/sweetalert2.min.css">
</head>
<body>

<?php include 'templates/header.php'; ?>

<!-- ***** Main Banner Area Start ***** -->
<div class="swiper-container" id="top">
    <div class="swiper-wrapper">
        <div class="swiper-slide">
            <div class="slide-inner" style="background-image:url(assets/images/slide-01.jpg)">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="header-text">
                                <h2>Get <em>ready</em> for your business<br>&amp; upgrade <em>all aspects</em></h2>
                                <div class="div-dec"></div>
                                <p>Mexant HTML5 Template is provided for free of charge. This layout is based on Boostrap 5 CSS framework. Anyone can download and edit for any professional website. Thank you for visiting TemplateMo website.</p>
                                <div class="buttons">
                                    <div class="green-button">
                                        <a id="loginLink" href="#">Discover More</a>
                                    </div>
                                    <div class="orange-button">
                                        <a href="#">Contact Us</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper-slide">
            <div class="slide-inner" style="background-image:url(assets/images/slide-02.jpg)">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="header-text">
                                <h2><em>Digital</em> Currency for you <br>&amp; Best <em>Crypto</em> Tips</h2>
                                <div class="div-dec"></div>
                                <p>You will see a bunch of free CSS templates when you search on Google. TemplateMo website is probably the best one because it is 100% free. It does not ask you anything in return. You have a total freedom to use any template for any purpose.</p>
                                <div class="buttons">
                                    <div class="green-button">
                                        <a id="loginLink" href="#">Discover More</a>
                                    </div>
                                    <div class="orange-button">
                                        <a href="#">Contact Us</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper-slide">
            <div class="slide-inner" style="background-image:url(assets/images/slide-03.jpg)">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="header-text">
                                <h2>Best One in Town<br>&amp; Crypto <em>Services</em></h2>
                                <div class="div-dec"></div>
                                <p>When you browse through different tags on TemplateMo website, you can see a variety of CSS templates which are responsive website designs for different individual needs. Please tell your friends about our website. Thank you.</p>
                                <div class="buttons">
                                    <div class="green-button" >
                                        <a id="loginLink" href="#">Discover More</a>
                                    </div>
                                    <div class="orange-button">
                                        <a href="#">Contact Us</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="swiper-button-next swiper-button-white"></div>
    <div class="swiper-button-prev swiper-button-white"></div>
</div>
<!-- ***** Main Banner Area End ***** -->

<?php include 'templates/footer.php'; ?>

<!-- Scripts -->
<script src="assets/js/isotope.min.js"></script>
<script src="assets/js/owl-carousel.js"></script>
<script src="assets/js/tabs.js"></script>
<script src="assets/js/swiper.js"></script>
<script src="assets/js/custom.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.1/dist/sweetalert2.all.min.js"></script>

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
                '<option value="company">Empresa</option>' +
                '<option value="employee">Empleado</option>' +
                '</select>' +
                '<button type="submit" class="btn btn-primary mt-2">Iniciar Sesión</button>' +
                '</form>',
            showCancelButton: true,
            confirmButtonText: 'Iniciar Sesión',
            cancelButtonText: 'Cancelar',
            showLoaderOnConfirm: true,
            preConfirm: () => {
                const email = document.getElementById('email').value;
                const password = document.getElementById('password').value;
                const userType = document.getElementById('userType').value;

                return { email: email, password: password, userType: userType };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Envía el formulario con AJAX o normalmente
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

</body>
</html>
