<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-12">
				<div class="card card-statistic-2" onclick="getDaftarVisitor(-1)">

					<div class="card-icon shadow-primary bg-primary">
						<i class="fas fa-user"></i>
					</div>
					<div class="card-wrap">
						<div class="card-header">
							<h4>Visitor</h4>
						</div>
						<div class="card-body">
							<?php
							$this->db->where('tahun', date('Y'));
							$visitor = $this->ermodel->selectWhere('visitor', [])->result();
							$total = array_sum(array_column($visitor, 'jumlah'));
							?>
							<?= ($total) ? number_format($total, 0, ",", ".") : 0; ?>
						</div>
					</div>
				</div>

			</div>
			<div class="col-md-8 col-sm-12">
				<div class="card">

					<div class="card-wrap">
						<div class="card-body">
							<div id="chart-visitor"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12 d-none" id="card-visitor">
				<div class="card">
					<div class="card-wrap">
						<div class="card-header">
							<h4>Daftar Visitor</h4>
						</div>
						<div class="card-body">
							<div id="data-table-daftar-visitor"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-8 col-md-8 col-sm-12">
				<div class="card">
					<div class="card-wrap">
						<div class="card-header">
							<h4>Pesan Kontak</h4>
						</div>
						<div class="card-body">
							<div id="table-pesan-kontak"></div>

						</div>
					</div>

				</div>
			</div>
			<div class="col-md-4 col-sm-12">
				<div class="card">
					<div class="card-wrap">
						<div class="card-header">
							<h4>Email Subscriber</h4>
						</div>
						<div class="card-body">
							<div id="table-subscriber"></div>

						</div>
					</div>

				</div>
			</div>
		</div>

	</section>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="modalDetailPesan">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Detail Pesan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body">
				<div id="detail-pesan"></div>
			</div>
		</div>
	</div>
</div>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<?php
$array_visitor = [];
foreach ($visitor as $key => $val)
{
	$array_visitor[] = [$val->bulan_nama, (int)$val->jumlah];
}
$array_visitor = json_encode($array_visitor);
// print_r()
?>

<script>
	Highcharts.chart('chart-visitor', {
		chart: {
			type: 'column'
		},
		title: {
			text: 'Visitor Tahun <?= date('Y') ?>'
		},
		xAxis: {
			type: 'category',
			labels: {
				rotation: -45,
				style: {
					fontSize: '13px',
					fontFamily: 'Verdana, sans-serif'
				}
			}
		},
		yAxis: {
			min: 0,
			title: {
				text: 'Jumlah Visitor'
			}
		},
		legend: {
			enabled: false
		},
		tooltip: {
			pointFormat: 'Jumlah Visitor : <b>{point.y}</b>'
		},
		plotOptions: {
			series: {
				cursor: 'pointer',
				point: {
					events: {
						click: function () {
							getDaftarVisitor(this.category);
						}
					}
				}
			}
		},
		series: [{
			name: 'Population',
			colors: [
				'#9b20d9', '#9215ac', '#861ec9', '#7a17e6', '#7010f9', '#691af3',
				'#6225ed', '#5b30e7', '#533be1', '#4c46db', '#4551d5', '#3e5ccf',
				'#3667c9', '#2f72c3', '#277dbd', '#1f88b7', '#1693b1', '#0a9eaa',
				'#03c69b', '#00f194'
			],
			colorByPoint: true,
			groupPadding: 0,
			data: <?= $array_visitor ?>,
			dataLabels: {
				enabled: true,
				rotation: -90,
				color: '#FFFFFF',
				align: 'right',
				format: '{point.y}', // one decimal
				y: 10, // 10 pixels down from the top
				style: {
					fontSize: '13px',
					fontFamily: 'Verdana, sans-serif'
				}
			}
		}]
	});
	function getPesanKontak() {
		var table_htmls = `<table class="table table-bordered table-striped table-hover table-sm" id="table-pesan">
								<thead class="bg-info">
									<tr>
										<th class="text-white">No</th>
										<th class="text-white">Nama</th>
										<th class="text-white">Email</th>
										<th class="text-white">Subject</th>
										<th class="text-white">Tanggal</th>
										<th class="text-white">Aksi</th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>`;
		$('#table-pesan-kontak').html(table_htmls);
		var t = $("#table-pesan").dataTable({
			initComplete: function () {
				var api = this.api();
				$('#table-pesan_filter input')
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
				url: "<?= base_url('dashboard/getPesanKontak') ?>",
				type: "POST"
			},
			columns: [{
				data: "id",
				orderable: false
			},
			{
				data: "nama",
				orderable: false,
			},
			{
				data: "email",
				orderable: false,

			},
			{
				data: "subject",
				orderable: false,

			},
			{
				data: "tanggal",
				orderable: false,
			},
			{
				data: "id",
				orderable: false,
				render: function (data, type, row, meta) {
					var htmls = `<div class="btn btn-primary btn-sm btn-block text-white" onclick="getDetailPesan(` + row.id + `)"><i class="fas fa-pencil-alt"></i> Detail</div>`;
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
	getPesanKontak();
	function getDetailPesan(id) {
		$('#modalDetailPesan').modal('toggle');
		$('#detail-pesan').html('<i class="fa fa-spin fa-spinner"></i> Mohon Tunggu Sebentar');
		$('#detail-pesan').load('<?= base_url('dashboard/getDetailPesan/') ?>' + id);
	}
	function getEmailSubs() {
		var table_htmls = `<table class="table table-bordered table-striped table-hover table-sm" id="subscriber">
								<thead class="bg-info">
									<tr>
										<th class="text-white">No</th>
										
										<th class="text-white">Email</th>
										<th class="text-white">Tanggal</th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>`;
		$('#table-subscriber').html(table_htmls);
		var t = $("#subscriber").dataTable({
			initComplete: function () {
				var api = this.api();
				$('#subscriber_filter input')
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
				url: "<?= base_url('dashboard/getEmailSubs') ?>",
				type: "POST"
			},
			columns: [{
				data: "id",
				orderable: false
			},

			{
				data: "email",
				orderable: false,

			},

			{
				data: "subscribe_at",
				orderable: false,
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
	getEmailSubs();
	function getDaftarVisitor(bulan) {
		$('#card-visitor').removeClass('d-none');
		bulan = bulan + 1;
		var table_htmls = `<table class="table table-bordered table-striped table-hover table-sm" id="table-daftar-visitor">
								<thead class="bg-info">
									<tr>
										<th class="text-white" style="width: 15px;">No</th>
										<th class="text-white">IP Address</th>
										<th class="text-white">Tanggal</th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>`;
		$('#data-table-daftar-visitor').html(table_htmls);
		var t = $("#table-daftar-visitor").dataTable({
			initComplete: function () {
				var api = this.api();
				$('#table-daftar-visitor_filter input')
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
				url: "<?= base_url('dashboard/getDaftarVisitor') ?>",
				data: {
					bulan: bulan
				},
				type: "POST"
			},
			columns: [{
				data: "id",
				orderable: false
			},
			{
				data: "ip",
				orderable: false,
			},
			{
				data: "tanggal",
				orderable: false,

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

</script>