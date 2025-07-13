<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Konfigurasi</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="<?= base_url() ?>">Dashboard</a></div>
                <div class="breadcrumb-item active">Konfigurasi
                </div>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <form action="<?= base_url('konfigurasi/store/') ?>" id="form-produk">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><b>Nama Aplikasi</b></label>
                                    <input type="text" class="form-control" placeholder="Contoh : Karya Sukses Steel"
                                        name="nama_aplikasi" value="<?= $konfig['nama_aplikasi'] ?>">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><b>Nama Perusahaan</b></label>
                                    <input type="text" class="form-control" placeholder="Contoh : Karya Sukses Steel"
                                        name="nama_perusahaan" value="<?= $konfig['nama_perusahaan'] ?>">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><b>Logo</b></label>
                                    <input type="file" class="form-control" onchange="changeFile('file-logo')"
                                        id="file-logo">
                                    <input type="hidden" name="logo" id="input-url-file-logo"
                                        value="<?= $konfig['logo'] ?>">
                                    <div id="res-file-logo"></div>
                                    <div id="preview-file-logo" class="my-1">
                                        <img src="<?= base_url($konfig['logo']) ?>" class="img-responsive"
                                            style="height: 150px;">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><b>Judul Text Footer</b></label>
                                    <input type="text" class="form-control" placeholder="Contoh : Sosial Media Kami"
                                        name="judul_text_footer" value="<?= $konfig['judul_text_footer'] ?>">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><b>Text Footer</b></label>
                                    <textarea class="editor" name="text_footer"
                                        placeholder="Contoh : xxxxxx"><?= $konfig['text_footer'] ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><b>Copyright</b></label>
                                    <input type="text" class="form-control"
                                        placeholder="Contoh : Copyright KARYA SUKSES STEEL. All Rights Reserved"
                                        name="copyright" value="<?= $konfig['copyright'] ?>">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label><b>Online Shop</b></label>
                                <table class="table table-bordered table-striped table-hover table-sm">
                                    <thead class="bg-info text-white text-center">
                                        <tr>
                                            <td><b>Nama Online Shop</b></td>
                                            <td><b>Link Online Shop</b></td>
                                            <td><b>Logo Online Shop</b></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control" placeholder="Contoh : Tokopedia"
                                                    name="online_shop[nama][]"
                                                    value="<?= @$konfig['online_shop']->nama[0] ?>">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control"
                                                    placeholder="Contoh : https://www.tokopedia.com/karyasuksessteel"
                                                    name="online_shop[link][]"
                                                    value="<?= @$konfig['online_shop']->link[0] ?>">
                                            </td>
                                            <td>
                                                <input type="file" class="form-control"
                                                    onchange="changeFile('online-shop-1')" id="online-shop-1">
                                                <input type="hidden" name="online_shop[logo][]"
                                                    value="<?= @$konfig['online_shop']->logo[0] ?>"
                                                    id="input-url-online-shop-1">
                                                <div id="res-online-shop-1"></div>
                                                <div id="preview-online-shop-1" class="my-1">
                                                    <?php if (@$konfig['online_shop']->logo[0])
                                                    {
                                                        ?>
                                                        <img src="<?= base_url($konfig['online_shop']->logo[0]) ?>"
                                                            class="img-responsive" style="height: 150px;">
                                                        <?php
                                                    } ?>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control" placeholder="Contoh : Tokopedia"
                                                    name="online_shop[nama][]"
                                                    value="<?= @$konfig['online_shop']->nama[1] ?>">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control"
                                                    placeholder="Contoh : https://www.tokopedia.com/karyasuksessteel"
                                                    name="online_shop[link][]"
                                                    value="<?= @$konfig['online_shop']->link[1] ?>">
                                            </td>
                                            <td>
                                                <input type="file" class="form-control"
                                                    onchange="changeFile('online-shop-2')" id="online-shop-2">
                                                <input type="hidden" name="online_shop[logo][]"
                                                    value="<?= @$konfig['online_shop']->logo[1] ?>"
                                                    id="input-url-online-shop-2">
                                                <div id="res-online-shop-2"></div>
                                                <div id="preview-online-shop-2" class="my-1">
                                                    <?php if (@$konfig['online_shop']->logo[1])
                                                    {
                                                        ?>
                                                        <img src="<?= base_url($konfig['online_shop']->logo[1]) ?>"
                                                            class="img-responsive" style="height: 150px;">
                                                        <?php
                                                    } ?>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control" placeholder="Contoh : Tokopedia"
                                                    name="online_shop[nama][]"
                                                    value="<?= @$konfig['online_shop']->nama[2] ?>">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control"
                                                    placeholder="Contoh : https://www.tokopedia.com/karyasuksessteel"
                                                    name="online_shop[link][]"
                                                    value="<?= @$konfig['online_shop']->link[2] ?>">
                                            </td>
                                            <td>
                                                <input type="file" class="form-control"
                                                    onchange="changeFile('online-shop-3')" id="online-shop-3">
                                                <input type="hidden" name="online_shop[logo][]"
                                                    value="<?= @$konfig['online_shop']->logo[2] ?>"
                                                    id="input-url-online-shop-3">
                                                <div id="res-online-shop-3"></div>
                                                <div id="preview-online-shop-3" class="my-1">
                                                    <?php if (@$konfig['online_shop']->logo[2])
                                                    {
                                                        ?>
                                                        <img src="<?= base_url($konfig['online_shop']->logo[2]) ?>"
                                                            class="img-responsive" style="height: 150px;">
                                                        <?php
                                                    } ?>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- <div class="col-md-12">
                                <div class="form-group">
                                    <label><b>Link Tokopedia</b></label>
                                    <input type="text" class="form-control"
                                        placeholder="Contoh : https://www.tokopedia.com/karyasuksessteel"
                                        name="link_tokped" value="<?= $konfig['link_tokped'] ?>">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><b>Logo Tokopedia</b></label>
                                    <input type="file" class="form-control" onchange="changeFile('file-tokped')"
                                        id="file-tokped">
                                    <input type="hidden" name="logo_tokped" id="input-url-file-tokped"
                                        value="<?= $konfig['logo_tokped'] ?>">
                                    <div id="res-file-tokped"></div>
                                    <div id="preview-file-tokped" class="my-1">
                                        <img src="<?= base_url($konfig['logo_tokped']) ?>" class="img-responsive"
                                            style="height: 150px;">
                                    </div>
                                </div>
                            </div> -->

                        </div>
                    </div>
                    <div class="card-footer bg-whitesmoke">
                        <div class="text-right">
                            <div class="btn btn-primary btn-send" onclick="saveKonfigurasi()"><i
                                    class="fas fa-save"></i>
                                Simpan Konfigurasi
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
    function saveKonfigurasi() {
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
                        html: 'Halaman akan segera diperbarui',
                        timer: 2000,
                        timerProgressBar: true,
                        showConfirmButton: false,
                        willClose: () => {
                            clearInterval(timerInterval)
                        }
                    }).then((result) => {
                        /* Read more about handling dismissals below */
                        if (result.dismiss === Swal.DismissReason.timer) {
                            window.location.reload();
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
            url: "<?= base_url('konfigurasi/upload-file') ?>",
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