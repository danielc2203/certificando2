<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificando</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.1/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="assets/css/templatemo-574-mexant.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css">
</head>
<body>
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
                                    <p>Este curso tiene como objetivo capacitar a las personas que van a trabajar en la industria alimenticia...</p>
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.1/dist/sweetalert2.all.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('loginLink').addEventListener('click', function() {
                Swal.fire({
                    title: 'Iniciar Sesión',
                    html: `
                        <form id="loginForm">
                            <input type="email" id="email" class="swal2-input" placeholder="Correo Electrónico" required>
                            <input type="password" id="password" class="swal2-input" placeholder="Contraseña" required>
                            <select id="userType" class="swal2-select" required>
                                <option value="" disabled selected>Seleccionar tipo de usuario</option>
                                <option value="company">Empresa</option>
                                <option value="employee">Empleado</option>
                            </select>
                        </form>`,
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

                        console.log('Datos del formulario:', { email, password, userType });

                        return { email, password, userType };
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        const formData = result.value;
                        submitLogin(formData);
                    }
                });
            });
        });

        function submitLogin(formData) {
            fetch('process_login.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(formData)
            })
            .then(response => {
                console.log('Response status:', response.status);
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log('Response from server:', data);
                if (data.redirect) {
                    window.location.href = data.redirect;
                } else if (data.error) {
                    Swal.fire('Error', data.error, 'error');
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
