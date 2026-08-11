<?php

require_once '../config/database.php';

include '../includes/layout/header.php';
include '../includes/layout/navbar.php';

?>

<!-- CSS KHUSUS APPLY -->
<link rel="stylesheet" href="/simikesu/assets/css/apply.css">


<section class="apply-page">

    <div class="container py-5">


        <!-- HEADER -->

        <div class="text-center mb-5">

            <span class="badge bg-primary px-3 py-2 mb-3">
                Layanan Publik SI MIKE SU
            </span>

            <h1 class="section-title mb-3">
                Ajukan Permohonan
            </h1>

            <p class="section-subtitle mb-0">
                Silakan lengkapi data permohonan penggunaan
                Mobil Informasi Keliling Elektronik Sumatera Utara.
            </p>

        </div>


        <!-- PROGRESS -->

    

        <!-- FORM -->

        <div class="apply-card">

            <form
                id="applyForm"
                action="../api/application.php"
                method="POST"
                enctype="multipart/form-data"
            >

                <!-- STEP 1 -->

                <div
                    class="apply-step active"
                    id="step1"
                >

                    <?php
                    include '../includes/apply/step1.php';
                    ?>

                </div>


                <!-- STEP 2 -->

                <div
                    class="apply-step"
                    id="step2"
                >

                    <?php
                    include '../includes/apply/step2.php';
                    ?>

                </div>


                <!-- STEP 3 -->

                <div
                    class="apply-step"
                    id="step3"
                >

                    <?php
                    include '../includes/apply/step3.php';
                    ?>

                </div>


                <!-- STEP 4 -->

                <div
                    class="apply-step"
                    id="step4"
                >

                    <?php
                    include '../includes/apply/step4.php';
                    ?>

                </div>


            </form>

        </div>

    </div>

</section>


<!-- JAVASCRIPT APPLY -->

<script src="/simikesu/assets/js/apply.js"></script>


<?php

include '../includes/layout/footer.php';

?>