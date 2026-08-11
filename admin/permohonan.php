<?php

require_once 'auth.php';
require_once '../config/database.php';

/* ===========================================================
   FILTER STATUS
=========================================================== */

$statusFilter = isset($_GET['status'])
    ? trim($_GET['status'])
    : '';

/* ===========================================================
   QUERY PERMOHONAN
=========================================================== */

$sql = "
    SELECT
        id,
        nomor_permohonan,
        nama_pemohon,
        instansi,
        nama_kegiatan,
        tanggal_kegiatan,
        status
    FROM tb_permohonan
";

if ($statusFilter !== '') {

    $sql .= "
        WHERE status = ?
        ORDER BY id DESC
    ";

    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        die('Gagal menyiapkan query.');
    }

    mysqli_stmt_bind_param(
        $stmt,
        "s",
        $statusFilter
    );

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

} else {

    $sql .= "
        ORDER BY id DESC
    ";

    $result = mysqli_query($conn, $sql);

}

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
        Data Permohonan - Admin SIMIKESU
    </title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
        rel="stylesheet"
    >

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

        .status-badge {
            display: inline-block;
            padding: 7px 12px;
            border-radius: 8px;
            font-size: .75rem;
            font-weight: 600;
            white-space: nowrap;
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

        .status-kosong {
            background: #E9ECEF;
            color: #6C757D;
        }

        .filter-card {
            border: none;
            border-radius: 18px;
            box-shadow: 0 8px 25px rgba(0,0,0,.06);
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

                <a href="index.php">

                    <i class="bi bi-grid"></i>

                    Dashboard

                </a>

                <a
                    href="permohonan.php"
                    class="active"
                >

                    <i class="bi bi-file-earmark-text"></i>

                    Permohonan

                </a>

                <a href="../index.php">

                    <i class="bi bi-house"></i>

                    Beranda

                    <a href="logout.php">

                        <i class="bi bi-box-arrow-right"></i>

                        Logout

                    </a>

                </a>

            </div>

        </div>


        <!-- CONTENT -->

        <div class="col-lg-10">

            <div class="content">

                <!-- HEADER -->

                <div class="mb-4">

                    <h2 class="page-title">
                        Data Permohonan
                    </h2>

                    <p class="text-muted mb-0">
                        Daftar seluruh permohonan layanan SI MIKE SU.
                    </p>

                </div>


                <!-- FILTER -->

                <div class="card filter-card mb-4">

                    <div class="card-body p-4">

                        <form
                            method="GET"
                            class="row g-3 align-items-end"
                        >

                            <div class="col-md-5">

                                <label class="form-label fw-semibold">
                                    Filter Status
                                </label>

                                <select
                                    name="status"
                                    class="form-select"
                                >

                                    <option value="">
                                        Semua Status
                                    </option>

                                    <option
                                        value="Menunggu Verifikasi"
                                        <?= $statusFilter === 'Menunggu Verifikasi'
                                            ? 'selected'
                                            : '' ?>
                                    >
                                        Menunggu Verifikasi
                                    </option>

                                    <option
                                        value="Perbaikan Berkas"
                                        <?= $statusFilter === 'Perbaikan Berkas'
                                            ? 'selected'
                                            : '' ?>
                                    >
                                        Perbaikan Berkas
                                    </option>

                                    <option
                                        value="Diterima"
                                        <?= $statusFilter === 'Diterima'
                                            ? 'selected'
                                            : '' ?>
                                    >
                                        Diterima
                                    </option>

                                    <option
                                        value="Ditolak"
                                        <?= $statusFilter === 'Ditolak'
                                            ? 'selected'
                                            : '' ?>
                                    >
                                        Ditolak
                                    </option>

                                </select>

                            </div>


                            <div class="col-md-auto">

                                <button
                                    type="submit"
                                    class="btn btn-primary"
                                >

                                    <i class="bi bi-funnel me-1"></i>

                                    Filter

                                </button>

                            </div>


                            <?php if ($statusFilter !== ''): ?>

                                <div class="col-md-auto">

                                    <a
                                        href="permohonan.php"
                                        class="btn btn-outline-secondary"
                                    >

                                        <i class="bi bi-arrow-counterclockwise me-1"></i>

                                        Reset

                                    </a>

                                </div>

                            <?php endif; ?>

                        </form>

                    </div>

                </div>


                <!-- TABLE -->

                <div class="card table-card">

                    <div class="card-body p-4">

                        <div class="table-responsive">

                            <table class="table table-hover align-middle">

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
                                    $result &&
                                    mysqli_num_rows($result) > 0
                                ):

                                    while (
                                        $row = mysqli_fetch_assoc($result)
                                    ):

                                        $status = trim(
                                            $row['status'] ?? ''
                                        );

                                        /* STATUS */

                                        if (
                                            $status === 'Menunggu Verifikasi'
                                        ) {

                                            $statusClass = 'status-menunggu';

                                        } elseif (
                                            $status === 'Perbaikan Berkas'
                                        ) {

                                            $statusClass = 'status-perbaikan';

                                        } elseif (
                                            $status === 'Diterima'
                                        ) {

                                            $statusClass = 'status-diterima';

                                        } elseif (
                                            $status === 'Ditolak'
                                        ) {

                                            $statusClass = 'status-ditolak';

                                        } else {

                                            $statusClass = 'status-kosong';

                                            $status = 'Status Belum Ditentukan';

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
                                                class="status-badge <?= $statusClass ?>"
                                            >

                                                <?= htmlspecialchars(
                                                    $status
                                                ) ?>

                                            </span>

                                        </td>


                                        <td>

                                            <a
                                                href="detail.php?nomor=<?= urlencode(
                                                    $row['nomor_permohonan']
                                                ) ?>"
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
                                            class="text-center py-5 text-muted"
                                        >

                                            <i
                                                class="bi bi-inbox"
                                                style="font-size:40px;"
                                            ></i>

                                            <p class="mt-3 mb-0">
                                                Tidak ada permohonan
                                                dengan status tersebut.
                                            </p>

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