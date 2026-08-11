<?php

/* ===========================================================
   SIMIKESU - CEK STATUS PERMOHONAN
=========================================================== */

require_once '../config/database.php';


/* ===========================================================
   HANYA IZINKAN METHOD POST
=========================================================== */

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    header('Location: ../pages/tracking.php');
    exit;

}


/* ===========================================================
   AMBIL NOMOR PERMOHONAN
=========================================================== */

$nomor_permohonan = isset($_POST['nomor_permohonan'])
    ? trim($_POST['nomor_permohonan'])
    : '';


/* ===========================================================
   VALIDASI
=========================================================== */

if ($nomor_permohonan === '') {

    die('Nomor permohonan wajib diisi.');

}


/* ===========================================================
   CARI DATA PERMOHONAN
=========================================================== */

$sql = "
    SELECT
        id,
        nomor_permohonan,
        tanggal_permohonan,
        nama_pemohon,
        instansi,
        nama_kegiatan,
        kategori,
        lokasi_kegiatan,
        tanggal_kegiatan,
        jam_mulai,
        jam_selesai,
        status,
        catatan_petugas,
        created_at
    FROM tb_permohonan
    WHERE nomor_permohonan = ?
    LIMIT 1
";


$stmt = mysqli_prepare($conn, $sql);


if (!$stmt) {

    die(
        'Gagal menyiapkan query: ' .
        mysqli_error($conn)
    );

}


/* ===========================================================
   BIND NOMOR
=========================================================== */

mysqli_stmt_bind_param(
    $stmt,
    "s",
    $nomor_permohonan
);


/* ===========================================================
   EKSEKUSI
=========================================================== */

if (!mysqli_stmt_execute($stmt)) {

    die(
        'Gagal menjalankan query: ' .
        mysqli_stmt_error($stmt)
    );

}


/* ===========================================================
   AMBIL HASIL
=========================================================== */

$result = mysqli_stmt_get_result($stmt);

$data = mysqli_fetch_assoc($result);


/* ===========================================================
   TUTUP STATEMENT
=========================================================== */

mysqli_stmt_close($stmt);


/* ===========================================================
   JIKA DATA TIDAK DITEMUKAN
=========================================================== */

if (!$data) {

    die(
        'Nomor permohonan ' .
        htmlspecialchars($nomor_permohonan) .
        ' tidak ditemukan.'
    );

}


/* ===========================================================
   STATUS
=========================================================== */

$status = trim($data['status'] ?? '');


if ($status === 'Diterima') {

    $statusClass = 'bg-success';
    $statusIcon = 'bi-check-circle-fill';

} elseif ($status === 'Perbaikan Berkas') {

    $statusClass = 'bg-danger';
    $statusIcon = 'bi-exclamation-circle-fill';

} elseif ($status === 'Menunggu Verifikasi') {

    $statusClass = 'bg-warning text-dark';
    $statusIcon = 'bi-hourglass-split';

} elseif ($status === 'Ditolak') {

    $statusClass = 'bg-dark';
    $statusIcon = 'bi-x-circle-fill';

} else {

    $status = 'Status Belum Ditentukan';

    $statusClass = 'bg-secondary';
    $statusIcon = 'bi-question-circle-fill';

}


/* ===========================================================
   LAYOUT
=========================================================== */

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

                Layanan Publik SIMIKESU

            </span>


            <h1
                class="fw-bold mb-3"
                style="color:var(--primary);"
            >

                Status Permohonan

            </h1>


            <p class="text-muted">

                Berikut informasi status permohonan Anda.

            </p>

        </div>


        <!-- CARD -->

        <div class="row justify-content-center">

            <div class="col-lg-8">

                <div class="card border-0 shadow-sm rounded-4">

                    <div class="card-body p-4 p-md-5">


                        <!-- NOMOR -->

                        <div class="text-center mb-4">

                            <small class="text-muted d-block mb-2">

                                Nomor Permohonan

                            </small>


                            <h4
                                class="fw-bold"
                                style="color:var(--primary);"
                            >

                                <?= htmlspecialchars(
                                    $data['nomor_permohonan']
                                ) ?>

                            </h4>

                        </div>


                        <!-- STATUS -->

                        <div class="text-center mb-5">

                            <small class="text-muted d-block mb-2">

                                Status Permohonan

                            </small>


                            <span
                                class="badge <?= $statusClass ?> px-4 py-2"
                                style="font-size:.95rem;"
                            >

                                <i
                                    class="bi <?= $statusIcon ?> me-2"
                                ></i>

                                <?= htmlspecialchars($status) ?>

                            </span>

                        </div>


                        <!-- DATA PEMOHON -->

                        <h5
                            class="fw-bold mb-3"
                            style="color:var(--primary);"
                        >

                            <i class="bi bi-person-fill me-2"></i>

                            Data Pemohon

                        </h5>


                        <div
                            class="rounded-3 p-4 mb-4"
                            style="
                                background:#F8FAFC;
                                border:1px solid #E5E7EB;
                            "
                        >

                            <div class="row g-3">


                                <div class="col-md-6">

                                    <small class="text-muted">

                                        Nama Pemohon

                                    </small>


                                    <div class="fw-semibold">

                                        <?= htmlspecialchars(
                                            $data['nama_pemohon']
                                        ) ?>

                                    </div>

                                </div>


                                <div class="col-md-6">

                                    <small class="text-muted">

                                        Instansi

                                    </small>


                                    <div class="fw-semibold">

                                        <?= htmlspecialchars(
                                            $data['instansi']
                                        ) ?>

                                    </div>

                                </div>


                            </div>

                        </div>


                        <!-- DATA KEGIATAN -->

                        <h5
                            class="fw-bold mb-3"
                            style="color:var(--primary);"
                        >

                            <i class="bi bi-calendar-event-fill me-2"></i>

                            Data Kegiatan

                        </h5>


                        <div
                            class="rounded-3 p-4 mb-4"
                            style="
                                background:#F8FAFC;
                                border:1px solid #E5E7EB;
                            "
                        >

                            <div class="row g-3">


                                <div class="col-12">

                                    <small class="text-muted">

                                        Nama Kegiatan

                                    </small>


                                    <div class="fw-semibold">

                                        <?= htmlspecialchars(
                                            $data['nama_kegiatan']
                                        ) ?>

                                    </div>

                                </div>


                                <div class="col-md-6">

                                    <small class="text-muted">

                                        Kategori

                                    </small>


                                    <div class="fw-semibold">

                                        <?= htmlspecialchars(
                                            $data['kategori']
                                        ) ?>

                                    </div>

                                </div>


                                <div class="col-md-6">

                                    <small class="text-muted">

                                        Lokasi

                                    </small>


                                    <div class="fw-semibold">

                                        <?= htmlspecialchars(
                                            $data['lokasi_kegiatan']
                                        ) ?>

                                    </div>

                                </div>


                                <div class="col-md-4">

                                    <small class="text-muted">

                                        Tanggal

                                    </small>


                                    <div class="fw-semibold">

                                        <?= htmlspecialchars(
                                            $data['tanggal_kegiatan']
                                        ) ?>

                                    </div>

                                </div>


                                <div class="col-md-4">

                                    <small class="text-muted">

                                        Jam Mulai

                                    </small>


                                    <div class="fw-semibold">

                                        <?= htmlspecialchars(
                                            $data['jam_mulai']
                                        ) ?>

                                    </div>

                                </div>


                                <div class="col-md-4">

                                    <small class="text-muted">

                                        Jam Selesai

                                    </small>


                                    <div class="fw-semibold">

                                        <?= htmlspecialchars(
                                            $data['jam_selesai']
                                        ) ?>

                                    </div>

                                </div>


                            </div>

                        </div>


                        <!-- CATATAN PETUGAS -->

                        <?php if (!empty($data['catatan_petugas'])): ?>


                            <h5
                                class="fw-bold mb-3"
                                style="color:var(--primary);"
                            >

                                <i
                                    class="bi bi-chat-left-text-fill me-2"
                                ></i>

                                Catatan Petugas

                            </h5>


                            <div
                                class="rounded-3 p-4 mb-4"
                                style="
                                    background:#FFF8E1;
                                    border:1px solid #FFE082;
                                "
                            >

                                <?= nl2br(
                                    htmlspecialchars(
                                        $data['catatan_petugas']
                                    )
                                ) ?>

                            </div>


                        <?php endif; ?>


                        <!-- BUTTON -->

                        <div class="text-center mt-4">


                            <a
                                href="../pages/tracking.php"
                                class="btn btn-outline-secondary me-2"
                            >

                                <i class="bi bi-arrow-left me-2"></i>

                                Cek Nomor Lain

                            </a>


                            <a
                                href="../index.php"
                                class="btn btn-primary"
                            >

                                <i class="bi bi-house-fill me-2"></i>

                                Beranda

                            </a>


                        </div>


                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


<?php

include '../includes/layout/footer.php';

?>