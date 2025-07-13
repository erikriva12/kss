<?php
if ($this->session->userdata('admin_session'))
{
	redirect('/dashboard');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
	<title>Login |
		<?= nama_aplikasi ?>
	</title>
	<!-- Favicons -->
	<link href="<?= base_url(logo) ?>" rel="icon">
	<link href="<?= base_url(logo) ?>" rel="apple-touch-icon">

	<!-- General CSS Files -->
	<link rel="stylesheet" href="<?= base_url() ?>/assets/modules/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>/assets/modules/fontawesome/css/all.min.css">

	<!-- CSS Libraries -->
	<link rel="stylesheet" href="<?= base_url() ?>/assets/modules/bootstrap-social/bootstrap-social.css">

	<!-- Template CSS -->
	<link rel="stylesheet" href="<?= base_url() ?>/assets/css/style.css">
	<link rel="stylesheet" href="<?= base_url() ?>/assets/css/components.css">
	<!-- Start GA -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag() { dataLayer.push(arguments); }
		gtag('js', new Date());

		gtag('config', 'UA-94034622-3');
	</script>
	<!-- /END GA -->
</head>

<body>
	<div id="app">
		<section class="section">
			<div class="container mt-5">
				<div class="row">
					<div
						class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
						<div class="login-brand">
							<img src="<?= base_url(logo) ?>" alt="logo" width="100" class="shadow-light rounded-circle">
						</div>

						<div class="card card-primary">
							<div class="card-header">
								<h4 class="text-center">Login Admin</h4>
							</div>

							<div class="card-body">
								<form method="POST" action="<?= base_url('login/storeLogin') ?>" id="form-login">
									<div class="form-group">
										<label for="username">Username <span class="text-danger">*</span></label>
										<input id="username" type="username" class="form-control" name="username"
											tabindex="1" autofocus>
									</div>

									<div class="form-group">
										<div class="d-block">
											<label for="password" class="control-label">Password <span
													class="text-danger">*</span></label>
										</div>
										<input id="password" type="password" class="form-control" name="password"
											tabindex="2">
									</div>

									<div class="form-group">
										<button type="submit" class="btn btn-primary btn-lg btn-block trigger"
											tabindex="4">
											Login
										</button>
									</div>
								</form>


							</div>
						</div>

						<div class="simple-footer">
							&copy;
							<?= copyright ?>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>


	<!-- General JS Scripts -->
	<script src="<?= base_url() ?>/assets/modules/jquery.min.js"></script>
	<script src="<?= base_url() ?>/assets/modules/popper.js"></script>
	<script src="<?= base_url() ?>/assets/modules/tooltip.js"></script>
	<script src="<?= base_url() ?>/assets/modules/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?= base_url() ?>/assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
	<script src="<?= base_url() ?>/assets/modules/moment.min.js"></script>
	<script src="<?= base_url() ?>/assets/js/stisla.js"></script>
	<script src="<?= base_url() ?>/assets/modules/sweetalert2/sweetalert2.all.js"></script>

	<script type="text/javascript">
		$("#form-login").submit(function () {

			var mydata = new FormData(this);
			var form = $(this);
			$.ajax({
				type: "POST",
				url: form.attr("action"),
				data: mydata,
				cache: false,
				contentType: false,
				processData: false,
				beforeSend: function () {
					Swal.fire({
						title: '<i class="fa fa-spin fa-spinner"></i>',
						text: 'Mohon Tunggu Sebentar',
						showConfirmButton: false,
						// allowOutsideClick: false
					});
				},
				success: function (response, textStatus, xhr) {
					var res = JSON.parse(response);
					if (res.code == 200) {
						let timerInterval
						Swal.fire({
							icon: 'success',
							title: 'Berhasil!',
							html: 'Anda akan segera diarahkan ke halaman dashboard',
							timer: 2000,
							timerProgressBar: true,
							showConfirmButton: false,
							willClose: () => {
								clearInterval(timerInterval)
							}
						}).then((result) => {
							/* Read more about handling dismissals below */
							window.location.href = "<?= base_url('dashboard') ?>";
						})
					}
					console.log(res)
				},
				error: function (xhr, textStatus, errorThrown) {
					console.log(res);
					console.log(xhr);
				}
			});
			return false;
		});
	</script>
	<!-- Template JS File -->
	<script src="<?= base_url() ?>/assets/js/scripts.js"></script>
	<script src="<?= base_url() ?>/assets/js/custom.js"></script>
</body>

</html>