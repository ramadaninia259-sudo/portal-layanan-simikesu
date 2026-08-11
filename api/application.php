<?php

/* ===========================================================
   SIMIKESU - PROSES PENGAJUAN PERMOHONAN
=========================================================== */

require_once '../config/database.php';


/* ===========================================================
   HANYA IZINKAN METHOD POST
=========================================================== */

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    header('Location: ../pages/apply.php');
    exit;

}


/* ===========================================================
   FUNGSI AMBIL DATA
=========================================================== */

function post($name)
{
    return isset($_POST[$name])
        ? trim($_POST[$name])
        : '';
}


/* ===========================================================
   DATA PEMOHON
=========================================================== */

$nama_pemohon = post('nama_pemohon');
$nik          = post('nik');
$instansi     = post('instansi');
$jabatan      = post('jabatan');
$email        = post('email');
$no_hp        = post('no_hp');
$alamat       = post('alamat');


/* ===========================================================
   DATA KEGIATAN
=========================================================== */

$nama_kegiatan    = post('nama_kegiatan');
$kategori         = post('kategori');
$lokasi_kegiatan  = post('lokasi_kegiatan');
$tanggal_kegiatan = post('tanggal_kegiatan');
$jam_mulai        = post('jam_mulai');
$jam_selesai      = post('jam_selesai');
$deskripsi        = post('deskripsi');


/* ===========================================================
   VALIDASI DATA WAJIB
=========================================================== */

$required = [

    'Nama Pemohon'     => $nama_pemohon,
    'Email'            => $email,
    'Nomor HP'         => $no_hp,
    'Alamat'           => $alamat,

    'Nama Kegiatan'    => $nama_kegiatan,
    'Kategori'         => $kategori,
    'Lokasi Kegiatan'  => $lokasi_kegiatan,
    'Tanggal Kegiatan' => $tanggal_kegiatan,
    'Jam Mulai'        => $jam_mulai,
    'Jam Selesai'      => $jam_selesai

];


foreach ($required as $label => $value) {

    if ($value === '') {

        die(
            'Data ' .
            htmlspecialchars($label) .
            ' belum lengkap. Silakan kembali ke form.'
        );

    }

}


/* ===========================================================
   VALIDASI EMAIL
=========================================================== */

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

    die('Format email tidak valid.');

}


/* ===========================================================
   NOMOR PERMOHONAN
=========================================================== */

$nomor_permohonan =
    'SIMIKESU-' .
    date('Ymd-His');


/* ===========================================================
   FOLDER UPLOAD
=========================================================== */

$uploadBase = '../uploads/';


$folders = [

    $uploadBase . 'surat/',
    $uploadBase . 'dokumen/',
    $uploadBase . 'video/',
    $uploadBase . 'gambar/'

];


foreach ($folders as $folder) {

    if (!is_dir($folder)) {

        mkdir($folder, 0777, true);

    }

}


/* ===========================================================
   FUNGSI UPLOAD FILE
=========================================================== */

function uploadFile($fieldName, $folder, $maxSize, $allowedExtensions)
{

    /* -------------------------------------------------------
       TIDAK ADA FILE
    ------------------------------------------------------- */

    if (
        !isset($_FILES[$fieldName]) ||
        $_FILES[$fieldName]['error'] === UPLOAD_ERR_NO_FILE
    ) {

        return null;

    }


    /* -------------------------------------------------------
       ERROR UPLOAD
    ------------------------------------------------------- */

    if ($_FILES[$fieldName]['error'] !== UPLOAD_ERR_OK) {

        die(
            'Terjadi kesalahan saat mengupload file: ' .
            htmlspecialchars($fieldName)
        );

    }


    $file = $_FILES[$fieldName];


    /* -------------------------------------------------------
       VALIDASI UKURAN
    ------------------------------------------------------- */

    if ($file['size'] > $maxSize) {

        $maxMB = round($maxSize / (1024 * 1024));

        die(
            'File ' .
            htmlspecialchars($file['name']) .
            ' terlalu besar. ' .
            'Maksimal ' .
            $maxMB .
            ' MB.'
        );

    }


    /* -------------------------------------------------------
       VALIDASI EXTENSION
    ------------------------------------------------------- */

    $extension = strtolower(
        pathinfo(
            $file['name'],
            PATHINFO_EXTENSION
        )
    );


    if (!in_array($extension, $allowedExtensions, true)) {

        die(
            'Format file ' .
            htmlspecialchars($file['name']) .
            ' tidak diperbolehkan.'
        );

    }


    /* -------------------------------------------------------
       NAMA FILE BARU
    ------------------------------------------------------- */

    $newName =
        uniqid('simikesu_', true) .
        '.' .
        $extension;


    $destination =
        $folder . $newName;


    /* -------------------------------------------------------
       PINDAHKAN FILE
    ------------------------------------------------------- */

    if (
        !move_uploaded_file(
            $file['tmp_name'],
            $destination
        )
    ) {

        die(
            'File ' .
            htmlspecialchars($file['name']) .
            ' gagal disimpan.'
        );

    }


    return $newName;

}


/* ===========================================================
   BATAS FILE
=========================================================== */

/*
   Dokumen : 10 MB
   Gambar  : 10 MB
   Video   : 200 MB
*/

$maxDocumentSize = 10 * 1024 * 1024;

$maxImageSize = 10 * 1024 * 1024;

$maxVideoSize = 200 * 1024 * 1024;


/* ===========================================================
   FORMAT FILE
=========================================================== */

$documentExtensions = [

    'pdf',
    'doc',
    'docx'

];


$imageExtensions = [

    'jpg',
    'jpeg',
    'png'

];


$videoExtensions = [

    'mp4',
    'mov',
    'avi',
    'mkv',
    'webm'

];


/* ===========================================================
   UPLOAD SURAT PERMOHONAN
=========================================================== */

$surat_permohonan = uploadFile(

    'surat_permohonan',

    $uploadBase . 'surat/',

    $maxDocumentSize,

    $documentExtensions

);


/* ===========================================================
   UPLOAD DOKUMEN PENDUKUNG
=========================================================== */

$dokumen_pendukung = uploadFile(

    'dokumen_pendukung',

    $uploadBase . 'dokumen/',

    $maxDocumentSize,

    $documentExtensions

);


/* ===========================================================
   UPLOAD MATERI VIDEO
=========================================================== */

$materi_video = uploadFile(

    'materi_video',

    $uploadBase . 'video/',

    $maxVideoSize,

    $videoExtensions

);


/* ===========================================================
   UPLOAD MATERI GAMBAR
=========================================================== */

$materi_gambar = uploadFile(

    'materi_gambar',

    $uploadBase . 'gambar/',

    $maxImageSize,

    $imageExtensions

);


/* ===========================================================
   STATUS AWAL
=========================================================== */

$status = 'Menunggu Verifikasi';


/* ===========================================================
   QUERY INSERT
=========================================================== */

$sql = "

    INSERT INTO tb_permohonan (

        nomor_permohonan,
        tanggal_permohonan,

        nama_pemohon,
        nik,
        instansi,
        jabatan,
        email,
        no_hp,
        alamat,

        nama_kegiatan,
        kategori,
        lokasi_kegiatan,
        tanggal_kegiatan,
        jam_mulai,
        jam_selesai,
        deskripsi,

        surat_permohonan,
        dokumen_pendukung,
        materi_video,
        materi_gambar,

        status

    )

    VALUES (

        ?,
        CURDATE(),

        ?,
        ?,
        ?,
        ?,
        ?,
        ?,
        ?,

        ?,
        ?,
        ?,
        ?,
        ?,
        ?,
        ?,

        ?,
        ?,
        ?,
        ?,

        ?

    )

";


/* ===========================================================
   PREPARE
=========================================================== */

$stmt = mysqli_prepare($conn, $sql);


if (!$stmt) {

    die(
        'Gagal menyiapkan query database: ' .
        mysqli_error($conn)
    );

}


/* ===========================================================
   BIND DATA
=========================================================== */
mysqli_stmt_bind_param(

    $stmt,

    "ssssssssssssssssssss",

    $nomor_permohonan,

    $nama_pemohon,
    $nik,
    $instansi,
    $jabatan,
    $email,
    $no_hp,
    $alamat,

    $nama_kegiatan,
    $kategori,
    $lokasi_kegiatan,
    $tanggal_kegiatan,
    $jam_mulai,
    $jam_selesai,
    $deskripsi,

    $surat_permohonan,
    $dokumen_pendukung,
    $materi_video,
    $materi_gambar,

    $status

);


/* ===========================================================
   EKSEKUSI
=========================================================== */

if (!mysqli_stmt_execute($stmt)) {

    die(
        'Gagal menyimpan permohonan: ' .
        mysqli_stmt_error($stmt)
    );

}


/* ===========================================================
   TUTUP STATEMENT
=========================================================== */

mysqli_stmt_close($stmt);


/* ===========================================================
   REDIRECT HALAMAN BERHASIL
=========================================================== */

header(
    'Location: ../pages/success.php?nomor=' .
    urlencode($nomor_permohonan)
);

exit;