<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah User</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="<?= base_url() ?>">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="<?= base_url('user') ?>">User</a></div>
                <div class="breadcrumb-item active">Tambah User
                </div>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <form action="<?= base_url('user/store/') ?>" id="form-user">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><b>Nama User</b></label>
                                    <input type="text" class="form-control" placeholder="Contoh : indra" name="nama">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><b>Email</b></label>
                                    <input type="text" class="form-control" placeholder="Contoh : indra@gmail.com"
                                        name="email">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><b>Username</b></label>
                                    <input type="text" class="form-control" placeholder="Contoh : admin_indra"
                                        name="username">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><b>Password</b></label>
                                    <input type="password" class="form-control" placeholder="xxx" name="password">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><b>Konfirmasi Password</b></label>
                                    <input type="password" class="form-control" placeholder="xxx"
                                        name="konfirmasi_password">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><b>Foto Profil</b></label>
                                    <input type="file" class="form-control" onchange="changeFile('foto-profil')"
                                        id="foto-profil">
                                    <input type="hidden" name="foto_profil" id="input-url-foto-profil">
                                    <div id="res-foto-profil" class="my-1"></div>
                                    <div id="preview-foto-profil" class="my-1"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-whitesmoke">
                        <div class="text-right">
                            <div class="btn btn-primary btn-send" onclick="saveProduk()"><i class="fas fa-save"></i>
                                Simpan User
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
<script>
    function addRowInformasi() {
        var htmls = `<tr>
            <td>
                <input type="text" class="form-control"
                    name="meta[nama_informasi][]"
                    placeholder="Contoh : Ukuran">
            </td>
            <td>
                <textarea class="editor" name="meta[keterangan_informasi][]" placeholder="Contoh : 2x3 Meter"></textarea>
            </td>
            <td class="text-center">
                <div class="btn btn-danger btn-sm"
                    onclick="$(this).parent().parent().remove()">
                    <i class="fas fa-minus"></i>
                </div>
            </td>
        </tr>`;
        $('#table-informasi-tambahan tbody').append(htmls);
        renderEditor();
    }
    function saveProduk() {
        tinymce.triggerSave();
        Swal.fire({
            title: '<i class="fa fa-spin fa-spinner"></i>',
            text: 'Mohon Tunggu Sebentar',
            showConfirmButton: false,
            allowOutsideClick: false
        });
        var form = $('#form-user');
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
                        html: 'Anda akan segera diarahkan ke daftar user',
                        timer: 2000,
                        timerProgressBar: true,
                        showConfirmButton: false,
                        willClose: () => {
                            clearInterval(timerInterval)
                        }
                    }).then((result) => {
                        /* Read more about handling dismissals below */
                        if (result.dismiss === Swal.DismissReason.timer) {
                            window.location.href = "<?= base_url('user') ?>";
                        }
                    })
                }
                else {
                    Swal.fire({
                        title: "Gagal!",
                        html: res.message,
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
    var count_foto = 0;
    function addRowFoto() {
        count_foto++;
        var htmls = `<tr>
            
            <td>
                <input type="file" class="form-control"
                    onchange="changeFile('file-`+ count_foto + `')"
                    id="file-`+ count_foto + `">
                <input type="hidden" name="foto[]"
                    id="input-url-file-`+ count_foto + `">
                <div id="res-file-`+ count_foto + `"></div>
                <div id="preview-file-`+ count_foto + `" class="my-1">
                    
                </div>
            </td>
            
            <td class="text-center">
                <div class="btn btn-danger btn-sm"
                    onclick="$(this).parent().parent().remove()">
                    <i class="fas fa-minus"></i>
                </div>
            </td>
        </tr>`;
        $('#table-foto tbody').append(htmls);
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
            url: "<?= base_url('produk/upload-file') ?>",
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