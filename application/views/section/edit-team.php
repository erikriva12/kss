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
                        <div class="row">
                            <div class="col-md">

                                <div class="form-group">
                                    <label><b>Nama Section</b></label>
                                    <input type="text" class="form-control" value="<?= $data->nama_section ?>"
                                        name="nama_section">
                                </div>
                                <div class="form-group">
                                    <label><b>Keterangan Singkat</b></label>
                                    <textarea class="editor"
                                        name="meta[keterangan_singkat]"><?= $datameta->keterangan_singkat ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label><b>Struktur Organisasi</b></label>
                                    <table class="table table-bordered table-striped table-hover table-sm"
                                        id="table-team">
                                        <thead class="bg-info text-white text-center">
                                            <tr>
                                                <td><b>Nama</b></td>
                                                <td style="width: 150px;"><b>Foto</b></td>
                                                <td><b>Jabatan</b></td>
                                                <!-- <td><b>Sosial Media</b></td> -->
                                                <td style="width: 50px">
                                                    <div class="btn btn-success btn-sm" onclick="addRowTeam()"><i
                                                            class="fas fa-plus"></i></div>
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($datameta->nama as $key_team => $val): ?>
                                                <tr>
                                                    <td>
                                                        <input type="text" class="form-control"
                                                            placeholder="Contoh : Walter White"
                                                            value="<?= $datameta->nama[$key_team] ?>" name="meta[nama][]">
                                                    </td>
                                                    <td>
                                                        <input type="file" class="form-control"
                                                            onchange="changeFile('file-<?= $key_team ?>')"
                                                            id="file-<?= $key_team ?>">
                                                        <input type="hidden" name="meta[foto][]"
                                                            id="input-url-file-<?= $key_team ?>"
                                                            value="<?= $datameta->foto[$key_team] ?>">
                                                        <div id="res-file-<?= $key_team ?>"></div>
                                                        <div id="preview-file-<?= $key_team ?>" class="my-1">
                                                            <img src="<?= base_url($datameta->foto[$key_team]) ?>"
                                                                class="img-responsive w-100">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control"
                                                            placeholder="Contoh : Chief Executive Officer"
                                                            value="<?= $datameta->jabatan[$key_team] ?>"
                                                            name="meta[jabatan][]">
                                                    </td>
                                                    <!-- <td>
                                                        <div class="form-group mb-1">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text">
                                                                        <i class="fab fa-twitter"></i>
                                                                    </div>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    name="meta[twitter][]"
                                                                    value="<?= $datameta->twitter[$key_team] ?>">
                                                            </div>
                                                        </div>
                                                        <div class="form-group mb-1">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text">
                                                                        <i class="fab fa-facebook"></i>
                                                                    </div>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    name="meta[facebook][]"
                                                                    value="<?= $datameta->facebook[$key_team] ?>">
                                                            </div>
                                                        </div>
                                                        <div class="form-group mb-1">

                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text">
                                                                        <i class="fab fa-instagram"></i>
                                                                    </div>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    name="meta[instagram][]"
                                                                    value="<?= $datameta->instagram[$key_team] ?>">
                                                            </div>
                                                        </div>
                                                        <div class="form-group mb-1">

                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text">
                                                                        <i class="fab fa-linkedin"></i>
                                                                    </div>
                                                                </div>
                                                                <input type="text" class="form-control"
                                                                    name="meta[linkedin][]"
                                                                    value="<?= $datameta->linkedin[$key_team] ?>">
                                                            </div>
                                                        </div>
                                                    </td> -->
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

    var count_team = <?= ($key_team) ? $key_team : 0 ?>;
    function addRowTeam() {
        count_team++;
        var htmls = `<tr>
            <td>
                <input type="text" class="form-control"
                    placeholder="Contoh : Walter White"
                    name="meta[nama][]">
            </td>
            <td>
                <input type="file" class="form-control"
                    onchange="changeFile('file-`+ count_team + `')"
                    id="file-`+ count_team + `">
                <input type="hidden" name="meta[foto][]"
                    id="input-url-file-`+ count_team + `">
                <div id="res-file-`+ count_team + `"></div>
                <div id="preview-file-`+ count_team + `" class="my-1">
                    
                </div>
            </td>
            <td>
                <input type="text" class="form-control"
                    placeholder="Contoh : Chief Executive Officer"
                    name="meta[jabatan][]">
            </td>
            
            <td class="text-center">
                <div class="btn btn-danger btn-sm"
                    onclick="$(this).parent().parent().remove()">
                    <i class="fas fa-minus"></i>
                </div>
            </td>
        </tr>`;
        $('#table-team tbody').append(htmls);
    }
</script>