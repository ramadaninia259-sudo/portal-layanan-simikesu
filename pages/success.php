<?php

$nomor = isset($_GET['nomor'])
    ? htmlspecialchars($_GET['nomor'])
    : '-';

include '../includes/layout/header.php';
include '../includes/layout/navbar.php';

?>

<section class="py-5" style="background:#F8FAFC; min-height:70vh;">

    <div class="container py-5">

        <div class="row justify-content-center">

            <div class="col-lg-7">

                <div class="card border-0 shadow-sm rounded-4">

                    <div class="card-body text-center p-5">

                        <!-- ICON -->

                        <div
                            class="d-inline-flex align-items-center justify-content-center rounded-circle mb-4"
                            style="
                                width:80px;
                                height:80px;
                                background:#E8F5E9;
                            "
                        >

                            <i
                                class="bi bi-check-circle-fill text-success"
                                style="font-size:45px;"
                            ></i>

                        </div>


                        <!-- JUDUL -->

                        <h2
                            class="fw-bold mb-3"
                            style="color:var(--primary);"
                        >

                            Permohonan Berhasil Dikirim

                        </h2>


                        <p class="text-muted mb-4">

                            Permohonan penggunaan Mobil Informasi
                            Keliling Elektronik Sumatera Utara
                            telah berhasil dikirim dan akan diproses
                            oleh petugas.

                        </p>


                        <!-- NOMOR PERMOHONAN -->

                        <div
                            class="rounded-3 p-4 mb-4"
                            style="background:#F8FAFC;"
                        >

                            <small class="text-muted d-block mb-2">

                                Nomor Permohonan

                            </small>

                            <h4
                                class="fw-bold mb-0"
                                style="color:var(--primary);"
                            >

                                <?= $nomor ?>

                            </h4>

                        </div>


                        <!-- STATUS -->

                        <div class="mb-4">

                            <span class="badge bg-warning text-dark px-3 py-2">

                                Menunggu Verifikasi

                            </span>

                        </div>


                        <p class="text-muted small mb-4">

                            Simpan nomor permohonan ini untuk
                            melakukan pengecekan status permohonan
                            Anda.

                        </p>


                        <!-- BUTTON -->

                        <a
                            href="../index.php"
                            class="btn btn-primary px-4 py-2"
                        >

                            <i class="bi bi-house-fill me-2"></i>

                            Kembali ke Beranda

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


<?php

include '../includes/layout/footer.php';

?>