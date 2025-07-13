<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>
        <?= nama_aplikasi ?>
    </title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="<?= base_url(logo) ?>" rel="icon">
    <link href="<?= base_url(logo) ?>" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= base_url() ?>websiteAssets/vendor/aos/aos.css" rel="stylesheet">
    <link href="<?= base_url() ?>websiteAssets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>websiteAssets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url() ?>websiteAssets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>websiteAssets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>websiteAssets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <!-- Template Main CSS File -->
    <link href="<?= base_url() ?>websiteAssets/css/style.css" rel="stylesheet">
    <!-- Vendor JS Files -->
    <script src="<?= base_url() ?>assets/modules/jquery.min.js"></script>
    <script src="<?= base_url() ?>websiteAssets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="<?= base_url() ?>websiteAssets/vendor/aos/aos.js"></script>
    <script src="<?= base_url() ?>websiteAssets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>websiteAssets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="<?= base_url() ?>websiteAssets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="<?= base_url() ?>websiteAssets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="<?= base_url() ?>websiteAssets/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="<?= base_url() ?>websiteAssets/vendor/php-email-form/validate.js"></script>
    <script src="<?= base_url() ?>assets/modules/sweetalert2/sweetalert2.all.js"></script>

    <!-- Template Main JS File -->

    <!-- =======================================================
  * Template Name: BizLand
  * Updated: Mar 10 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/bizland-bootstrap-business-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
    <?php
    $kontak = $this->ermodel->selectWhere('section', ['slug' => 'contact_us'])->row();
    $meta_kontak = json_decode(@$kontak->meta);
    ?>
    <!-- ======= Top Bar ======= -->
    <section id="topbar" class="d-flex align-items-center">
        <div class="container d-flex justify-content-center justify-content-md-between">
            <div class="contact-info d-flex align-items-center">
                <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:<?= $meta_kontak->email ?>">
                        <?= $meta_kontak->email ?>
                    </a></i>
                <i class="bi bi-phone d-flex align-items-center ms-4"><span>
                        <?= $meta_kontak->telepon ?>
                    </span></i>
            </div>
            <div class="social-links d-none d-md-flex align-items-center">
                <?php if (@$meta_kontak->twitter)
                { ?>
                    <a href="<?= $meta_kontak->twitter ?>" class="twitter"><i class="bi bi-twitter"></i></a>
                <?php } ?>
                <?php if (@$meta_kontak->facebook)
                { ?>
                    <a href="<?= $meta_kontak->facebook ?>" class="facebook"><i class="bi bi-facebook"></i></a>
                <?php } ?>
                <?php if (@$meta_kontak->instagram)
                { ?>
                    <a href="<?= $meta_kontak->instagram ?>" class="instagram"><i class="bi bi-instagram"></i></a>
                <?php } ?>
            </div>
        </div>
    </section>

    <!-- ======= Header ======= -->
    <header id="header" class="d-flex align-items-center">
        <div class="container d-flex align-items-center justify-content-between">

            <h1 class="logo"><a href="<?= base_url() ?>">
                    <img src="<?= base_url(logo) ?>" style="width: 50px;">
                    <?= nama_perusahaan ?>
                </a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="<?= base_url() ?>" class="logo"><img src="<?= base_url(logo) ?>" alt=""></a> -->
            <?php
            $this->db->order_by('urutan', 'asc');
            $section = $this->ermodel->selectWhere('section', ['status' => 'ENABLE'])->result(); ?>
            <nav id="navbar" class="navbar">
                <ul>

                    <?php foreach ($section as $key => $value): ?>
                        <li><a class="nav-link scrollto" href="<?= base_url('#' . $value->slug . '-' . $value->id) ?>">
                                <?= $value->nama_section ?>
                            </a></li>
                    <?php endforeach; ?>
                    <!-- <li><a class="nav-link scrollto " href="<?= base_url('#product') ?>">Produk</a></li>
                    <li><a class="nav-link scrollto" href="<?= base_url('#team') ?>">Struktur Organisasi</a></li>
                    <li><a class="nav-link scrollto" href="<?= base_url('#faq') ?>">FAQ</a></li>
                    <li><a class="nav-link scrollto" href="<?= base_url('#contact') ?>">Kontak Kami</a></li> -->
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    <?= $web_theme ?>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">

        <div class="footer-newsletter">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <h4>Dapatkan notifikasi terbaru kami.</h4>
                        <form action="<?= base_url('website/store_subs') ?>" method="post" id="form-subs"
                            style="background: transparent !important">
                            <div class="row g-3">
                                <div class="col-sm-9">
                                    <input type="text" name="email" class="form-control" placeholder="Email Anda"
                                        aria-label="Email">
                                </div>
                                <div class="col-sm">
                                    <div class="btn btn-primary btn-send w-100" onclick="storeSubs()">Subscribe</div>
                                </div>
                            </div>
                            <!-- <input type="email" name="email" />
                             -->
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-top">
            <div class="container">
                <div class="row">

                    <div class="col-lg-3 col-md-6 footer-contact">
                        <h3>
                            <?= nama_perusahaan ?><span>.</span>
                        </h3>
                        <p>
                            <?= $meta_kontak->alamat ?>
                            <strong>Email:</strong>
                            <?= $meta_kontak->email ?><br>
                            <strong>Phone:</strong>
                            <?= $meta_kontak->telepon ?><br>
                        </p>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Useful Links</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Halaman Utama</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Tentang Kami</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Service</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Produk</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Team</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Kontak Kami</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Our Services</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>
                            <?= judul_text_footer ?>
                        </h4>
                        <p>
                            <?= text_footer ?>
                        </p>
                        <div class="social-links mt-3">
                            <?php if (@$meta_kontak->twitter)
                            { ?>
                                <a href="<?= $meta_kontak->twitter ?>" class="twitter"><i class="bi bi-twitter"></i></a>
                            <?php } ?>
                            <?php if (@$meta_kontak->facebook)
                            { ?>
                                <a href="<?= $meta_kontak->facebook ?>" class="facebook"><i class="bi bi-facebook"></i></a>
                            <?php } ?>
                            <?php if (@$meta_kontak->instagram)
                            { ?>
                                <a href="<?= $meta_kontak->instagram ?>" class="instagram"><i
                                        class="bi bi-instagram"></i></a>
                            <?php } ?>
                        </div>
                        <?php
                        $online_shop = json_decode(online_shop);
                        foreach ($online_shop->nama as $key => $val):
                            if ($val):
                                ?>
                                <a href="<?= $online_shop->link[$key] ?>" target="_blank" rel="noopener noreferrer">
                                    <img src="<?= base_url($online_shop->logo[$key]) ?>" alt="<?= $val ?>"
                                        class="img-responsive w-100 mt-3">
                                </a>
                            <?php endif;
                        endforeach; ?>
                    </div>

                </div>
            </div>
        </div>

        <div class="container py-4">
            <div class="copyright">
                &copy;
                <?= copyright ?>
            </div>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/bizland-bootstrap-business-template/ -->
                <!-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> -->
            </div>
        </div>
    </footer><!-- End Footer -->

    <div id="preloader"></div>

    <?php if (@$meta_kontak->whatsapp): ?>
        <a href="https://api.whatsapp.com/send?phone=<?= $meta_kontak->whatsapp ?>"
            class="float-wa  d-flex align-items-center justify-content-center" target="_blank">
            <i class='bx bxl-whatsapp'></i>
        </a>
    <?php endif ?>


    <script src="<?= base_url() ?>websiteAssets/js/main.js"></script>
    <script>
        function storeSubs() {
            Swal.fire({
                title: `<div class="spinner-border text-primary" role="status"></div>`,
                text: 'Mohon Tunggu Sebentar',
                showConfirmButton: false,
                allowOutsideClick: false
            });
            var form = $('#form-subs');
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
                            html: 'Terima Kasih Telah Subscribe Kami',
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
                            html: res.message,
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
        // Disable Enter Submit
        $(document).ready(function () {
            $(window).keydown(function (event) {
                if (event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });
        });
    </script>
</body>

</html>