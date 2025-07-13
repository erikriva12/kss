<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>User</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item "><a href="<?= base_url() ?>">Dashboard</a></div>
                <div class="breadcrumb-item active">User</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <div class="col-md">
                        <h4>Daftar User</h4>
                    </div>
                    <div class="col-md-4">
                        <div class="text-right">
                            <a href="<?= base_url('user/tambah') ?>" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Tambah User
                            </a>
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
<script>
    function getData() {
        var table_htmls = `<table class="table table-bordered table-striped table-hover" id="my-table">
            <thead class="bg-info">
                <tr>
                    <th class="text-white" style="width: 15px">No</th>
                    <th class="text-white">Foto Profil</th>
                    <th class="text-white">Nama</th>
                    <th class="text-white">Username</th>
                    <th class="text-white">Status</th>
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
                url: "<?= base_url('user/json') ?>",
                type: "POST"
            },
            columns: [{
                data: "id",
                orderable: false
            },
            {
                data: "foto_profil",
                orderable: false,
                render: function (data, type, row, meta) {
                    var htmls = `<img src="<?= base_url('assets/img/avatar/avatar-1.png') ?>" class="img-responsive" style="height: 150px;">`;
                    if (row['foto_profil']) {
                        htmls = `<img src="<?= base_url() ?>` + row['foto_profil'] + `" class="img-responsive" style="height: 150px;">`;
                    }
                    return htmls;
                }
            },
            {
                data: "nama",
                orderable: false,

            },
            {
                data: "username",
                orderable: false,

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
                data: "id",
                orderable: false,
                render: function (data, type, row, meta) {
                    var htmls = `<a class="btn btn-primary btn-sm btn-block text-white" href="<?= base_url('user/edit/') ?>` + row['id'] + `"><i class="fas fa-pencil-alt"></i> Edit</a>`;
                    return htmls;
                }
            }
            ],

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
                    url: "<?= base_url('user/hapus') ?>",
                    type: "POST",
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
                    url: "<?= base_url('user/hapus') ?>",
                    type: "POST",
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