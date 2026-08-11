<?php include '../includes/layout/header.php'; ?>
<?php include '../includes/layout/navbar.php'; ?>


<section id="contact">

    <div class="container py-5">

        <!-- HEADER -->

        <div class="text-center mb-5">

            <span class="badge bg-primary px-3 py-2 mb-3">
                SI MIKE SU
            </span>

            <h1
                class="fw-bold mb-3"
                style="color:var(--primary);"
            >
                Hubungi Kami
            </h1>

            <p
                class="text-muted mx-auto"
                style="max-width:800px;"
            >
                Hubungi Dinas Komunikasi dan Informatika Provinsi
                Sumatera Utara untuk memperoleh informasi lebih lanjut
                mengenai layanan SIMIKESU.
            </p>

        </div>


        <div class="row g-4">

            <!-- INFORMASI KONTAK -->

            <div class="col-lg-5">

                <div class="card border-0 shadow-sm rounded-4 h-100">

                    <div class="card-body p-4 p-md-5">

                        <h4
                            class="fw-bold mb-4"
                            style="color:var(--primary);"
                        >
                            Informasi Kontak
                        </h4>


                        <!-- ALAMAT -->

                        <div class="d-flex mb-4">

                            <div
                                class="d-flex align-items-center justify-content-center rounded-circle me-3 flex-shrink-0"
                                style="
                                    width:48px;
                                    height:48px;
                                    background:#EAF2FF;
                                "
                            >

                                <i class="bi bi-geo-alt-fill text-primary"></i>

                            </div>

                            <div>

                                <small class="text-muted d-block">
                                    Alamat
                                </small>

                                <span class="fw-semibold">
                                    Jl. HM. Said No.27, Gaharu, Kec. Medan Tim., Kota Medan, Sumatera Utara 20233
                                </span>

                            </div>

                        </div>


                        <!-- EMAIL -->

                        <div class="d-flex mb-4">

                            <div
                                class="d-flex align-items-center justify-content-center rounded-circle me-3 flex-shrink-0"
                                style="
                                    width:48px;
                                    height:48px;
                                    background:#EAF2FF;
                                "
                            >

                                <i class="bi bi-envelope-fill text-primary"></i>

                            </div>

                            <div>

                                <small class="text-muted d-block">
                                    Email
                                </small>

                                <a
                                    href="mailto:diskominfo@sumutprov.go.id"
                                    class="fw-semibold text-dark"
                                >
                                    diskominfo@sumutprov.go.id
                                </a>

                            </div>

                        </div>


                        <!-- WHATSAPP -->

                        <div class="d-flex mb-4">

                            <div
                                class="d-flex align-items-center justify-content-center rounded-circle me-3 flex-shrink-0"
                                style="
                                    width:48px;
                                    height:48px;
                                    background:#EAF2FF;
                                "
                            >

                                <i class="bi bi-whatsapp text-primary"></i>

                            </div>

                            <div>

                                <small class="text-muted d-block">
                                    WhatsApp
                                </small>

                                <a
                                    href="https://wa.me/6285172111109"
                                    target="_blank"
                                    class="fw-semibold text-dark"
                                >
                                    0851 7211 1109
                                </a>

                            </div>

                        </div>


                        <!-- JAM LAYANAN -->

                        <div class="d-flex">

                            <div
                                class="d-flex align-items-center justify-content-center rounded-circle me-3 flex-shrink-0"
                                style="
                                    width:48px;
                                    height:48px;
                                    background:#EAF2FF;
                                "
                            >

                                <i class="bi bi-clock-fill text-primary"></i>

                            </div>

                            <div>

                                <small class="text-muted d-block">
                                    Jam Layanan
                                </small>

                                <span class="fw-semibold">
                                    Senin – Jumat, 08.00 – 16.00 WIB
                                </span>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <!-- INFORMASI LAYANAN -->

            <div class="col-lg-7">

                <div class="card border-0 shadow-sm rounded-4 h-100">

                    <div class="card-body p-4 p-md-5">

                        <h4
                            class="fw-bold mb-2"
                            style="color:var(--primary);"
                        >
                            Informasi Layanan
                        </h4>

                        <p
                            class="text-muted mb-4"
                            style="line-height:1.7;"
                        >
                            Untuk pertanyaan mengenai penggunaan
                            Mobil Informasi Keliling Elektronik,
                            persyaratan, atau proses permohonan,
                            silakan menghubungi kami melalui
                            informasi kontak yang tersedia.
                        </p>


                        <!-- PERHATIAN -->

                        <div
                            class="rounded-4 p-4 mb-4"
                            style="
                                background:#F8FAFC;
                                border:1px solid #E5E7EB;
                            "
                        >

                            <div class="d-flex">

                                <i
                                    class="bi bi-info-circle-fill text-primary me-3 fs-5"
                                ></i>

                                <div>

                                    <strong>
                                        Perhatian
                                    </strong>

                                    <p
                                        class="text-muted mb-0 mt-2"
                                        style="line-height:1.7;"
                                    >
                                        Pastikan Anda telah memiliki
                                        nomor permohonan apabila ingin
                                        menanyakan perkembangan
                                        pengajuan yang telah dikirim.
                                    </p>

                                </div>

                            </div>

                        </div>


                        <!-- BUTTON -->

                        <div class="d-flex flex-wrap gap-2">

                            <a
                                href="https://wa.me/6285172111109"
                                target="_blank"
                                class="btn btn-primary px-4"
                            >

                                <i class="bi bi-whatsapp me-2"></i>

                                Hubungi WhatsApp

                            </a>


                            <a
                                href="../api/tracking.php"
                                class="btn btn-outline-primary px-4"
                            >

                                <i class="bi bi-search me-2"></i>

                                Cek Status

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


<?php include '../includes/layout/footer.php'; ?>