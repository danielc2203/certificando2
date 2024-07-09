
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
    <body class="d-flex flex-column h-100">
        <main class="flex-shrink-0">
            <!-- Header-->
            <header class="py-5">
                <div class="container px-5 pb-5">
                    <div class="row gx-5 align-items-center">
                        <div class="col-xxl-7">
                            <!-- Header text content -->
                            <div class="text-center text-xxl-start">
                                <div ><div class="text-uppercase">Formación &middot; Seguridad &middot; Calidad</div></div>
                                <div class="fs-3 fw-light text-muted">Te ayudamos a obtener Tu certificación en : </div>
                                <h2 class="display-3 fw-bolder mb-3"><span class="text-gradient d-inline"></span>manipulación de alimentos</h2>
                                <div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xxl-start mb-3">
                                    <a class="btn btn-primary btn-lg px-5 py-3 me-sm-3 fs-6 fw-bolder" href="course_overview.html">Ver Curso</a>
                                    <a class="btn btn-outline-dark btn-lg px-5 py-3 fs-6 fw-bolder" href="contact.html">Realizar exámen</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-5">
                            <!-- Header profile picture-->
                            <div class="d-flex justify-content-center mt-5 mt-xxl-0">
                                <div class="profile bg-gradient-primary-to-secondary">
                                    <h1>CERTIFICANDO.COM.CO</h1>                         
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- About Section-->
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
        
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>

<?php
include 'templates/footer.php';
?>