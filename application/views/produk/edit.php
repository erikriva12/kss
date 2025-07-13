<?php
$datameta = json_decode($data->meta);
$datafoto = json_decode($data->foto_json);
?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Produk</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="<?= base_url() ?>">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="<?= base_url('produk') ?>">Produk</a></div>
                <div class="breadcrumb-item active">Edit Produk
                </div>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <form action="<?= base_url('produk/update-produk/') ?>" id="form-produk">
                    <input type="hidden" name="id" value="<?= $data->id ?>">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><b>Nama Produk</b></label>
                                    <input type="text" class="form-control" placeholder="Alumunium" name="nama"
                                        value="<?= $data->nama ?>">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><b>Kategori Produk</b></label>
                                    <select class="form-control select2" style="width: 100%" name="kategori_id">
                                        <option value="">-- Pilih --</option>
                                        <?php foreach ($kategori as $key => $value)
                                        { ?>
                                            <option value="<?= $value->id ?>" <?= ($data->kategori_produk_id == $value->id) ? 'selected' : '' ?>><?= $value->nama ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><b>Informasi Produk</b></label>
                                    <textarea class="editor" name="informasi"><?= $data->informasi ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><b>Informasi Tambahan</b></label>
                                    <table class="table table-bordered table-striped table-hover table-sm"
                                        id="table-informasi-tambahan">
                                        <thead class="bg-info text-white text-center">
                                            <tr>
                                                <td style="width: 400px;"><b>Nama Informasi</b></td>
                                                <td><b>Keterangan Informasi</b></td>
                                                <td style="width: 50px">
                                                    <div class="btn btn-success btn-sm" onclick="addRowInformasi()"><i
                                                            class="fas fa-plus"></i></div>
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($datameta->nama_informasi as $key => $value)
                                            { ?>
                                                <tr>
                                                    <td>
                                                        <input type="text" class="form-control"
                                                            name="meta[nama_informasi][]" placeholder="Contoh : Ukuran"
                                                            value="<?= $value ?>">
                                                    </td>
                                                    <td>
                                                        <textarea class="editor" name="meta[keterangan_informasi][]"
                                                            placeholder="Contoh : 2x3 Meter"><?= $datameta->keterangan_informasi[$key] ?></textarea>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="btn btn-danger btn-sm"
                                                            onclick="$(this).parent().parent().remove()">
                                                            <i class="fas fa-minus"></i>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><b>Foto</b></label>
                                    <table class="table table-bordered table-striped table-hover table-sm"
                                        id="table-foto">
                                        <thead class="bg-info text-white text-center">
                                            <tr>
                                                <td style="width: 400px;"><b>Foto Produk</b></td>
                                                <td style="width: 50px">
                                                    <div class="btn btn-success btn-sm" onclick="addRowFoto()"><i
                                                            class="fas fa-plus"></i></div>
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($datafoto as $key_foto => $val_foto)
                                            { ?>
                                                <tr>
                                                    <td>
                                                        <input type="file" class="form-control"
                                                            onchange="changeFile('file-<?= $key_foto ?>')"
                                                            id="file-<?= $key_foto ?>">
                                                        <input type="hidden" name="foto[]"
                                                            id="input-url-file-<?= $key_foto ?>" value="<?= $val_foto ?>">
                                                        <div id="res-file-<?= $key_foto ?>"></div>
                                                        <div id="preview-file-<?= $key_foto ?>" class="my-1">
                                                            <img src="<?= base_url($val_foto) ?>" class="img-responsive"
                                                                style="height: 150px;">
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="btn btn-danger btn-sm"
                                                            onclick="$(this).parent().parent().remove()">
                                                            <i class="fas fa-minus"></i>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php } ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-whitesmoke">
                        <div class="text-right">
                            <div class="btn btn-primary btn-send" onclick="saveProduk()"><i class="fas fa-save"></i>
                                Simpan Produk
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
        var form = $('#form-produk');
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
                        html: 'Anda akan segera diarahkan ke daftar produk',
                        timer: 2000,
                        timerProgressBar: true,
                        showConfirmButton: false,
                        willClose: () => {
                            clearInterval(timerInterval)
                        }
                    }).then((result) => {
                        /* Read more about handling dismissals below */
                        if (result.dismiss === Swal.DismissReason.timer) {
                            window.location.href = "<?= base_url('produk') ?>";
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
    var count_foto = <?= ($key_foto) ? $key_foto : 0 ?>;
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