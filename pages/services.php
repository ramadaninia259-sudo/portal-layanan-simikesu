<?php

include '../includes/layout/header.php';
include '../includes/layout/navbar.php';

?>

<section
    class="py-5"
    style="background:#F8FAFC; min-height:70vh;"
>

    <div class="container py-5">

        <!-- HEADER -->

        <div class="text-center mb-5">

            <span class="badge bg-primary px-3 py-2 mb-3">
                Layanan SIMIKESU
            </span>

            <h1
                class="fw-bold mb-3"
                style="color:var(--primary);"
            >
                Layanan Publik
            </h1>

            <p
                class="text-muted mx-auto"
                style="max-width:800px;"
            >
                Pilih layanan yang tersedia untuk memperoleh informasi
                atau mengajukan penggunaan Mobil Informasi Keliling
                Elektronik Sumatera Utara.
            </p>

        </div>


        <!-- DAFTAR LAYANAN -->

        <div class="row g-4 justify-content-center">

            <!-- AJUKAN PERMOHONAN -->

            <div class="col-lg-4 col-md-6">

                <div
                    class="card border-0 shadow-sm rounded-4 h-100"
                >

                    <div class="card-body p-4">

                        <div
                            class="d-flex align-items-center justify-content-center rounded-circle mb-4"
                            style="
                                width:65px;
                                height:65px;
                                background:#EAF2FF;
                            "
                        >

                            <i
                                class="bi bi-file-earmark-plus-fill text-primary"
                                style="font-size:28px;"
                            ></i>

                        </div>

                        <h4 class="fw-bold mb-3">
                            Ajukan Permohonan
                        </h4>

                        <p
                            class="text-muted"
                            style="line-height:1.7;"
                        >
                            Ajukan penggunaan Mobil Informasi Keliling
                            Elektronik secara online dengan mengisi
                            data permohonan dan dokumen yang diperlukan.
                        </p>

                        <a
                            href="apply.php"
                            class="btn btn-primary"
                        >

                            Ajukan Sekarang

                            <i class="bi bi-arrow-right ms-2"></i>

                        </a>

                    </div>

                </div>

            </div>


            <!-- CEK STATUS -->

            <div class="col-lg-4 col-md-6">

                <div
                    class="card border-0 shadow-sm rounded-4 h-100"
                >

                    <div class="card-body p-4">

                        <div
                            class="d-flex align-items-center justify-content-center rounded-circle mb-4"
                            style="
                                width:65px;
                                height:65px;
                                background:#EAF2FF;
                            "
                        >

                            <i
                                class="bi bi-search text-primary"
                                style="font-size:28px;"
                            ></i>

                        </div>

                        <h4 class="fw-bold mb-3">
                            Cek Status
                        </h4>

                        <p
                            class="text-muted"
                            style="line-height:1.7;"
                        >
                            Periksa status permohonan Anda menggunakan
                            nomor permohonan yang diperoleh setelah
                            pengajuan berhasil.
                        </p>

                        <a
                            href="tracking.php"
                            class="btn btn-outline-primary"
                        >

                            Cek Status

                            <i class="bi bi-arrow-right ms-2"></i>

                        </a>

                    </div>

                </div>

            </div>


            <!-- INFORMASI LAYANAN -->

            <div class="col-lg-4 col-md-6">

                <div
                    class="card border-0 shadow-sm rounded-4 h-100"
                >

                    <div class="card-body p-4">

                        <div
                            class="d-flex align-items-center justify-content-center rounded-circle mb-4"
                            style="
                                width:65px;
                                height:65px;
                                background:#EAF2FF;
                            "
                        >

                            <i
                                class="bi bi-info-circle-fill text-primary"
                                style="font-size:28px;"
                            ></i>

                        </div>

                        <h4 class="fw-bold mb-3">
                            Informasi Layanan
                        </h4>

                        <p
                            class="text-muted"
                            style="line-height:1.7;"
                        >
                            Dapatkan informasi mengenai prosedur,
                            persyaratan, jadwal, dan ketentuan
                            penggunaan layanan SIMIKESU.
                        </p>

                        <a
                            href="requirements.php"
                            class="btn btn-outline-primary"
                        >

                            Lihat Informasi

                            <i class="bi bi-arrow-right ms-2"></i>

                        </a>

                    </div>

                </div>

            </div>

        </div>


        <!-- INFORMASI TAMBAHAN -->

        <div
            class="rounded-4 mt-5 p-4 p-md-5"
            style="
                background:#ffffff;
                box-shadow:0 8px 30px rgba(0,0,0,.06);
            "
        >

            <div class="row align-items-center g-4">

                <div class="col-lg-8">

                    <h3
                        class="fw-bold mb-2"
                        style="color:var(--primary);"
                    >
                        Butuh bantuan?
                    </h3>

                    <p
                        class="text-muted mb-0"
                        style="line-height:1.7;"
                    >
                        Pastikan Anda telah membaca persyaratan
                        layanan sebelum mengajukan permohonan.
                        Jika membutuhkan informasi lebih lanjut,
                        silakan hubungi kami melalui halaman kontak.

                    </p>

                </div>

                <div class="col-lg-4 text-lg-end">

                    <a
                        href="contact.php"
                        class="btn btn-primary px-4"
                    >

                        <i class="bi bi-telephone-fill me-2"></i>

                        Hubungi Kami

                    </a>

                </div>

            </div>

        </div>

    </div>

</section>


<?php

include '../includes/layout/footer.php';

?>