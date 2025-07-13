<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Kategori Produk</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?= base_url() ?>">Dashboard</a></div>
                <div class="breadcrumb-item">Kategori Produk</div>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <div class="col-md">
                        <h4>Daftar Kategori Produk</h4>
                    </div>
                    <div class="col-md-4">
                        <div class="text-right">
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#modalKategori">
                                <i class="fas fa-plus"></i> Tambah Kategori
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="table-data">
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="modalKategori">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?= base_url('produk/store-kategori') ?>" id="form-add-kategori">
                <div class="modal-body">
                    <div class="form-group">
                        <label><b>Nama Kategori</b></label>
                        <input type="text" class="form-control" name="nama_kategori">
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="btn btn-primary btn-send" onclick="storeKategori()">Simpan</d>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="modalKategoriEdit">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?= base_url('produk/update-kategori') ?>" id="form-edit-kategori">
                <div class="modal-body">
                    <div id="edit-kategori"></div>
                </div>
                <div class="modal-footer">
                    <div class="btn btn-primary btn-send" onclick="updateKategori()">Simpan</d>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function getData() {
        var table_htmls = `<table class="table table-bordered table-striped table-hover" id="my-table">
            <thead class="bg-info">
                <tr>
                    <th class="text-white" style="width: 15px">No</th>
                    <th class="text-white">Nama Kategori Produk</th>
                    <th class="text-white" style="width: 100px;">Status</th>
                    <th class="text-white" style="width: 100px">Aksi</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>`;
        $('#table-data').html(table_htmls);
        var t = $("#my-table").dataTable({
            initComplete: function () {
                var api = this.api();
                $('#my-table_filter input')
                    .off('.DT')
                    .on('keyup.DT', function (e) {
                        if (e.keyCode == 13) {
                            api.search(this.value).draw();
                        }
                    });
            },
            oLanguage: {
                sProcessing: "loading..."
            },
            processing: true,
            serverSide: true,
            ajax: {
                url: "<?= base_url('produk/json_kategori') ?>",
                type: "POST"
            },
            columns: [{
                data: "id",
                orderable: false
            },
            {
                data: "nama",
                orderable: false
            },
            {
                data: "status",
                orderable: false,
                render: function (data, type, row, meta) {
                    var htmls = `<div class="btn btn-success btn-sm btn-block" onclick="deleteData(` + row['id'] + `)">` + row['status'] + `</div>`;
                    if (row['status'] == 'DISABLE') {
                        htmls = `<div class="btn btn-danger btn-sm btn-block" onclick="restoreData(` + row['id'] + `)">` + row['status'] + `</div>`;
                    }
                    return htmls;
                }
            },
            {
                data: "nama_section",
                orderable: false,
                render: function (data, type, row, meta) {
                    var htmls = `<div class="btn btn-primary btn-sm btn-block text-white" onclick="edit(` + row['id'] + `)"><i class="fas fa-pencil-alt"></i> Edit</div>`;
                    return htmls;
                }
            }],
            order: [
                [0, 'asc']
            ],
            rowCallback: function (row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index + ".");
            }
        });
    }
    getData();
    function storeKategori() {
        Swal.fire({
            title: '<i class="fa fa-spin fa-spinner"></i>',
            text: 'Mohon Tunggu Sebentar',
            showConfirmButton: false,
            allowOutsideClick: false
        });
        var form = $('#form-add-kategori');
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
                            return false;
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
        return false;
    }
    function edit(id_kategori) {
        $('#modalKategoriEdit').modal('toggle');
        $('#edit-kategori').html('<i class="fa fa-spin fa-spinner"></i> Mohon Tunggu Sebentar')
        $('#edit-kategori').load("<?= base_url('produk/edit-kategori/') ?>" + id_kategori);
    }
    function updateKategori() {
        Swal.fire({
            title: '<i class="fa fa-spin fa-spinner"></i>',
            text: 'Mohon Tunggu Sebentar',
            showConfirmButton: false,
            allowOutsideClick: false
        });
        var form = $('#form-edit-kategori');
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
                            return false;
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
        return false;
    }
    function deleteData(id) {
        Swal.fire({
            title: 'Apakah Anda Yakin?',
            text: "Data yang dihapus tidak akan muncul pada plihan data.",
            icon: 'question',
            showCancelButton: 'Batal',
            confirmButtonColor: '#dc3741',
            confirmButtonText: 'Hapus Data'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: '<i class="fa fa-spin fa-spinner"></i>',
                    text: 'Mohon Tunggu Sebentar',
                    showConfirmButton: false,
                    allowOutsideClick: false
                });
                var mydata = new FormData();
                mydata.append('id', id);
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('produk/hapus_kategori') ?>",
                    data: mydata,
                    cache: false,
                    contentType: false,
                    processData: false,

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
                    }
                });

            }
        })

    }
    function restoreData(id) {
        Swal.fire({
            title: 'Apakah Anda Yakin?',
            text: "Data akan muncul kembali pada plihan data.",
            icon: 'question',
            showCancelButton: 'Batal',
            confirmButtonText: 'Restore Data'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: '<i class="fa fa-spin fa-spinner"></i>',
                    text: 'Mohon Tunggu Sebentar',
                    showConfirmButton: false,
                    allowOutsideClick: false
                });
                var mydata = new FormData();
                mydata.append('id', id);
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('produk/hapus_kategori') ?>",
                    data: mydata,
                    cache: false,
                    contentType: false,
                    processData: false,

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
                    }
                });

            }
        })

    }
</script>