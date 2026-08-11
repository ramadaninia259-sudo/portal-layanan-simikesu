<?php

include '../includes/layout/header.php';
include '../includes/layout/navbar.php';

?>

<section class="py-5" style="background:#F8FAFC; min-height:70vh;">

    <div class="container py-5">

        <!-- HEADER -->

        <div class="text-center mb-5">

            <span class="badge bg-primary px-3 py-2 mb-3">
                Layanan Publik SIMIKESU
            </span>

            <h1
                class="fw-bold mb-3"
                style="color:var(--primary);"
            >
                Cek Status Permohonan
            </h1>

            <p class="text-muted">
                Masukkan nomor permohonan Anda untuk melihat
                status pengajuan layanan SIMIKESU.
            </p>

        </div>


        <!-- CARD -->

        <div class="row justify-content-center">

            <div class="col-lg-7 col-md-9">

                <div class="card border-0 shadow-sm rounded-4">

                    <div class="card-body p-4 p-md-5">

                        <div class="text-center mb-4">

                            <div
                                class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3"
                                style="
                                    width:70px;
                                    height:70px;
                                    background:#EAF2FF;
                                "
                            >

                                <i
                                    class="bi bi-search text-primary"
                                    style="font-size:30px;"
                                ></i>

                            </div>

                            <h4 class="fw-bold">
                                Lacak Permohonan
                            </h4>

                            <p class="text-muted mb-0">
                                Gunakan nomor permohonan yang Anda
                                terima setelah pengajuan berhasil.
                            </p>

                        </div>


                        <!-- FORM -->

                        <form
                            action="../api/tracking.php"
                            method="POST"
                        >

                            <div class="mb-4">

                                <label
                                    for="nomor_permohonan"
                                    class="form-label fw-semibold"
                                >
                                    Nomor Permohonan
                                </label>

                                <input
                                    type="text"
                                    class="form-control form-control-lg"
                                    id="nomor_permohonan"
                                    name="nomor_permohonan"
                                    placeholder="Contoh: SIMIKESU-20260809-144850"
                                    required
                                >

                                <div class="form-text">
                                    Masukkan nomor permohonan sesuai
                                    dengan nomor yang diberikan setelah
                                    pengajuan.
                                </div>

                            </div>


                            <div class="d-grid">

                                <button
                                    type="submit"
                                    class="btn btn-primary btn-lg"
                                >

                                    <i class="bi bi-search me-2"></i>

                                    Cek Status Permohonan

                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


<?php

include '../includes/layout/footer.php';

?>