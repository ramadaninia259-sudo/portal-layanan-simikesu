<?php

require_once 'auth.php';
require_once '../config/database.php';

/* ===========================================================
   CEK NOMOR PERMOHONAN
=========================================================== */

if (
    !isset($_GET['nomor']) ||
    trim($_GET['nomor']) === ''
) {
    header('Location: permohonan.php');
    exit;
}

$nomor = trim($_GET['nomor']);


/* ===========================================================
   PROSES UPDATE STATUS
=========================================================== */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $status_baru = isset($_POST['status'])
        ? trim($_POST['status'])
        : '';

    $catatan_petugas = isset($_POST['catatan_petugas'])
        ? trim($_POST['catatan_petugas'])
        : '';

    /* STATUS YANG DIIZINKAN */
    $status_valid = [
        'Menunggu Verifikasi',
        'Perbaikan Berkas',
        'Diterima',
        'Ditolak'
    ];

    if (!in_array($status_baru, $status_valid, true)) {
        die('Status permohonan tidak valid.');
    }

    /* UPDATE DATABASE */
    $update = mysqli_prepare(
        $conn,
        "UPDATE tb_permohonan
         SET status = ?, catatan_petugas = ?
         WHERE nomor_permohonan = ?"
    );

    if (!$update) {
        die(
            'Gagal menyiapkan perubahan: ' .
            mysqli_error($conn)
        );
    }

    mysqli_stmt_bind_param(
        $update,
        "sss",
        $status_baru,
        $catatan_petugas,
        $nomor
    );

    if (!mysqli_stmt_execute($update)) {
        die(
            'Gagal menyimpan perubahan: ' .
            mysqli_stmt_error($update)
        );
    }

    mysqli_stmt_close($update);

    /* KEMBALI KE DETAIL */
    header(
        'Location: detail.php?nomor=' .
        urlencode($nomor) .
        '&updated=1'
    );

    exit;
}

/* ===========================================================
   AMBIL DATA PERMOHONAN
=========================================================== */

$stmt = mysqli_prepare(
    $conn,
    "SELECT *
     FROM tb_permohonan
     WHERE nomor_permohonan = ?
     LIMIT 1"
);


if (!$stmt) {

    die(
        'Gagal menyiapkan query: ' .
        mysqli_error($conn)
    );

}


mysqli_stmt_bind_param(
    $stmt,
    "s",
    $nomor
);


mysqli_stmt_execute($stmt);


$result = mysqli_stmt_get_result($stmt);


if (
    !$result ||
    mysqli_num_rows($result) === 0
) {

    die('Data permohonan tidak ditemukan.');

}


$data = mysqli_fetch_assoc($result);


mysqli_stmt_close($stmt);

?>


<!DOCTYPE html>

<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Detail Permohonan - SIMIKESU
    </title>


    <!-- Bootstrap -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >


    <!-- Bootstrap Icons -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
        rel="stylesheet"
    >


    <!-- Google Font -->

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet"
    >


    <style>

        body {
            font-family: 'Poppins', sans-serif;
            background: #F8FAFC;
            color: #212529;
        }


        /* SIDEBAR */

        .sidebar {
            min-height: 100vh;
            background: #0B3D91;
            color: white;
            padding: 25px 20px;
        }


        .sidebar h4 {
            font-weight: 700;
        }


        .sidebar small {
            color: rgba(255,255,255,.75);
        }


        .sidebar a {
            display: flex;
            align-items: center;
            gap: 12px;
            color: white;
            text-decoration: none;
            padding: 12px 15px;
            border-radius: 10px;
            margin-top: 8px;
        }


        .sidebar a:hover,
        .sidebar a.active {
            background: rgba(255,255,255,.15);
        }


        /* CONTENT */

        .content {
            padding: 35px;
        }


        .page-title {
            color: #0B3D91;
            font-weight: 700;
        }


        /* CARD */

        .detail-card {
            border: none;
            border-radius: 18px;
            box-shadow: 0 8px 25px rgba(0,0,0,.06);
        }


        /* SECTION */

        .section-title {
            color: #0B3D91;
            font-weight: 700;
            border-bottom: 1px solid #E5E7EB;
            padding-bottom: 12px;
            margin-bottom: 20px;
        }


        /* DETAIL */

        .detail-label {
            color: #6c757d;
            font-size: .85rem;
            margin-bottom: 3px;
        }


        .detail-value {
            font-weight: 600;
            margin-bottom: 20px;
        }


        /* STATUS */

        .status {
            display: inline-block;
            padding: 8px 14px;
            border-radius: 8px;
            font-weight: 600;
            font-size: .85rem;
        }

        .status-menunggu {
            background: #FFF3CD;
            color: #856404;
        }

        .status-perbaikan {
            background: #FFE5D0;
            color: #9A3412;
        }

        .status-diterima {
            background: #D1E7DD;
            color: #146C43;
        }

        .status-ditolak {
            background: #F8D7DA;
            color: #842029;
        }

        /* FILE */

        .file-box {
            background: #F8FAFC;
            border: 1px solid #E5E7EB;
            border-radius: 10px;
            padding: 12px 15px;
            margin-bottom: 10px;
        }


        /* ALERT */

        .success-alert {
            border: none;
            border-radius: 12px;
            background: #D1E7DD;
            color: #146C43;
        }


    </style>

</head>


<body>


<div class="container-fluid">

    <div class="row">


        <!-- ===================================================
             SIDEBAR
        ==================================================== -->

        <div class="col-lg-2 p-0">

            <div class="sidebar">

                <h4>

                    <i class="bi bi-speedometer2 me-2"></i>

                    SI MIKE SU

                </h4>


                <small>
                    Admin Panel
                </small>


                <hr>


                <!-- DASHBOARD -->

                <a href="index.php">

                    <i class="bi bi-grid"></i>

                    Dashboard

                </a>


                <!-- PERMOHONAN -->

                <a
                    href="permohonan.php"
                    class="active"
                >

                    <i class="bi bi-file-earmark-text"></i>

                    Permohonan

                </a>


                <!-- BERANDA -->

                <a href="../index.php">

                    <i class="bi bi-house"></i>

                    Beranda

                </a>
                <a href="logout.php">

                    <i class="bi bi-box-arrow-right"></i>

                    Logout

                </a>

            </div>

        </div>


        <!-- ===================================================
             CONTENT
        ==================================================== -->

        <div class="col-lg-10">

            <div class="content">


                <!-- HEADER -->

                <div
                    class="d-flex justify-content-between align-items-center mb-4"
                >

                    <div>

                        <h2 class="page-title">

                            Detail Permohonan

                        </h2>


                        <p class="text-muted mb-0">

                            Informasi lengkap permohonan layanan.

                        </p>

                    </div>


                    <a
                        href="permohonan.php"
                        class="btn btn-outline-primary"
                    >

                        <i class="bi bi-arrow-left me-1"></i>

                        Kembali

                    </a>

                </div>


                <!-- PESAN BERHASIL -->

                <?php if (isset($_GET['updated'])): ?>

                    <div
                        class="alert success-alert d-flex align-items-center mb-4"
                    >

                        <i
                            class="bi bi-check-circle-fill me-2"
                        ></i>

                        Status permohonan berhasil diperbarui.

                    </div>

                <?php endif; ?>


                <!-- DETAIL CARD -->

                <div class="card detail-card">

                    <div class="card-body p-4 p-md-5">


                        <!-- NOMOR & STATUS -->

                        <div
                            class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-5"
                        >

                            <div>

                                <div class="detail-label">

                                    Nomor Permohonan

                                </div>


                                <h4 class="fw-bold text-primary">

                                    <?= htmlspecialchars(
                                        $data['nomor_permohonan']
                                    ) ?>

                                </h4>

                            </div>


                            <div>

                                <div class="detail-label">

                                    Status

                                </div>


                                <?php
                                    $statusClass = 'status-menunggu';

                                    if ($data['status'] === 'Perbaikan Berkas') {
                                        $statusClass = 'status-perbaikan';
                                    } elseif ($data['status'] === 'Diterima') {
                                        $statusClass = 'status-diterima';
                                    } elseif ($data['status'] === 'Ditolak') {
                                        $statusClass = 'status-ditolak';
                                    }
                                    ?>

                                    <span class="status <?= $statusClass ?>">

                                        <?= htmlspecialchars($data['status']) ?>

                                    </span>

                            </div>

                        </div>


                        <!-- ===================================================
                             DATA PEMOHON
                        ==================================================== -->

                        <h5 class="section-title">

                            <i class="bi bi-person-fill me-2"></i>

                            Data Pemohon

                        </h5>


                        <div class="row">


                            <div class="col-md-6">

                                <div class="detail-label">
                                    Nama Pemohon
                                </div>

                                <div class="detail-value">

                                    <?= htmlspecialchars(
                                        $data['nama_pemohon']
                                    ) ?>

                                </div>

                            </div>


                            <div class="col-md-6">

                                <div class="detail-label">
                                    NIK
                                </div>

                                <div class="detail-value">

                                    <?= htmlspecialchars(
                                        $data['nik'] ?: '-'
                                    ) ?>

                                </div>

                            </div>


                            <div class="col-md-6">

                                <div class="detail-label">
                                    Instansi
                                </div>

                                <div class="detail-value">

                                    <?= htmlspecialchars(
                                        $data['instansi']
                                    ) ?>

                                </div>

                            </div>


                            <div class="col-md-6">

                                <div class="detail-label">
                                    Jabatan
                                </div>

                                <div class="detail-value">

                                    <?= htmlspecialchars(
                                        $data['jabatan'] ?: '-'
                                    ) ?>

                                </div>

                            </div>


                            <div class="col-md-6">

                                <div class="detail-label">
                                    Email
                                </div>

                                <div class="detail-value">

                                    <?= htmlspecialchars(
                                        $data['email']
                                    ) ?>

                                </div>

                            </div>


                            <div class="col-md-6">

                                <div class="detail-label">
                                    Nomor HP
                                </div>

                                <div class="detail-value">

                                    <?= htmlspecialchars(
                                        $data['no_hp']
                                    ) ?>

                                </div>

                            </div>


                            <div class="col-12">

                                <div class="detail-label">
                                    Alamat
                                </div>

                                <div class="detail-value">

                                    <?= nl2br(
                                        htmlspecialchars(
                                            $data['alamat']
                                        )
                                    ) ?>

                                </div>

                            </div>

                        </div>


                        <!-- ===================================================
                             DATA KEGIATAN
                        ==================================================== -->

                        <h5 class="section-title mt-4">

                            <i class="bi bi-calendar-event-fill me-2"></i>

                            Data Kegiatan

                        </h5>


                        <div class="row">


                            <div class="col-12">

                                <div class="detail-label">
                                    Nama Kegiatan
                                </div>

                                <div class="detail-value">

                                    <?= htmlspecialchars(
                                        $data['nama_kegiatan']
                                    ) ?>

                                </div>

                            </div>


                            <div class="col-md-6">

                                <div class="detail-label">
                                    Kategori
                                </div>

                                <div class="detail-value">

                                    <?= htmlspecialchars(
                                        $data['kategori']
                                    ) ?>

                                </div>

                            </div>


                            <div class="col-md-6">

                                <div class="detail-label">
                                    Lokasi Kegiatan
                                </div>

                                <div class="detail-value">

                                    <?= htmlspecialchars(
                                        $data['lokasi_kegiatan']
                                    ) ?>

                                </div>

                            </div>


                            <div class="col-md-4">

                                <div class="detail-label">
                                    Tanggal
                                </div>

                                <div class="detail-value">

                                    <?= htmlspecialchars(
                                        $data['tanggal_kegiatan']
                                    ) ?>

                                </div>

                            </div>


                            <div class="col-md-4">

                                <div class="detail-label">
                                    Jam Mulai
                                </div>

                                <div class="detail-value">

                                    <?= htmlspecialchars(
                                        $data['jam_mulai']
                                    ) ?>

                                </div>

                            </div>


                            <div class="col-md-4">

                                <div class="detail-label">
                                    Jam Selesai
                                </div>

                                <div class="detail-value">

                                    <?= htmlspecialchars(
                                        $data['jam_selesai']
                                    ) ?>

                                </div>

                            </div>


                            <div class="col-12">

                                <div class="detail-label">
                                    Deskripsi Kegiatan
                                </div>

                                <div class="detail-value">

                                    <?= nl2br(
                                        htmlspecialchars(
                                            $data['deskripsi'] ?: '-'
                                        )
                                    ) ?>

                                </div>

                            </div>

                        </div>


                        <!-- ===================================================
                             DOKUMEN
                        ==================================================== -->

                        <h5 class="section-title mt-4">

                            <i class="bi bi-file-earmark-text-fill me-2"></i>

                            Dokumen & Materi

                        </h5>


                        <div class="row">


                            <!-- SURAT -->

                            <div class="col-md-6">

                                <div class="file-box">

                                    <div class="detail-label">
                                        Surat Permohonan
                                    </div>


                                    <?php if (!empty($data['surat_permohonan'])): ?>

                                        <a
                                            href="../uploads/surat/<?= urlencode(
                                                $data['surat_permohonan']
                                            ) ?>"
                                            target="_blank"
                                        >

                                            <i
                                                class="bi bi-file-earmark-arrow-down me-1"
                                            ></i>

                                            <?= htmlspecialchars(
                                                $data['surat_permohonan']
                                            ) ?>

                                        </a>

                                    <?php else: ?>

                                        -

                                    <?php endif; ?>

                                </div>

                            </div>


                            <!-- DOKUMEN PENDUKUNG -->

                            <div class="col-md-6">

                                <div class="file-box">

                                    <div class="detail-label">
                                        Dokumen Pendukung
                                    </div>


                                    <?php if (!empty($data['dokumen_pendukung'])): ?>

                                        <a
                                            href="../uploads/dokumen/<?= urlencode(
                                                $data['dokumen_pendukung']
                                            ) ?>"
                                            target="_blank"
                                        >

                                            <i
                                                class="bi bi-file-earmark-arrow-down me-1"
                                            ></i>

                                            <?= htmlspecialchars(
                                                $data['dokumen_pendukung']
                                            ) ?>

                                        </a>

                                    <?php else: ?>

                                        -

                                    <?php endif; ?>

                                </div>

                            </div>


                            <!-- VIDEO -->

                            <div class="col-md-6">

                                <div class="file-box">

                                    <div class="detail-label">
                                        Materi Video
                                    </div>


                                    <?php if (!empty($data['materi_video'])): ?>

                                        <a
                                            href="../uploads/video/<?= urlencode(
                                                $data['materi_video']
                                            ) ?>"
                                            target="_blank"
                                        >

                                            <i
                                                class="bi bi-play-circle me-1"
                                            ></i>

                                            <?= htmlspecialchars(
                                                $data['materi_video']
                                            ) ?>

                                        </a>

                                    <?php else: ?>

                                        -

                                    <?php endif; ?>

                                </div>

                            </div>


                            <!-- GAMBAR -->

                            <div class="col-md-6">

                                <div class="file-box">

                                    <div class="detail-label">
                                        Materi Gambar
                                    </div>


                                    <?php if (!empty($data['materi_gambar'])): ?>

                                        <a
                                            href="../uploads/gambar/<?= urlencode(
                                                $data['materi_gambar']
                                            ) ?>"
                                            target="_blank"
                                        >

                                            <i
                                                class="bi bi-image me-1"
                                            ></i>

                                            <?= htmlspecialchars(
                                                $data['materi_gambar']
                                            ) ?>

                                        </a>

                                    <?php else: ?>

                                        -

                                    <?php endif; ?>

                                </div>

                            </div>

                        </div>


                        <!-- ===================================================
                             PROSES PERMOHONAN
                        ==================================================== -->

                        <div class="mt-4 pt-4 border-top">

                            <h5 class="section-title">

                                <i
                                    class="bi bi-pencil-square me-2"
                                ></i>

                                Proses Permohonan

                            </h5>


                            <form
                                method="POST"
                                action="detail.php?nomor=<?= urlencode($nomor) ?>"
                            >


                                <!-- STATUS -->

                                <div class="mb-3">

                                    <label
                                        class="form-label fw-semibold"
                                    >

                                        Status Permohonan

                                    </label>


                                    <select
                                        name="status"
                                        class="form-select"
                                        required
                                    >

                                        <option
                                            value="Menunggu Verifikasi"
                                            <?= $data['status'] === 'Menunggu Verifikasi'
                                                ? 'selected'
                                                : '' ?>
                                        >

                                            Menunggu Verifikasi

                                        </option>


                                        <option
                                            value="Perbaikan Berkas"
                                            <?= $data['status'] === 'Perbaikan Berkas'
                                                ? 'selected'
                                                : '' ?>
                                        >

                                            Perbaikan Berkas

                                        </option>


                                        <option
                                            value="Diterima"
                                            <?= $data['status'] === 'Diterima'
                                                ? 'selected'
                                                : '' ?>
                                        >

                                            Diterima

                                        </option>

                                        <option
                                                value="Ditolak"
                                                <?= $data['status'] === 'Ditolak'
                                                    ? 'selected'
                                                    : '' ?>
                                            >
                                                Ditolak
                                            </option>

                                    </select>

                                </div>


                                <!-- CATATAN -->

                                <div class="mb-4">

                                    <label
                                        class="form-label fw-semibold"
                                    >

                                        Catatan Petugas

                                    </label>


                                    <textarea
                                        name="catatan_petugas"
                                        class="form-control"
                                        rows="4"
                                        placeholder="Masukkan catatan petugas..."
                                    ><?= htmlspecialchars(
                                        $data['catatan_petugas'] ?? ''
                                    ) ?></textarea>

                                </div>


                                <!-- BUTTON -->

                                <div class="d-flex gap-2 flex-wrap">

                                    <button
                                        type="submit"
                                        class="btn btn-primary px-4"
                                    >

                                        <i
                                            class="bi bi-save me-2"
                                        ></i>

                                        Simpan Perubahan

                                    </button>


                                    <a
                                        href="permohonan.php"
                                        class="btn btn-outline-secondary px-4"
                                    >

                                        <i
                                            class="bi bi-arrow-left me-1"
                                        ></i>

                                        Kembali

                                    </a>

                                </div>


                            </form>

                        </div>


                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


</body>

</html>