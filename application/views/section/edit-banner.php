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
                        <table class="table table-bordered table-striped table-hover table-sm" id="table-banner">
                            <thead class="bg-info text-white text-center">
                                <tr>
                                    <td><b>Gambar</b></td>
                                    <td><b>Keterangan</b></td>
                                    <td style="width: 50px">
                                        <div class="btn btn-success btn-sm" onclick="addRowBanner()"><i
                                                class="fas fa-plus"></i></div>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($datameta->foto_banner as $key => $val): ?>
                                    <tr>
                                        <td>
                                            <input type="file" class="form-control"
                                                onchange="changeFile('file-<?= $key ?>')" id="file-<?= $key ?>">
                                            <input type="hidden" name=meta[foto_banner][] id="input-url-file-<?= $key ?>"
                                                value="<?= $datameta->foto_banner[$key] ?>">
                                            <div id="res-file-<?= $key ?>"></div>
                                        </td>
                                        <td>
                                            <textarea class="editor"
                                                name="meta[keterangan_banner][]"><?= $datameta->keterangan_banner[$key] ?></textarea>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn btn-danger btn-sm" onclick="$(this).parent().parent().remove()">
                                                <i class="fas fa-minus"></i>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
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
    var count_banner = <?= ($key) ? $key : 0 ?>;
    function addRowBanner() {
        count_banner++;
        var htmls = `<tr>
            <td>
                <input type="file" class="form-control" onchange="changeFile('file-`+ count_banner + `')"
                    id="file-`+ count_banner + `">
                    <input type="hidden" name=meta[foto_banner][] id="input-url-file-`+ count_banner + `">
                <div id="res-file-`+ count_banner + `"></div>
            </td>
            <td>
                <textarea class="editor" name="meta[keterangan_banner][]"></textarea>
            </td>
            <td class="text-center">
                <div class="btn btn-danger btn-sm" onclick="$(this).parent().parent().remove()"><i
                        class="fas fa-minus"></i></div>
            </td>
        </tr>`;
        $('#table-banner tbody').append(htmls);
        renderEditor();
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
                    <a href="<?= base_url() ?>`+ res.url + `" class="btn btn-success btn-sm" target="blank"><i class="fas fa-eye"></i> Lihat Foto</a>
                    `);
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