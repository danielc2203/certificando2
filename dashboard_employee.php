<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

include 'templates/header.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="assets/css/modal.css"> <!-- Agrega tu archivo CSS para estilos del modal -->
</head>
<body class="d-flex flex-column h-100">
    <main class="flex-shrink-0">
        <!-- Header -->
        <header class="py-5">
            <div class="container px-5 pb-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-xxl-7">
                        <!-- Header text content -->
                        <div class="text-center text-xxl-start">
                            <div><div class="text-uppercase">Formación &middot; Seguridad &middot; Calidad</div></div>
                            <div class="fs-3 fw-light text-muted">Te ayudamos a obtener Tu certificación en:</div>
                            <h2 class="display-3 fw-bolder mb-3"><span class="text-gradient d-inline"></span>manipulación de alimentos</h2>
                            <div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xxl-start mb-3">
                                <button class="btn btn-primary btn-lg px-5 py-3 me-sm-3 fs-6 fw-bolder" onclick="openVideoModal()">Ver Curso</button>
                                <button class="btn btn-outline-dark btn-lg px-5 py-3 fs-6 fw-bolder" id="btnRealizarExamen">Realizar Examen</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-5">
                        <!-- Header profile picture -->
                        <div class="d-flex justify-content-center mt-5 mt-xxl-0">
                            <div class="profile bg-gradient-primary-to-secondary">
                                <h1>CERTIFICANDO.COM.CO</h1>                         
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- About Section -->
        <section class="bg-light py-5">
            <div class="container px-5">
                <div class="row gx-5 justify-content-center">
                    <div class="col-xxl-8">
                        <div class="text-center my-5">
                            <h2 class="display-5 fw-bolder"><span class="text-gradient d-inline">Acerca de Nosotros</span></h2>
                            <p class="lead fw-light mb-4">Somos Certificando.com.co, tu aliado en la formación en manipulación de alimentos.</p>
                            <p class="text-muted">
                                En Certificando.com.co, nos especializamos en ofrecer cursos de capacitación en manipulación de alimentos para garantizar que los profesionales del sector alimentario adquieran los conocimientos y habilidades necesarios para cumplir con las normativas sanitarias y asegurar la seguridad alimentaria. 
                                Nuestro objetivo es proporcionar una formación de calidad que permita a los manipuladores de alimentos desempeñar sus funciones de manera segura y eficiente, protegiendo así la salud de los consumidores.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    
    <!-- Video Modal -->
    <div id="videoModal" class="modal">
        <div class="modal-content">
            <video id="courseVideo" width="100%" controls>
                <source src="videos/video_curso_1.mp4" type="video/mp4">
                Tu navegador no soporta la etiqueta de video.
            </video>
        </div>
    </div>
    
    <!-- Core theme JS -->
    <script src="assets/js/curso.js"></script>
    <script>
        function openVideoModal() {
            var modal = document.getElementById("videoModal");
            var video = document.getElementById("courseVideo");

            modal.style.display = "block";
            video.play();

            video.onended = function() {
                modal.style.display = "none";
            };
        }
    </script>

    <!-- script para la funcion de examen -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Función para mostrar el formulario de preguntas
        $('#btnRealizarExamen').click(function() {
            mostrarFormularioPreguntas();
        });

        function mostrarFormularioPreguntas() {
            Swal.fire({
                title: 'Examen de Curso',
                html:
                '<form id="examenForm">' +
                    '<div class="mb-3">' +
                        '<label for="pregunta1" class="form-label">¿Cuál es la capital de Francia?</label>' +
                        '<select id="pregunta1" class="form-select" required>' +
                            '<option value="">Selecciona una respuesta</option>' +
                            '<option value="paris">París</option>' +
                            '<option value="roma">Roma</option>' +
                            '<option value="madrid">Madrid</option>' +
                        '</select>' +
                    '</div>' +
                    '<div class="mb-3">' +
                        '<label for="pregunta2" class="form-label">¿Cuál es el resultado de 2 + 2?</label>' +
                        '<select id="pregunta2" class="form-select" required>' +
                            '<option value="">Selecciona una respuesta</option>' +
                            '<option value="3">3</option>' +
                            '<option value="4">4</option>' +
                            '<option value="5">5</option>' +
                        '</select>' +
                    '</div>' +
                    '<div class="mb-3">' +
                        '<label for="pregunta3" class="form-label">¿Cuál es el océano más grande del mundo?</label>' +
                        '<select id="pregunta3" class="form-select" required>' +
                            '<option value="">Selecciona una respuesta</option>' +
                            '<option value="atlantico">Océano Atlántico</option>' +
                            '<option value="indico">Océano Índico</option>' +
                            '<option value="pacifico">Océano Pacífico</option>' +
                        '</select>' +
                    '</div>' +
                    '<div class="mb-3">' +
                        '<label for="pregunta4" class="form-label">¿Quién escribió "Don Quijote de la Mancha"?</label>' +
                        '<select id="pregunta4" class="form-select" required>' +
                            '<option value="">Selecciona una respuesta</option>' +
                            '<option value="cervantes">Miguel de Cervantes</option>' +
                            '<option value="garcia">Gabriel García Márquez</option>' +
                            '<option value="shakespeare">William Shakespeare</option>' +
                        '</select>' +
                    '</div>' +
                    '<div class="mb-3">' +
                        '<label for="pregunta5" class="form-label">¿Cuál es la capital de Japón?</label>' +
                        '<select id="pregunta5" class="form-select" required>' +
                            '<option value="">Selecciona una respuesta</option>' +
                            '<option value="tokio">Tokio</option>' +
                            '<option value="beijing">Pekín</option>' +
                            '<option value="seul">Seúl</option>' +
                        '</select>' +
                    '</div>' +
                '</form>',
                focusConfirm: false,
                showCancelButton: true,
                confirmButtonText: 'Enviar',
                cancelButtonText: 'Cancelar',
                preConfirm: () => {
                    const respuestas = {
                        pregunta1: document.getElementById('pregunta1').value,
                        pregunta2: document.getElementById('pregunta2').value,
                        pregunta3: document.getElementById('pregunta3').value,
                        pregunta4: document.getElementById('pregunta4').value,
                        pregunta5: document.getElementById('pregunta5').value
                    };
                    return respuestas;
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const respuestas = result.value;
                    validarRespuestas(respuestas);
                }
            });
        }

        function validarRespuestas(respuestas) {
            const respuestasCorrectas = {
                pregunta1: 'paris',
                pregunta2: '4',
                pregunta3: 'pacifico',
                pregunta4: 'cervantes',
                pregunta5: 'tokio'
            };

            let todasCorrectas = true;
            Object.keys(respuestas).forEach(pregunta => {
                if (respuestas[pregunta] !== respuestasCorrectas[pregunta]) {
                    todasCorrectas = false;
                    Swal.fire('Respuesta Incorrecta', `La respuesta para la pregunta ${pregunta} no es correcta. Por favor, revisa nuevamente.`, 'error');
                }
            });

            if (todasCorrectas) {
                Swal.fire('¡Examen Aprobado!', 'Todas las respuestas son correctas.', 'success');
            }
        }
    });
</script>


</body>
</html>

<?php
include 'templates/footer.php';
?>
