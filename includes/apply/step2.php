<div class="apply-step-header mb-4">

    <h3 class="fw-bold mb-2">
        Data Kegiatan
    </h3>

    <p class="text-muted mb-0">
        Lengkapi informasi kegiatan yang akan menggunakan layanan Mobil Informasi
        Keliling Elektronik Sumatera Utara.
    </p>

</div>


<div class="row g-4">

    <!-- NAMA KEGIATAN -->
    <div class="col-12">

        <label for="nama_kegiatan" class="form-label">
            Nama Kegiatan <span class="text-danger">*</span>
        </label>

        <input
            type="text"
            class="form-control"
            id="nama_kegiatan"
            name="nama_kegiatan"
            placeholder="Masukkan nama kegiatan"
            required
        >

    </div>


    <!-- KATEGORI -->
    <div class="col-md-6">

        <label for="kategori" class="form-label">
            Kategori Kegiatan <span class="text-danger">*</span>
        </label>

        <select
            class="form-select"
            id="kategori"
            name="kategori"
            required
        >

            <option value="" selected disabled>
                Pilih kategori kegiatan
            </option>

            <option value="Pemerintahan">
                Pemerintahan
            </option>

            <option value="Pendidikan">
                Pendidikan
            </option>

            <option value="Kesehatan">
                Kesehatan
            </option>

            <option value="Sosialisasi">
                Sosialisasi
            </option>

            <option value="Pariwisata">
                Pariwisata
            </option>

            <option value="Budaya">
                Budaya
            </option>

            <option value="Lainnya">
                Lainnya
            </option>

        </select>

    </div>


    <!-- LOKASI -->
    <div class="col-md-6">

        <label for="lokasi_kegiatan" class="form-label">
            Lokasi Kegiatan <span class="text-danger">*</span>
        </label>

        <input
            type="text"
            class="form-control"
            id="lokasi_kegiatan"
            name="lokasi_kegiatan"
            placeholder="Contoh: Lapangan Merdeka Medan"
            required
        >

    </div>


    <!-- TANGGAL -->
    <div class="col-md-4">

        <label for="tanggal_kegiatan" class="form-label">
            Tanggal Kegiatan <span class="text-danger">*</span>
        </label>

        <input
            type="date"
            class="form-control"
            id="tanggal_kegiatan"
            name="tanggal_kegiatan"
            required
        >

    </div>


    <!-- JAM MULAI -->
    <div class="col-md-4">

        <label for="jam_mulai" class="form-label">
            Jam Mulai <span class="text-danger">*</span>
        </label>

        <input
            type="time"
            class="form-control"
            id="jam_mulai"
            name="jam_mulai"
            required
        >

    </div>


    <!-- JAM SELESAI -->
    <div class="col-md-4">

        <label for="jam_selesai" class="form-label">
            Jam Selesai <span class="text-danger">*</span>
        </label>

        <input
            type="time"
            class="form-control"
            id="jam_selesai"
            name="jam_selesai"
            required
        >

    </div>


    <!-- DESKRIPSI -->
    <div class="col-12">

        <label for="deskripsi" class="form-label">
            Deskripsi Kegiatan
        </label>

        <textarea
            class="form-control"
            id="deskripsi"
            name="deskripsi"
            rows="5"
            placeholder="Jelaskan secara singkat mengenai kegiatan yang akan dilaksanakan"
        ></textarea>

    </div>

</div>


<!-- NAVIGASI -->

<div class="d-flex justify-content-between mt-5">

    <button
        type="button"
        class="btn btn-outline-secondary btn-prev"
        data-prev="1"
    >

        <i class="bi bi-arrow-left me-2"></i>

        Kembali

    </button>


    <button
        type="button"
        class="btn btn-primary btn-next"
        data-next="3"
    >

        Selanjutnya

        <i class="bi bi-arrow-right ms-2"></i>

    </button>

</div>