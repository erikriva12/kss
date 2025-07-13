<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Testimonial</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="<?= base_url() ?>">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="<?= base_url('testimonial') ?>">Testimonial</a></div>
                <div class="breadcrumb-item active">Tambah Testimonial
                </div>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <form action="<?= base_url('testimonial/store/') ?>" id="form-testimonial">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><b>Nama</b></label>
                                    <input type="text" class="form-control" placeholder="Jhon" name="nama">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><b>Foto</b></label>
                                    <input type="file" class="form-control" onchange="changeFile('foto-about')"
                                        id="foto-about">
                                    <input type="hidden" name="foto" id="input-url-foto-about">
                                    <div id="res-foto-about" class="my-1"></div>
                                    <div id="preview-foto-about" class="my-1">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><b>Perusahaan</b></label>
                                    <input type="text" class="form-control" placeholder="KSS" name="perusahaan">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><b>Isi Testimonial</b></label>
                                    <textarea class="editor" name="isi_testimonial"></textarea>

                                </div>
                            </div>


                        </div>
                        <div class="card-footer bg-whitesmoke">
                            <div class="text-right">
                                <div class="btn btn-primary btn-send" onclick="saveTestimonial()"><i
                                        class="fas fa-save"></i>
                                    Simpan Testimonial
                                </div>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </section>
</div>
<script>
    $(document).ready(function () {
        renderEditor();
    });
    function saveTestimonial() {
        tinymce.triggerSave();
        Swal.fire({
            title: '<i class="fa fa-spin fa-spinner"></i>',
            text: 'Mohon Tunggu Sebentar',
            showConfirmButton: false,
            allowOutsideClick: false
        });
        var form = $('#form-testimonial');
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
                        html: 'Anda akan segera diarahkan ke daftar testimonial',
                        timer: 2000,
                        timerProgressBar: true,
                        showConfirmButton: false,
                        willClose: () => {
                            clearInterval(timerInterval)
                        }
                    }).then((result) => {
                        /* Read more about handling dismissals below */
                        if (result.dismiss === Swal.DismissReason.timer) {
                            window.location.href = "<?= base_url('testimonial') ?>";
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

    function previewImage(idfile, url) {
        var htmls = `<img src="<?= base_url() ?>` + url + `" class="img-responsive" style="height: 150px;">`;
        $('#preview-' + idfile).html(htmls);
    }
    function changeFile(idfile) {
        var mydata = new FormData();
        mydata.append('file', $('#' + idfile)[0].files[0]);
        $.ajax({
            type: "POST",
            url: "<?= base_url('testimonial/upload-file') ?>",
            data: mydata,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $('#res-' + idfile).html(`<div class="btn btn-warning btn-sm"><i class="fa fa-spin fa-spinner"></i> Tunggu Sebentar</div>`);
            },
            success: function (response, textStatus, xhr) {
                // alert(mydata);
                var res = JSON.parse(response);
                console.log('res')
                if (res.code == 200) {
                    $('#input-url-' + idfile).val(res.url);
                    $('#res-' + idfile).html(`
                        <div class="btn btn-success btn-sm"><i class="fas fa-check"></i> Berhasil</div>
                    `);
                    previewImage(idfile, res.url);
                } else {
                    $('#res-' + idfile).html('');
                    Swal.fire({
                        title: "Gagal!",
                        html: 'Terjadi kesalahan, coba lagi nanti',
                        icon: "error"
                    });
                    console.log(res);
                }
            },
            error: function (xhr, textStatus, errorThrown) {
                console.log(xhr.responseText);
                Swal.fire({
                    title: "Gagal!",
                    text: "Gagal Upload File",
                    icon: "error"
                });
                $('#res-' + idfile).html('');
            }
        });
        return false;
    }
</script>