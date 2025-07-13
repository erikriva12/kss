<?php $datameta = json_decode($data->meta); ?>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Section
                <?= $data->nama_section ?>
            </h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="<?= base_url() ?>">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="<?= base_url('section') ?>">Section</a></div>
                <div class="breadcrumb-item active">Section
                    <?= $data->nama_section ?>
                </div>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <form action="<?= base_url('section/store-section/') ?>" id="form-section">
                    <input type="hidden" name="id_section" value="<?= $data->id ?>">
                    <input type="hidden" name="slug" value="<?= $slug ?>">
                    <div class="card-body">
                        <div class="form-group">
                            <label><b>Nama Section</b></label>
                            <input type="text" class="form-control" value="<?= $data->nama_section ?>"
                                name="nama_section">
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label><b>Nama Perusahaan</b></label>
                                    <input type="text" class="form-control" name="meta[nama_perusahaan]"
                                        value="<?= $datameta->nama_perusahaan ?>">
                                </div>
                                <div class="form-group">
                                    <label><b>Keterangan Singkat</b></label>
                                    <textarea class="editor" name="meta[keterangan_singkat]">
                                        <?= $datameta->keterangan_singkat ?>
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label><b>Keterangan Panjang</b></label>
                                    <textarea class="editor" name="meta[keterangan_panjang]">
                                        <?= $datameta->keterangan_panjang ?>
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label><b>Visi</b></label>
                                    <textarea class="editor" name="meta[visi]">
                                        <?= $datameta->visi ?>
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label><b>Misi</b></label>
                                    <textarea class="editor" name="meta[misi]">
                                        <?= $datameta->misi ?>
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label><b>Counting</b></label>
                                    <table class="table table-bordered table-striped table-hover table-sm"
                                        id="table-counting">
                                        <thead class="bg-info text-white text-center">
                                            <tr>
                                                <td><b>Nama Counting</b></td>
                                                <td><b>Jumlah Counting</b></td>
                                                <td><b>Icon</b></td>
                                                <td style="width: 50px">
                                                    <div class="btn btn-success btn-sm" onclick="addRowCounting()"><i
                                                            class="fas fa-plus"></i></div>
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($datameta->nama_counting as $key_counting => $val_counting): ?>
                                                <tr>
                                                    <td>
                                                        <input type="text" class="form-control" name="meta[nama_counting][]"
                                                            value="<?= $datameta->nama_counting[$key_counting] ?>"
                                                            placeholder="Contoh : Happy Client">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control"
                                                            name="meta[jumlah_counting][]"
                                                            value="<?= $datameta->jumlah_counting[$key_counting] ?>"
                                                            placeholder="Contoh : 250">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" name="meta[icon_counting][]"
                                                            value="<?= $datameta->icon_counting[$key_counting] ?>"
                                                            placeholder="Contoh : bi bi-emoji-smile">
                                                        <small>*) Icon dapat menggunakan FontAwesome Icon atau Bootstrap
                                                            Icon</small>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="btn btn-danger btn-sm"
                                                            onclick="$(this).parent().parent().remove()">
                                                            <i class="fas fa-minus"></i>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="form-group">
                                    <label><b>Slogan</b></label>
                                    <table class="table table-bordered table-striped table-hover table-sm"
                                        id="table-slogan">
                                        <thead class="bg-info text-white text-center">
                                            <tr>
                                                <td><b>Judul Slogan</b></td>
                                                <td><b>Keterangan</b></td>
                                                <td><b>Icon</b></td>
                                                <td style="width: 50px">
                                                    <div class="btn btn-success btn-sm" onclick="addRowSlogan()"><i
                                                            class="fas fa-plus"></i></div>
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($datameta->judul_slogan as $key_slogan => $val_slogan): ?>
                                                <tr>
                                                    <td>
                                                        <input type="text" class="form-control" name="meta[judul_slogan][]"
                                                            value="<?= $datameta->judul_slogan[$key_slogan] ?>"
                                                            placeholder="Contoh : Happy Client">
                                                    </td>
                                                    <td>
                                                        <textarea class="form-control" name="meta[keterangan_slogan][]"
                                                            placeholder="Contoh : xxxx"><?= $datameta->keterangan_slogan[$key_slogan] ?></textarea>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" name="meta[icon_slogan][]"
                                                            value="<?= $datameta->icon_slogan[$key_slogan] ?>"
                                                            placeholder="Contoh : bi bi-emoji-smile">
                                                        <small>*) Icon dapat menggunakan FontAwesome Icon atau Bootstrap
                                                            Icon</small>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="btn btn-danger btn-sm"
                                                            onclick="$(this).parent().parent().remove()">
                                                            <i class="fas fa-minus"></i>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="form-group">
                                    <label><b>Client</b></label>
                                    <table class="table table-bordered table-striped table-hover table-sm"
                                        id="table-client">
                                        <thead class="bg-info text-white text-center">
                                            <tr>
                                                <td><b>Nama Client</b></td>
                                                <td style="width: 150px;"><b>Logo Client</b></td>
                                                <td><b>Website Client</b></td>
                                                <td style="width: 50px">
                                                    <div class="btn btn-success btn-sm" onclick="addRowClient()"><i
                                                            class="fas fa-plus"></i></div>
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($datameta->nama_client as $key_client => $val): ?>
                                                <tr>
                                                    <td>
                                                        <input type="text" class="form-control"
                                                            placeholder="Contoh : Hutama Maju Sukses"
                                                            value="<?= $datameta->nama_client[$key_client] ?>"
                                                            name="meta[nama_client][]">
                                                    </td>
                                                    <td>
                                                        <input type="file" class="form-control"
                                                            onchange="changeFile('file-<?= $key_client ?>')"
                                                            id="file-<?= $key_client ?>">
                                                        <input type="hidden" name="meta[logo_client][]"
                                                            id="input-url-file-<?= $key_client ?>"
                                                            value="<?= $datameta->logo_client[$key_client] ?>">
                                                        <div id="res-file-<?= $key_client ?>"></div>
                                                        <div id="preview-file-<?= $key_client ?>" class="my-1">
                                                            <img src="<?= base_url($datameta->logo_client[$key_client]) ?>"
                                                                class="img-responsive w-100">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control"
                                                            placeholder="Contoh : https://hutamamajusukses.com/"
                                                            value="<?= $datameta->website_client[$key_client] ?>"
                                                            name="meta[website_client][]">
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="btn btn-danger btn-sm"
                                                            onclick="$(this).parent().parent().remove()">
                                                            <i class="fas fa-minus"></i>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- <div class="form-group">
                                    <label><b>Testimoni</b></label>
                                    <table class="table table-bordered table-striped table-hover table-sm"
                                        id="table-testimoni">
                                        <thead class="bg-info text-white text-center">
                                            <tr>
                                                <td><b>Nama</b></td>
                                                <td style="width: 150px;"><b>Foto</b></td>
                                                <td><b>Perusahaan</b></td>
                                                <td><b>Isi Testimoni</b></td>
                                                <td style="width: 50px">
                                                    <div class="btn btn-success btn-sm" onclick="addRowTesti()"><i
                                                            class="fas fa-plus"></i></div>
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($datameta->nama_testimoni as $key_testi => $val): ?>
                                                <tr>
                                                    <td>
                                                        <input type="text" class="form-control"
                                                            placeholder="Contoh : Manager Hutama Maju Sukses"
                                                            value="<?= $datameta->nama_testimoni[$key_client] ?>"
                                                            name="meta[nama_testimoni][]">
                                                    </td>
                                                    <td>
                                                        <input type="file" class="form-control"
                                                            onchange="changeFile('foto-testi-<?= $key_client ?>')"
                                                            id="foto-testi-<?= $key_client ?>">
                                                        <input type="hidden" name="meta[foto_testimoni][]"
                                                            id="input-url-foto-testi-<?= $key_client ?>"
                                                            value="<?= $datameta->foto_testimoni[$key_client] ?>">
                                                        <div id="res-foto-testi-<?= $key_client ?>"></div>
                                                        <div id="preview-foto-testi-<?= $key_client ?>" class="my-1">
                                                            <img src="<?= base_url($datameta->foto_testimoni[$key_client]) ?>"
                                                                class="img-responsive w-100">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control"
                                                            placeholder="Contoh : Hutama Maju Sukses"
                                                            value="<?= $datameta->perusahaan_testimoni[$key_client] ?>"
                                                            name="meta[perusahaan_testimoni][]">
                                                    </td>
                                                    <td>
                                                        <textarea class="form-control" name="meta[isi_testimoni][]"
                                                            placeholder="Contoh : xxxx"><?= $datameta->isi_testimoni[$key_slogan] ?></textarea>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="btn btn-danger btn-sm"
                                                            onclick="$(this).parent().parent().remove()">
                                                            <i class="fas fa-minus"></i>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div> -->

                            </div>
                            <div class="col-md">
                                <div class="form-group">
                                    <label><b>Foto</b></label>
                                    <input type="file" class="form-control" onchange="changeFile('foto-about')"
                                        id="foto-about">
                                    <input type="hidden" name=meta[foto_about] id="input-url-foto-about"
                                        value="<?= $datameta->foto_about ?>">
                                    <div id="res-foto-about" class="my-1"></div>
                                    <div id="preview-foto-about" class="my-1">
                                        <img src="<?= base_url($datameta->foto_about) ?>" class="img-responsive w-100">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-whitesmoke">
                        <div class="text-right">
                            <div class="btn btn-primary btn-send" onclick="saveSection()"><i class="fas fa-save"></i>
                                Simpan
                                Section</div>
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
    function saveSection() {
        tinymce.triggerSave();
        Swal.fire({
            title: '<i class="fa fa-spin fa-spinner"></i>',
            text: 'Mohon Tunggu Sebentar',
            showConfirmButton: false,
            allowOutsideClick: false
        });
        var form = $('#form-section');
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
    function previewImage(idfile, url) {
        var htmls = `<img src="<?= base_url() ?>` + url + `" class="img-responsive w-100">`;
        $('#preview-' + idfile).html(htmls);
    }
    function changeFile(idfile) {
        var mydata = new FormData();
        mydata.append('file', $('#' + idfile)[0].files[0]);
        mydata.append('section', '<?= $slug ?>');
        $.ajax({
            type: "POST",
            url: "<?= base_url('section/upload-file') ?>",
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

    function addRowCounting() {
        var htmls = `<tr>
            <td>
                <input type="text" class="form-control" name="meta[nama_counting][]" placeholder="Contoh : Happy Client">
            </td>
            <td>
                <input type="number" class="form-control" name="meta[jumlah_counting][]" placeholder="Contoh : 250">
            </td>
            <td>
                <input type="text" class="form-control" name="meta[icon_counting][]" placeholder="Contoh : bi bi-emoji-smile">
                <small>*) Icon dapat menggunakan FontAwesome Icon atau Bootstrap
                    Icon</small>
            </td>
            <td class="text-center">
                <div class="btn btn-danger btn-sm"
                    onclick="$(this).parent().parent().remove()">
                    <i class="fas fa-minus"></i>
                </div>
            </td>
        </tr>`;
        $('#table-counting tbody').append(htmls);
    }

    function addRowSlogan() {
        var htmls = `<tr>
            <td>
                <input type="text" class="form-control" name="meta[judul_slogan][]"
                    placeholder="Contoh : Happy Client">
            </td>
            <td>
                <textarea class="form-control" name="meta[keterangan_slogan][]"
                    placeholder="Contoh : xxxx"></textarea>
            </td>
            <td>
                <input type="text" class="form-control" name="meta[icon_slogan][]"
                    placeholder="Contoh : bi bi-emoji-smile">
                <small>*) Icon dapat menggunakan FontAwesome Icon atau Bootstrap
                    Icon</small>
            </td>
            <td class="text-center">
                <div class="btn btn-danger btn-sm"
                    onclick="$(this).parent().parent().remove()">
                    <i class="fas fa-minus"></i>
                </div>
            </td>
        </tr>`;
        $('#table-slogan tbody').append(htmls);
    }
    var count_client = <?= ($key_client) ? $key_client : 0 ?>;
    function addRowClient() {
        count_client++;
        var htmls = `<tr>
            <td>
                <input type="text" class="form-control" placeholder="Contoh : Hutama Maju Sukses"
                    name="meta[nama_client][]">
            </td>
            <td>
                <input type="file" class="form-control"
                    onchange="changeFile('file-`+ count_client + `')" id="file-` + count_client + `">
                <input type="hidden" name="meta[logo_client][]"
                    id="input-url-file-`+ count_client + `">
                <div id="res-file-`+ count_client + `"></div>
                <div id="preview-file-`+ count_client + `" class="my-1"></div>
            </td>
            <td>
                <input type="text" class="form-control" placeholder="Contoh : https://hutamamajusukses.com/"
                    name="meta[website_client][]">
            </td>
            <td class="text-center">
                <div class="btn btn-danger btn-sm"
                    onclick="$(this).parent().parent().remove()">
                    <i class="fas fa-minus"></i>
                </div>
            </td>
        </tr>`;
        $('#table-client tbody').append(htmls);
        renderEditor();
    }
    var count_testi = <?= ($key_testi) ? $key_testi : 0 ?>;
    function addRowTesti() {
        count_testi++;
        var htmls = `<tr>
            <td>
                <input type="text" class="form-control"
                    placeholder="Contoh : Manager Hutama Maju Sukses"
                    name="meta[nama_testimoni][]">
            </td>
            <td>
                <input type="file" class="form-control"
                    onchange="changeFile('foto-testi-`+ count_testi + `')"
                    id="foto-testi-`+ count_testi + `">
                <input type="hidden" name="meta[foto_testimoni][]"
                    id="input-url-foto-testi-`+ count_testi + `"
                <div id="res-foto-testi-`+ count_testi + `"></div>
                <div id="preview-foto-testi-`+ count_testi + `" class="my-1"></div>
            </td>
            <td>
                <input type="text" class="form-control"
                    placeholder="Contoh : Hutama Maju Sukses"
                    name="meta[perusahaan_testimoni][]">
            </td>
            <td>
                <textarea class="form-control" name="meta[isi_testimoni][]"
                    placeholder="Contoh : xxxx"></textarea>
            </td>
            <td class="text-center">
                <div class="btn btn-danger btn-sm"
                    onclick="$(this).parent().parent().remove()">
                    <i class="fas fa-minus"></i>
                </div>
            </td>
        </tr>`;
        $('#table-testimoni tbody').append(htmls);
        renderEditor();
    }
</script>