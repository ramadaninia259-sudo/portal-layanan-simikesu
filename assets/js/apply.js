document.addEventListener("DOMContentLoaded", function () {

    const steps = document.querySelectorAll(".apply-step");
    const progressSteps = document.querySelectorAll(".progress-step");
    const progressLines = document.querySelectorAll(".progress-line");

    let currentStep = 1;


    /* =========================================================
       AMBIL NILAI FIELD
    ========================================================= */

    function getFieldValue(names) {

        for (const name of names) {

            const field =
                document.querySelector(`[name="${name}"]`) ||
                document.getElementById(name);

            if (field) {

                return field.value || "";

            }

        }

        return "";

    }


    /* =========================================================
       AMBIL NAMA FILE
    ========================================================= */

    function getFileName(names) {

        for (const name of names) {

            const field =
                document.querySelector(`[name="${name}"]`) ||
                document.getElementById(name);

            if (field && field.files && field.files.length > 0) {

                return field.files[0].name;

            }

        }

        return "";

    }


    /* =========================================================
       TAMPILKAN NILAI KE REVIEW
    ========================================================= */

    function setReview(id, value) {

        const element = document.getElementById(id);

        if (!element) {
            return;
        }

        element.textContent = value && value.trim()
            ? value
            : "-";

    }


    /* =========================================================
       UPDATE DATA KONFIRMASI
    ========================================================= */

    function updateReview() {


        /* =====================================================
           DATA PEMOHON
        ===================================================== */

        setReview(
            "review_nama_pemohon",
            getFieldValue([
                "nama_pemohon",
                "nama_lengkap",
                "nama"
            ])
        );


        setReview(
            "review_nik",
            getFieldValue([
                "nik"
            ])
        );


        setReview(
            "review_instansi",
            getFieldValue([
                "instansi",
                "instansi_organisasi",
                "organisasi"
            ])
        );


        setReview(
            "review_jabatan",
            getFieldValue([
                "jabatan"
            ])
        );


        setReview(
            "review_email",
            getFieldValue([
                "email"
            ])
        );


        setReview(
            "review_no_hp",
            getFieldValue([
                "no_hp",
                "nomor_hp",
                "phone",
                "telepon"
            ])
        );


        setReview(
            "review_alamat",
            getFieldValue([
                "alamat"
            ])
        );


        /* =====================================================
           DATA KEGIATAN
        ===================================================== */

        setReview(
            "review_nama_kegiatan",
            getFieldValue([
                "nama_kegiatan"
            ])
        );


        setReview(
            "review_kategori",
            getFieldValue([
                "kategori",
                "kategori_kegiatan"
            ])
        );


        setReview(
            "review_lokasi_kegiatan",
            getFieldValue([
                "lokasi_kegiatan",
                "lokasi"
            ])
        );


        setReview(
            "review_tanggal_kegiatan",
            getFieldValue([
                "tanggal_kegiatan",
                "tanggal"
            ])
        );


        setReview(
            "review_jam_mulai",
            getFieldValue([
                "jam_mulai"
            ])
        );


        setReview(
            "review_jam_selesai",
            getFieldValue([
                "jam_selesai"
            ])
        );


        setReview(
            "review_deskripsi",
            getFieldValue([
                "deskripsi",
                "deskripsi_kegiatan"
            ])
        );


        /* =====================================================
           DOKUMEN
        ===================================================== */

        setReview(
            "review_surat_permohonan",
            getFileName([
                "surat_permohonan"
            ])
        );


        setReview(
            "review_dokumen_pendukung",
            getFileName([
                "dokumen_pendukung"
            ])
        );


        setReview(
            "review_materi_video",
            getFileName([
                "materi_video"
            ])
        );


        setReview(
            "review_materi_gambar",
            getFileName([
                "materi_gambar"
            ])
        );

    }


    /* =========================================================
       TAMPILKAN STEP
    ========================================================= */

    function showStep(stepNumber) {

        currentStep = stepNumber;


        /* -----------------------------------------------------
           SEMBUNYIKAN SEMUA STEP
        ----------------------------------------------------- */

        steps.forEach(function (step) {

            step.classList.remove("active");

        });


        /* -----------------------------------------------------
           TAMPILKAN STEP AKTIF
        ----------------------------------------------------- */

        const activeStep =
            document.getElementById("step" + stepNumber);

        if (activeStep) {

            activeStep.classList.add("active");

        }


        /* -----------------------------------------------------
           UPDATE PROGRESS
        ----------------------------------------------------- */

        progressSteps.forEach(function (step, index) {

            if (index < stepNumber) {

                step.classList.add("active");

            } else {

                step.classList.remove("active");

            }

        });


        /* -----------------------------------------------------
           UPDATE GARIS
        ----------------------------------------------------- */

        progressLines.forEach(function (line, index) {

            if (index < stepNumber - 1) {

                line.classList.add("active");

            } else {

                line.classList.remove("active");

            }

        });


        /* -----------------------------------------------------
           JIKA MASUK STEP 4
        ----------------------------------------------------- */

        if (stepNumber === 4) {

            updateReview();

        }


        /* -----------------------------------------------------
           SCROLL KE ATAS FORM
        ----------------------------------------------------- */

        const applyCard =
            document.querySelector(".apply-card");

        if (applyCard) {

            applyCard.scrollIntoView({
                behavior: "smooth",
                block: "start"
            });

        }

    }


    /* =========================================================
       VALIDASI STEP
    ========================================================= */

    function validateCurrentStep() {

        const activeStep =
            document.getElementById("step" + currentStep);

        if (!activeStep) {

            return true;

        }


        const fields =
            activeStep.querySelectorAll(
                "input[required], select[required], textarea[required]"
            );


        for (const field of fields) {

            if (!field.checkValidity()) {

                field.reportValidity();

                field.focus();

                return false;

            }

        }


        return true;

    }


    /* =========================================================
       TOMBOL SELANJUTNYA
    ========================================================= */

    document.querySelectorAll(".btn-next").forEach(function (button) {

        button.addEventListener("click", function () {

            if (!validateCurrentStep()) {

                return;

            }


            const nextStep =
                parseInt(button.dataset.next);


            if (nextStep) {

                showStep(nextStep);

            }

        });

    });


    /* =========================================================
       TOMBOL KEMBALI
    ========================================================= */

    document.querySelectorAll(".btn-prev").forEach(function (button) {

        button.addEventListener("click", function () {

            const previousStep =
                parseInt(button.dataset.prev);


            if (previousStep) {

                showStep(previousStep);

            }

        });

    });


    /* =========================================================
       SUBMIT
    ========================================================= */

    const form =
        document.getElementById("applyForm");

    if (form) {

        form.addEventListener("submit", function (event) {

            if (!validateCurrentStep()) {

                event.preventDefault();

                return;

            }

        });

    }


    /* =========================================================
       MULAI DARI STEP 1
    ========================================================= */

    showStep(1);

});