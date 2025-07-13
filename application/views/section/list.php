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
                            <h4>Daftar Section</h4>
                        </div>
                        <div class="col-md-4">
                            <div class="text-right">
                                <a href="<?= base_url('section/urutan') ?>" class="btn btn-info"><i
                                        class="fas fa-sort"></i> Urutan Section</a>
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#modalTambahSection">
                                    <i class="fas fa-plus"></i> Tambah Section
                                </button>
                            </div>
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
<div class="modal fade" tabindex="-1" role="dialog" id="modalTambahSection">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Section</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?= base_url('section/update-kategori') ?>" id="form-edit-kategori">
                <div class="modal-body">
                    <div class="form-group">
                        <label><b>Layout</b></label>
                        <select class="form-control select2" style="width: 100%;" id="slug" onchange="chageLayout()">
                            <option value="">-- Pilih --</option>
                            <?php
                            $kategori_section = $this->ermodel->selectWhere('section_kategori', ['status' => 'ENABLE'])->result();
                            foreach ($kategori_section as $key => $val):
                                ?>
                                <option value="<?= $val->slug ?>"><?= $val->nama ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
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
                    <th class="text-white">Nama Section</th>
                    <th class="text-white">Kategori</th>
                    <th class="text-white" style="width: 100px">Status</th>
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
                url: "<?= base_url('section/json') ?>",
                type: "POST"
            },
            columns: [{
                data: "id",
                orderable: false
            },
            {
                data: "nama_section",
                orderable: false
            },
            {
                data: "kategori_section_nama",
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
                    var htmls = `<a class="btn btn-primary btn-sm btn-block text-white" href="<?= base_url('section/edit/') ?>` + row['slug'] + `"><i class="fas fa-pencil-alt"></i> Edit</a>`;
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
    function chageLayout() {
        var slug = $('#slug').val()
        window.location.href = "<?= base_url('section/tambah/') ?>" + slug;
    }
</script>