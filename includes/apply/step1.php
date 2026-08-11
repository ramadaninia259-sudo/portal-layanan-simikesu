<div class="apply-step-header mb-4">

    <h3 class="fw-bold mb-2">
        Data Pemohon
    </h3>

    <p class="text-muted mb-0">
        Lengkapi data diri pemohon dengan benar sesuai dokumen yang digunakan.
    </p>

</div>


<div class="row g-4">

    <!-- NAMA -->
    <div class="col-md-6">

        <label for="nama_pemohon" class="form-label">
            Nama Lengkap <span class="text-danger">*</span>
        </label>

        <input
            type="text"
            class="form-control"
            id="nama_pemohon"
            name="nama_pemohon"
            placeholder="Masukkan nama lengkap"
            required
        >

    </div>


    <!-- NIK -->
    <div class="col-md-6">

        <label for="nik" class="form-label">
            NIK
        </label>

        <input
            type="text"
            class="form-control"
            id="nik"
            name="nik"
            placeholder="Masukkan NIK"
            maxlength="20"
        >

    </div>


    <!-- INSTANSI -->
    <div class="col-md-6">

        <label for="instansi" class="form-label">
            Instansi / Organisasi <span class="text-danger">*</span>
        </label>

        <input
            type="text"
            class="form-control"
            id="instansi"
            name="instansi"
            placeholder="Masukkan nama instansi atau organisasi"
            required
        >

    </div>


    <!-- JABATAN -->
    <div class="col-md-6">

        <label for="jabatan" class="form-label">
            Jabatan
        </label>

        <input
            type="text"
            class="form-control"
            id="jabatan"
            name="jabatan"
            placeholder="Masukkan jabatan"
        >

    </div>


    <!-- EMAIL -->
    <div class="col-md-6">

        <label for="email" class="form-label">
            Email <span class="text-danger">*</span>
        </label>

        <input
            type="email"
            class="form-control"
            id="email"
            name="email"
            placeholder="contoh@email.com"
            required
        >

    </div>


    <!-- NO HP -->
    <div class="col-md-6">

        <label for="no_hp" class="form-label">
            Nomor HP <span class="text-danger">*</span>
        </label>

        <input
            type="tel"
            class="form-control"
            id="no_hp"
            name="no_hp"
            placeholder="08xxxxxxxxxx"
            required
        >

    </div>


    <!-- ALAMAT -->
    <div class="col-12">

        <label for="alamat" class="form-label">
            Alamat <span class="text-danger">*</span>
        </label>

        <textarea
            class="form-control"
            id="alamat"
            name="alamat"
            rows="4"
            placeholder="Masukkan alamat lengkap"
            required
        ></textarea>

    </div>

</div>


<!-- NAVIGASI -->

<div class="d-flex justify-content-end mt-5">

    <button
        type="button"
        class="btn btn-primary btn-next"
        data-next="2"
    >

        Selanjutnya

        <i class="bi bi-arrow-right ms-2"></i>

    </button>

</div>