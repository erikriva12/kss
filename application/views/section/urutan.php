<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Section</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?= base_url() ?>">Dashboard</a></div>
                <div class="breadcrumb-item">Section</div>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <div class="row w-100">
                        <div class="col-md">
                            <h4>Urutan Section</h4>
                        </div>
                    </div>
                </div>
                <form action="<?= base_url('section/store-urutan') ?>" id="form-urutan">
                    <div class="card-body">
                        <ul class="list-group " id="items">
                            <?php foreach ($data as $key => $val): ?>
                                <li class="list-group-item">
                                    <?= $val->nama_section ?>
                                    <input type="hidden" name="urutan_id[]" value="<?= $val->id ?>">
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="card-footer bg-whitesmoke">
                        <div class="text-right">
                            <div class="btn btn-primary btn-send" onclick="saveUrutan()"><i class="fas fa-save"></i>
                                Simpan
                                Urutan</div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
<script>
    new Sortable(items, {
        animation: 150,
        ghostClass: 'btn-info'
    });
    function saveUrutan() {
        tinymce.triggerSave();
        Swal.fire({
            title: '<i class="fa fa-spin fa-spinner"></i>',
            text: 'Mohon Tunggu Sebentar',
            showConfirmButton: false,
            allowOutsideClick: false
        });
        var form = $('#form-urutan');
        var mydata = new FormData(form[0]);
        $.ajax({
            type: "POST",
            url: form.attr("action"),
            data: mydata,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $(".btn-send").addClass("disabled").html("<i class='la la-spinner la-spin'></i>  Processing...").attr('disabled', true);
                form.find(".show_error").slideUp().html("");
            },
            success: function (response, textStatus, xhr) {
                var res = JSON.parse(response);
                if (res.code == 200) {
                    let timerInterval
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        html: 'Anda akan segera diarahkan ke daftar section',
                        timer: 2000,
                        timerProgressBar: true,
                        showConfirmButton: false,
                        willClose: () => {
                            clearInterval(timerInterval)
                        }
                    }).then((result) => {
                        /* Read more about handling dismissals below */
                        if (result.dismiss === Swal.DismissReason.timer) {
                            window.location.href = "<?= base_url('section') ?>";
                        }
                    })
                }
                else {
                    Swal.fire({
                        title: "Gagal!",
                        html: 'Terjadi kesalahan, coba lagi nanti',
                        icon: "error"
                    });
                    console.log(res);
                }
                console.log(res)
            },
            error: function (xhr, textStatus, errorThrown) {
                console.log(xhr);
                $(".btn-send").removeClass("disabled").html('<i class="fa fa-save"></i> Save').attr('disabled', false);
                form.find(".show_error").hide().html(xhr).slideDown("fast");
            }
        });
    }
</script>