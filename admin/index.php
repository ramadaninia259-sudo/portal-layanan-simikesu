<?php

require_once 'auth.php';
require_once '../config/database.php';

// kode dashboard kamu...

/* ===========================================================
   DATA DASHBOARD
=========================================================== */

$total = 0;
$menunggu = 0;
$perbaikan = 0;
$diterima = 0;


/* ===========================================================
   HITUNG DATA BERDASARKAN STATUS
=========================================================== */

$queryStatus = mysqli_query(
    $conn,
    "SELECT
        COUNT(*) AS total,
        SUM(TRIM(status) = 'Menunggu Verifikasi') AS menunggu,
        SUM(TRIM(status) = 'Perbaikan Berkas') AS perbaikan,
        SUM(TRIM(status) = 'Diterima') AS diterima
     FROM tb_permohonan"
);


if ($queryStatus) {

    $dataStatus = mysqli_fetch_assoc($queryStatus);

    $total = (int) $dataStatus['total'];

    $menunggu = (int) ($dataStatus['menunggu'] ?? 0);

    $perbaikan = (int) ($dataStatus['perbaikan'] ?? 0);

    $diterima = (int) ($dataStatus['diterima'] ?? 0);

}


/* ===========================================================
   DATA PERMOHONAN TERBARU
=========================================================== */

$queryPermohonan = mysqli_query(
    $conn,
    "SELECT
        id,
        nomor_permohonan,
        nama_pemohon,
        instansi,
        nama_kegiatan,
        tanggal_kegiatan,
        status
     FROM tb_permohonan
     ORDER BY id DESC
     LIMIT 10"
);

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Admin - SIMIKESU</title>


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


        .content {

            padding: 35px;

        }


        .page-title {

            color: #0B3D91;

            font-weight: 700;

        }


        .stat-card {

            border: none;

            border-radius: 18px;

            box-shadow: 0 8px 25px rgba(0,0,0,.06);

        }


        .stat-icon {

            width: 55px;

            height: 55px;

            border-radius: 14px;

            display: flex;

            align-items: center;

            justify-content: center;

            background: #EAF2FF;

            color: #0B3D91;

            font-size: 1.5rem;

        }


        .stat-number {

            font-size: 1.8rem;

            font-weight: 700;

            color: #0B3D91;

        }


        .table-card {

            border: none;

            border-radius: 18px;

            box-shadow: 0 8px 25px rgba(0,0,0,.06);

        }


        .table th {

            color: #0B3D91;

            font-weight: 600;

            white-space: nowrap;

        }


        .table td {

            vertical-align: middle;

        }


        .badge-status {

            padding: 7px 10px;

            border-radius: 8px;

            font-size: .75rem;

        }

    </style>

</head>


<body>


<div class="container-fluid">

    <div class="row">


        <!-- SIDEBAR -->

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


                <a
                    href="index.php"
                    class="active"
                >

                    <i class="bi bi-grid"></i>

                    Dashboard

                </a>


                <a
                    href="permohonan.php"
                >

                    <i class="bi bi-file-earmark-text"></i>

                    Permohonan

                </a>


                <a
                    href="../index.php"
                >

                    <i class="bi bi-house"></i>

                    Beranda

                </a>
                <a href="logout.php">

                    <i class="bi bi-box-arrow-right"></i>

                    Logout

                </a>


            </div>

        </div>


        <!-- CONTENT -->

        <div class="col-lg-10">

            <div class="content">


                <!-- HEADER -->

                <div class="mb-4">

                    <h2 class="page-title">

                        Dashboard Admin

                    </h2>


                    <p class="text-muted mb-0">

                        Kelola dan pantau permohonan layanan
                        SI MIKE SU.

                    </p>

                </div>


                <!-- STATISTIK -->

                <div class="row g-4 mb-5">


                    <!-- TOTAL -->

                    <div class="col-md-6 col-xl-3">

                        <div class="card stat-card">

                            <div class="card-body">

                                <div class="d-flex justify-content-between align-items-center">

                                    <div>

                                        <small class="text-muted">

                                            Total Permohonan

                                        </small>


                                        <div class="stat-number">

                                            <?= $total ?>

                                        </div>

                                    </div>


                                    <div class="stat-icon">

                                        <i class="bi bi-file-earmark-text"></i>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    <!-- MENUNGGU -->

                    <div class="col-md-6 col-xl-3">

                        <div class="card stat-card">

                            <div class="card-body">

                                <div class="d-flex justify-content-between align-items-center">

                                    <div>

                                        <small class="text-muted">

                                            Menunggu Verifikasi

                                        </small>


                                        <div class="stat-number">

                                            <?= $menunggu ?>

                                        </div>

                                    </div>


                                    <div class="stat-icon">

                                        <i class="bi bi-hourglass-split"></i>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    <!-- PERBAIKAN -->

                    <div class="col-md-6 col-xl-3">

                        <div class="card stat-card">

                            <div class="card-body">

                                <div class="d-flex justify-content-between align-items-center">

                                    <div>

                                        <small class="text-muted">

                                            Perbaikan Berkas

                                        </small>


                                        <div class="stat-number">

                                            <?= $perbaikan ?>

                                        </div>

                                    </div>


                                    <div class="stat-icon">

                                        <i class="bi bi-exclamation-circle"></i>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    <!-- DITERIMA -->

                    <div class="col-md-6 col-xl-3">

                        <div class="card stat-card">

                            <div class="card-body">

                                <div class="d-flex justify-content-between align-items-center">

                                    <div>

                                        <small class="text-muted">

                                            Diterima

                                        </small>


                                        <div class="stat-number">

                                            <?= $diterima ?>

                                        </div>

                                    </div>


                                    <div class="stat-icon">

                                        <i class="bi bi-check-circle"></i>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                </div>


                <!-- DATA TERBARU -->

                <div class="card table-card">

                    <div class="card-body p-4">


                        <div class="d-flex justify-content-between align-items-center mb-4">

                            <div>

                                <h5 class="fw-bold mb-1">

                                    Permohonan Terbaru

                                </h5>


                                <small class="text-muted">

                                    10 permohonan terakhir

                                </small>

                            </div>

                        </div>


                        <div class="table-responsive">


                            <table class="table table-hover">

                                <thead>

                                    <tr>

                                        <th>No.</th>

                                        <th>Nomor Permohonan</th>

                                        <th>Pemohon</th>

                                        <th>Instansi</th>

                                        <th>Kegiatan</th>

                                        <th>Tanggal</th>

                                        <th>Status</th>

                                        <th>Aksi</th>

                                    </tr>

                                </thead>


                                <tbody>


                                <?php

                                $no = 1;

                                if (
                                    $queryPermohonan &&
                                    mysqli_num_rows($queryPermohonan) > 0
                                ):

                                    while (
                                        $row = mysqli_fetch_assoc($queryPermohonan)
                                    ):

                                        $status = trim($row['status']);


                                        /* Tentukan warna status */

                                        if ($status === 'Diterima') {

                                            $badgeClass = 'bg-success';

                                        } elseif ($status === 'Perbaikan Berkas') {

                                            $badgeClass = 'bg-danger';

                                        } elseif ($status === 'Menunggu Verifikasi') {

                                            $badgeClass = 'bg-warning text-dark';

                                        } else {

                                            $badgeClass = 'bg-secondary';

                                        }

                                ?>


                                    <tr>


                                        <td>

                                            <?= $no++ ?>

                                        </td>


                                        <td>

                                            <strong>

                                                <?= htmlspecialchars(
                                                    $row['nomor_permohonan']
                                                ) ?>

                                            </strong>

                                        </td>


                                        <td>

                                            <?= htmlspecialchars(
                                                $row['nama_pemohon']
                                            ) ?>

                                        </td>


                                        <td>

                                            <?= htmlspecialchars(
                                                $row['instansi']
                                            ) ?>

                                        </td>


                                        <td>

                                            <?= htmlspecialchars(
                                                $row['nama_kegiatan']
                                            ) ?>

                                        </td>


                                        <td>

                                            <?= htmlspecialchars(
                                                $row['tanggal_kegiatan']
                                            ) ?>

                                        </td>


                                        <td>

                                            <span
                                                class="badge <?= $badgeClass ?> badge-status"
                                            >

                                                <?= htmlspecialchars(
                                                    $status
                                                ) ?>

                                            </span>

                                        </td>


                                        <td>

                                            <a
                                                href="detail.php?nomor=<?= urlencode($row['nomor_permohonan']) ?>"
                                                class="btn btn-sm btn-outline-primary"
                                            >

                                                <i class="bi bi-eye me-1"></i>

                                                Detail

                                            </a>

                                        </td>


                                    </tr>


                                <?php

                                    endwhile;

                                else:

                                ?>


                                    <tr>

                                        <td
                                            colspan="8"
                                            class="text-center text-muted py-4"
                                        >

                                            Belum ada data permohonan.

                                        </td>

                                    </tr>


                                <?php endif; ?>


                                </tbody>

                            </table>


                        </div>

                    </div>

                </div>


            </div>

        </div>


    </div>

</div>


</body>

</html>