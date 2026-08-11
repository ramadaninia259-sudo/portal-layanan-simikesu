<div class="apply-step-header mb-4">

    <h3 class="fw-bold mb-2">
        Dokumen & Materi
    </h3>

    <p class="text-muted mb-0">
        Upload surat permohonan, dokumen pendukung, dan materi tayangan
        yang diperlukan untuk proses peminjaman Mobil Videotron.
    </p>

</div>


<div class="row g-4">

    <!-- SURAT PERMOHONAN -->
    <div class="col-12">

        <label for="surat_permohonan" class="form-label">
            Surat Permohonan <span class="text-danger">*</span>
        </label>

        <input
            type="file"
            class="form-control"
            id="surat_permohonan"
            name="surat_permohonan"
            accept=".pdf"
            required
        >

        <div class="form-text">
            Format PDF. Surat permohonan wajib dilampirkan.
        </div>

    </div>


    <!-- DOKUMEN PENDUKUNG -->
    <div class="col-12">

        <label for="dokumen_pendukung" class="form-label">
            Dokumen Pendukung
        </label>

        <input
            type="file"
            class="form-control"
            id="dokumen_pendukung"
            name="dokumen_pendukung"
            accept=".pdf,.jpg,.jpeg,.png"
        >

        <div class="form-text">
            Lampirkan dokumen pendukung jika diperlukan.
            Format PDF, JPG, atau PNG.
        </div>

    </div>


    <!-- MATERI VIDEO -->
    <div class="col-md-6">

        <label for="materi_video" class="form-label">
            Materi Video
        </label>

        <input
            type="file"
            class="form-control"
            id="materi_video"
            name="materi_video"
            accept=".mp4,.mov"
        >

        <div class="form-text">
            Materi tayangan dalam format video.
        </div>

    </div>


    <!-- MATERI GAMBAR -->
    <div class="col-md-6">

        <label for="materi_gambar" class="form-label">
            Materi Gambar
        </label>

        <input
            type="file"
            class="form-control"
            id="materi_gambar"
            name="materi_gambar"
            accept=".jpg,.jpeg,.png"
        >

        <div class="form-text">
            Materi tayangan dalam format gambar.
        </div>

    </div>

</div>


<!-- INFORMASI -->

<div class="alert alert-info mt-4">

    <i class="bi bi-info-circle-fill me-2"></i>

    Materi tayangan diserahkan sesuai ketentuan format yang ditetapkan
    dan akan melalui proses pengecekan kelayakan konten sebelum digunakan.

</div>


<!-- NAVIGASI -->

<div class="d-flex justify-content-between mt-5">

    <button
        type="button"
        class="btn btn-outline-secondary btn-prev"
        data-prev="2"
    >

        <i class="bi bi-arrow-left me-2"></i>

        Kembali

    </button>


    <button
        type="button"
        class="btn btn-primary btn-next"
        data-next="4"
    >

        Selanjutnya

        <i class="bi bi-arrow-right ms-2"></i>

    </button>

</div>