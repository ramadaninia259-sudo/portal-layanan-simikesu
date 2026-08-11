<?php

require_once __DIR__ . '/../config/database.php';

$message = '';
$messageType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nomor_permohonan = isset($_POST['nomor_permohonan'])
        ? trim($_POST['nomor_permohonan'])
        : '';

    if ($nomor_permohonan === '') {

        $message = 'Nomor permohonan wajib diisi.';
        $messageType = 'danger';

    } else {

        /* CEK NOMOR PERMOHONAN */

        $stmt = mysqli_prepare(
            $conn,
            "SELECT id FROM tb_permohonan WHERE nomor_permohonan = ? LIMIT 1"
        );

        mysqli_stmt_bind_param(
            $stmt,
            "s",
            $nomor_permohonan
        );

        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) === 0) {

            $message = 'Nomor permohonan tidak ditemukan.';
            $messageType = 'danger';

        } else {

            $data = mysqli_fetch_assoc($result);
            $id_permohonan = $data['id'];

            $uploadBase = __DIR__ . '/../uploads/';

            $folders = [
                'video'  => $uploadBase . 'video/',
                'gambar' => $uploadBase . 'gambar/'
            ];

            foreach ($folders as $folder) {

                if (!is_dir($folder)) {
                    mkdir($folder, 0777, true);
                }

            }


            /* UPLOAD VIDEO */

            $videoName = null;

            if (
                isset($_FILES['materi_video']) &&
                $_FILES['materi_video']['error'] !== UPLOAD_ERR_NO_FILE
            ) {

                if ($_FILES['materi_video']['error'] !== UPLOAD_ERR_OK) {

                    $message = 'Video gagal diupload.';
                    $messageType = 'danger';

                } else {

                    $maxVideoSize = 30 * 1024 * 1024;

                    if ($_FILES['materi_video']['size'] > $maxVideoSize) {

                        $message = 'Ukuran video maksimal 30 MB.';
                        $messageType = 'danger';

                    } else {

                        $extension = strtolower(
                            pathinfo(
                                $_FILES['materi_video']['name'],
                                PATHINFO_EXTENSION
                            )
                        );

                        $allowedVideo = [
                            'mp4',
                            'webm',
                            'mov',
                            'avi'
                        ];

                        if (!in_array($extension, $allowedVideo, true)) {

                            $message = 'Format video tidak didukung.';
                            $messageType = 'danger';

                        } else {

                            $videoName =
                                'video_' .
                                time() .
                                '_' .
                                uniqid() .
                                '.' .
                                $extension;

                            $destination =
                                $folders['video'] .
                                $videoName;

                            if (
                                !move_uploaded_file(
                                    $_FILES['materi_video']['tmp_name'],
                                    $destination
                                )
                            ) {

                                $message = 'Video gagal disimpan.';
                                $messageType = 'danger';

                                $videoName = null;
                            }

                        }

                    }

                }

            }


            /* UPLOAD GAMBAR */

            $gambarName = null;

            if (
                $message === '' &&
                isset($_FILES['materi_gambar']) &&
                $_FILES['materi_gambar']['error'] !== UPLOAD_ERR_NO_FILE
            ) {

                if ($_FILES['materi_gambar']['error'] !== UPLOAD_ERR_OK) {

                    $message = 'Gambar gagal diupload.';
                    $messageType = 'danger';

                } else {

                    $maxImageSize = 10 * 1024 * 1024;

                    if ($_FILES['materi_gambar']['size'] > $maxImageSize) {

                        $message = 'Ukuran gambar maksimal 10 MB.';
                        $messageType = 'danger';

                    } else {

                        $extension = strtolower(
                            pathinfo(
                                $_FILES['materi_gambar']['name'],
                                PATHINFO_EXTENSION
                            )
                        );

                        $allowedImage = [
                            'jpg',
                            'jpeg',
                            'png',
                            'webp'
                        ];

                        if (!in_array($extension, $allowedImage, true)) {

                            $message = 'Format gambar tidak didukung.';
                            $messageType = 'danger';

                        } else {

                            $gambarName =
                                'gambar_' .
                                time() .
                                '_' .
                                uniqid() .
                                '.' .
                                $extension;

                            $destination =
                                $folders['gambar'] .
                                $gambarName;

                            if (
                                !move_uploaded_file(
                                    $_FILES['materi_gambar']['tmp_name'],
                                    $destination
                                )
                            ) {

                                $message = 'Gambar gagal disimpan.';
                                $messageType = 'danger';

                                $gambarName = null;
                            }

                        }

                    }

                }

            }


            /* SIMPAN KE DATABASE */

            if (
                $message === '' &&
                ($videoName !== null || $gambarName !== null)
            ) {

                if ($videoName !== null && $gambarName !== null) {

                    $stmt = mysqli_prepare(
                        $conn,
                        "UPDATE tb_permohonan
                         SET materi_video = ?,
                             materi_gambar = ?
                         WHERE id = ?"
                    );

                    mysqli_stmt_bind_param(
                        $stmt,
                        "ssi",
                        $videoName,
                        $gambarName,
                        $id_permohonan
                    );

                } elseif ($videoName !== null) {

                    $stmt = mysqli_prepare(
                        $conn,
                        "UPDATE tb_permohonan
                         SET materi_video = ?
                         WHERE id = ?"
                    );

                    mysqli_stmt_bind_param(
                        $stmt,
                        "si",
                        $videoName,
                        $id_permohonan
                    );

                } else {

                    $stmt = mysqli_prepare(
                        $conn,
                        "UPDATE tb_permohonan
                         SET materi_gambar = ?
                         WHERE id = ?"
                    );

                    mysqli_stmt_bind_param(
                        $stmt,
                        "si",
                        $gambarName,
                        $id_permohonan
                    );

                }


                if (mysqli_stmt_execute($stmt)) {

                    $message =
                        'Materi berhasil diupload dan disimpan.';

                    $messageType = 'success';

                } else {

                    $message =
                        'Materi berhasil diupload, tetapi gagal disimpan ke database: '
                        . mysqli_stmt_error($stmt);

                    $messageType = 'danger';
                }

            } elseif ($message === '') {

                $message =
                    'Silakan pilih minimal satu file untuk diupload.';

                $messageType = 'warning';
            }

        }

    }

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

    <title>Upload Materi - SIMIKESU</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
        rel="stylesheet"
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    >

    <style>

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: #f8fafc;
        }

        .upload-page {
            min-height: 100vh;
            padding: 70px 20px 90px;
        }

        .page-header {
            text-align: center;
            margin-bottom: 45px;
        }

        .page-badge {
            display: inline-block;
            background: #0d6efd;
            color: white;
            padding: 9px 20px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 18px;
        }

        .page-title {
            color: #0b3d91;
            font-size: 42px;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .page-subtitle {
            color: #6b7280;
            font-size: 17px;
        }

        .upload-card {
            max-width: 850px;
            margin: auto;
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 35px rgba(0, 0, 0, .07);
        }

        .upload-title {
            color: #0b3d91;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .form-label {
            font-weight: 600;
        }

        .form-control {
            min-height: 48px;
            border-radius: 10px;
        }

        .upload-box {
            border: 1px dashed #cbd5e1;
            border-radius: 12px;
            padding: 20px;
            background: #f8fafc;
        }

        .upload-icon {
            font-size: 35px;
            color: #0d6efd;
            margin-bottom: 10px;
        }

        .btn-upload {
            background: #0b3d91;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 12px 28px;
            font-weight: 600;
        }

        .btn-upload:hover {
            background: #082f70;
            color: white;
        }

        .btn-back {
            border-radius: 8px;
            padding: 11px 24px;
        }

        @media (max-width: 768px) {

            .page-title {
                font-size: 30px;
            }

            .upload-card {
                padding: 25px 20px;
            }

        }

    </style>

</head>

<body>

<div class="upload-page">

    <!-- HEADER -->

    <div class="page-header">

        <span class="page-badge">
            Layanan Digital
        </span>

        <h1 class="page-title">
            Upload Materi
        </h1>

        <p class="page-subtitle">
            Unggah video atau gambar untuk kebutuhan penayangan
            Mobil Informasi Keliling Elektronik Sumatera Utara.
        </p>

    </div>


    <div class="container">

        <div class="upload-card">

            <h4 class="upload-title">
                <i class="bi bi-cloud-arrow-up-fill me-2"></i>
                Upload Materi Tayang
            </h4>

            <p class="text-muted mb-4">
                Masukkan nomor permohonan yang telah Anda terima,
                kemudian pilih materi yang akan diunggah.
            </p>


            <?php if ($message !== ''): ?>

                <div
                    class="alert alert-<?= htmlspecialchars($messageType) ?>"
                    role="alert"
                >
                    <?= htmlspecialchars($message) ?>
                </div>

            <?php endif; ?>


            <form
                method="POST"
                enctype="multipart/form-data"
            >

                <!-- NOMOR PERMOHONAN -->

                <div class="mb-4">

                    <label
                        for="nomor_permohonan"
                        class="form-label"
                    >
                        Nomor Permohonan
                        <span class="text-danger">*</span>
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        id="nomor_permohonan"
                        name="nomor_permohonan"
                        placeholder="Contoh: SIMIKESU-20260809-144850"
                        required
                    >

                    <div class="form-text">
                        Gunakan nomor permohonan yang diberikan
                        setelah pengajuan berhasil.
                    </div>

                </div>


                <!-- VIDEO -->

                <div class="upload-box mb-4">

                    <div class="text-center">

                        <i class="bi bi-camera-video-fill upload-icon"></i>

                        <h6 class="fw-bold">
                            Materi Video
                        </h6>

                        <p class="text-muted small">
                            Format: MP4, WEBM, MOV, AVI.
                            Maksimal 30 MB.
                        </p>

                    </div>

                    <input
                        type="file"
                        class="form-control"
                        name="materi_video"
                        accept=".mp4,.webm,.mov,.avi"
                    >

                </div>


                <!-- GAMBAR -->

                <div class="upload-box mb-4">

                    <div class="text-center">

                        <i class="bi bi-image-fill upload-icon"></i>

                        <h6 class="fw-bold">
                            Materi Gambar
                        </h6>

                        <p class="text-muted small">
                            Format: JPG, JPEG, PNG, WEBP.
                            Maksimal 10 MB.
                        </p>

                    </div>

                    <input
                        type="file"
                        class="form-control"
                        name="materi_gambar"
                        accept=".jpg,.jpeg,.png,.webp"
                    >

                </div>


                <!-- BUTTON -->

                <div class="d-flex justify-content-between align-items-center">

                    <a
                        href="../index.php"
                        class="btn btn-outline-secondary btn-back"
                    >
                        <i class="bi bi-arrow-left me-2"></i>
                        Kembali
                    </a>


                    <button
                        type="submit"
                        class="btn btn-upload"
                    >
                        <i class="bi bi-cloud-arrow-up me-2"></i>
                        Upload Materi
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

</body>

</html>