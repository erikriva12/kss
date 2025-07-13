<main id="main">
    <?php foreach ($section as $key => $val):
        $meta = json_decode(@$val->meta);
        ?>
        <?php if ($val->slug == 'banner'):
            ?>
            <section id="banner-<?= $val->id ?>">
                <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <?php foreach ($meta->foto_banner as $key_meta => $val_meta): ?>
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?= $key_meta ?>"
                                <?= ($key_meta == 0) ? ' class="active" aria-current="true"' : '' ?>
                                aria-label="Slide <?= $key_meta + 1 ?>"></button>
                        <?php endforeach; ?>


                    </div>
                    <div class="carousel-inner">
                        <?php foreach ($meta->foto_banner as $key_meta => $val_meta): ?>


                            <div class="carousel-item <?= ($key_meta == 0) ? 'active' : '' ?>">
                                <div class="text-banner" data-aos="zoom-out" data-aos-delay="100">
                                    <?= $meta->keterangan_banner[$key_meta] ?>
                                    <div class="d-flex">
                                        <a href="#about" class="btn-get-started scrollto">Get Started</a>
                                    </div>
                                </div>
                                <div style="
                                    background: url(<?= base_url($meta->foto_banner[$key_meta]) ?>) top left;
                                    height:75vh; 
                                    width: 100%
                                    " class="img-banner">
                                </div>


                            </div>
                        <?php endforeach; ?>


                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

            </section>
        <?php elseif ($val->slug == 'about_us'): ?>
            <!-- ======= Featured Services Section ======= -->
            <section id="about_us-<?= $val->id ?>" class="featured-services">
                <div class="container" data-aos="fade-up">
                    <div class="row justify-content-center">
                        <?php foreach ($meta->judul_slogan as $key_slogan => $value_slogan): ?>
                            <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                                <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
                                    <div class="icon"><i class="<?= $meta->icon_slogan[$key_slogan] ?>"></i></div>
                                    <h4 class="title"><a href="">
                                            <?= $meta->judul_slogan[$key_slogan] ?>
                                        </a></h4>
                                    <p class="description">
                                        <?= $meta->keterangan_slogan[$key_slogan] ?>
                                    </p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
            <!-- End Featured Services Section -->
            <!-- ======= About Section ======= -->
            <section id="about" class="about section-bg">
                <div class="container" data-aos="fade-up">
                    <div class="section-title">
                        <h2>
                            <?= $val->nama_section ?>
                        </h2>
                        <h3>
                            <?= $meta->nama_perusahaan ?>
                        </h3>
                        <div>
                            <?= $meta->keterangan_singkat ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6" data-aos="fade-right" data-aos-delay="100">
                            <img src="<?= base_url($meta->foto_about) ?>" class="img-fluid" alt="" />
                        </div>
                        <div class="col-lg-6 pt-4 pt-lg-0 content d-flex flex-column justify-content-center" data-aos="fade-up"
                            data-aos-delay="100">
                            <h3>
                                <?= $meta->nama_perusahaan ?>
                            </h3>
                            <div>
                                <?= $meta->keterangan_panjang ?>
                            </div>
                            <ul>
                                <li>
                                    <i class="bx bx-store-alt"></i>
                                    <div>
                                        <h5>Visi</h5>
                                        <div>
                                            <?= $meta->visi ?>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <i class="bx bx-images"></i>
                                    <div>
                                        <h5>Misi</h5>
                                        <div>
                                            <?= $meta->misi ?>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End About Section -->
            <!-- ======= Counts Section ======= -->
            <section id="counts" class="counts">
                <div class="container" data-aos="fade-up">
                    <div class="row justify-content-center">
                        <?php foreach ($meta->nama_counting as $key_counting => $val): ?>
                            <div class="col-lg-3 col-md-6">
                                <div class="count-box">
                                    <i class="<?= $meta->icon_counting[$key_counting] ?>"></i>
                                    <span data-purecounter-start="0"
                                        data-purecounter-end="<?= $meta->jumlah_counting[$key_counting] ?>"
                                        data-purecounter-duration="1" class="purecounter"></span>
                                    <p>
                                        <?= $meta->nama_counting[$key_counting] ?>
                                    </p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
            <!-- End Counts Section -->
            <!-- ======= Clients Section ======= -->
            <section id="clients" class="clients section-bg">
                <div class="container" data-aos="zoom-in">
                    <div class="row justify-content-center">
                        <?php foreach ($meta->nama_client as $key_client => $val): ?>
                            <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                                <a href="<?= $meta->website_client[$key_client] ?>" target="blank">
                                    <img src="<?= base_url($meta->logo_client[$key_client]) ?>" class="img-fluid"
                                        alt="<?= $meta->nama_client[$key_client] ?>" />
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
            <!-- End Clients Section -->
        <?php elseif ($val->slug == 'testimonial'): ?>
            <!-- ======= Testimonials Section ======= -->
            <section id="testimonial-<?= $val->id ?>" class="testimonials">
                <div class="container" data-aos="zoom-in">
                    <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
                        <div class="swiper-wrapper">
                            <?php foreach ($testimonial as $key_testi => $val): ?>
                                <div class="swiper-slide">
                                    <div class="testimonial-item">
                                        <img src="<?= base_url($val->foto) ?>" class="testimonial-img" alt="" />
                                        <h3>
                                            <?= $val->nama ?>
                                        </h3>
                                        <h4>
                                            <?= $val->perusahaan ?>
                                        </h4>

                                        <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                        <?= $val->isi_testimonial ?>
                                        <i class="bx bxs-quote-alt-right quote-icon-right"></i>

                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </section>
            <!-- End Testimonials Section -->
        <?php elseif ($val->slug == 'product'): ?>
            <!-- ======= product Section ======= -->
            <section id="product-<?= $val->id ?>" class="portfolio">
                <div class="container" data-aos="fade-up">
                    <div class="section-title">
                        <h2>
                            <?= $val->nama_section ?>
                        </h2>
                        <h3>Lihat <span>Produk</span> Kami</h3>
                        <p>Lihat berbagai macam produk kami.</p>
                    </div>
                    <?php
                    $kategori_produk = array_unique(array_column($produk, 'kategori_produk_nama'));
                    ?>
                    <div class="row" data-aos="fade-up" data-aos-delay="100">
                        <div class="col-lg-12 d-flex justify-content-center">
                            <ul id="portfolio-flters">
                                <li data-filter="*" class="filter-active">All</li>
                                <?php foreach ($kategori_produk as $key => $val)
                                { ?>
                                    <li data-filter=".filter-<?= $val ?>"><?= $val ?></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
                        <?php
                        foreach ($produk as $key => $val):
                            $json_foto = json_decode(@$val->foto_json);
                            ?>
                            <div class="col-lg-4 col-md-6 portfolio-item filter-<?= $val->kategori_produk_nama ?>">
                                <img src="<?= base_url($val->foto_utama) ?>" class="img-fluid" alt="" />
                                <div class="portfolio-info">
                                    <h4>
                                        <?= $val->nama ?>
                                    </h4>
                                    <p>
                                        <?= $val->kategori_produk_nama ?>
                                    </p>
                                    <a href="<?= base_url($val->foto_utama) ?>" data-gallery="portfolioGallery"
                                        class="portfolio-lightbox preview-link" title="<?= $val->nama ?>">
                                        <i class='bx bx-search-alt-2'></i>
                                    </a>
                                    <a href="<?= base_url('website/detail-produk/' . $val->id) ?>" class="details-link"
                                        title="More Details"><i class="bx bx-link"></i></a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
            <!-- End Portfolio Section -->
        <?php elseif ($val->slug == 'team'):
            ?>
            <!-- ======= Team Section ======= -->
            <section id="team-<?= $val->id ?>" class="team section-bg">
                <div class="container" data-aos="fade-up">
                    <div class="section-title">
                        <h2>
                            <?= $val->nama_section ?>
                        </h2>
                        <!-- <h3>
                            <?= $meta->nama_perusahaan ?>
                        </h3> -->
                        <p>
                            <?= $meta->keterangan_singkat ?>
                        </p>
                    </div>
                    <div class="row justify-content-center">
                        <?php foreach ($meta->nama as $key_team => $val): ?>
                            <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
                                <div class="member">
                                    <div class="member-img">
                                        <img src="<?= base_url($meta->foto[$key_team]) ?>" class="img-fluid" alt="" />
                                    </div>
                                    <div class="member-info">
                                        <h4>
                                            <?= $meta->nama[$key_team] ?>
                                        </h4>
                                        <span>
                                            <?= $meta->jabatan[$key_team] ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
            <!-- End Team Section -->
        <?php elseif ($val->slug == 'faq'): ?>
            <!-- ======= Frequently Asked Questions Section ======= -->
            <section id="faq-<?= $val->id ?>" class="faq section-bg">
                <div class="container" data-aos="fade-up">
                    <div class="section-title">
                        <h2>
                            <?= $val->nama_section ?>
                        </h2>
                        <h3>Frequently Asked <span>Questions</span></h3>
                        <p>
                            <?= $meta->keterangan_singkat ?>
                        </p>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-xl-10">
                            <ul class="faq-list">
                                <?php foreach ($meta->pertanyaan_faq as $key => $val): ?>
                                    <li>
                                        <div data-bs-toggle="collapse" class="collapsed question" href="#faq<?= $key ?>">
                                            <?= $meta->pertanyaan_faq[$key] ?>
                                            <i class="bi bi-chevron-down icon-show"></i>
                                            <i class="bi bi-chevron-up icon-close"></i>
                                        </div>
                                        <div id="faq<?= $key ?>" class="collapse" data-bs-parent=".faq-list">
                                            <?= $meta->jawaban_faq[$key] ?>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End Frequently Asked Questions Section -->
        <?php elseif ($val->slug == 'contact_us'): ?>
            <!-- ======= Contact Section ======= -->
            <section id="contact_us-<?= $val->id ?>" class="contact">
                <div class="container" data-aos="fade-up">
                    <div class="section-title">
                        <h2>
                            <?= $val->nama_section ?>
                        </h2>
                        <?= $meta->keterangan_singkat ?>
                    </div>
                    <div class="row" data-aos="fade-up" data-aos-delay="100">
                        <div class="col-lg-6">
                            <div class="info-box mb-4">
                                <i class="bx bx-map"></i>
                                <h3>Alamat Kami</h3>
                                <p>
                                    <?= $meta->alamat ?>
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="info-box mb-4">
                                <i class="bx bx-envelope"></i>
                                <h3>Email Kami</h3>
                                <p>
                                    <?= $meta->email ?>
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="info-box mb-4">
                                <i class="bx bx-phone-call"></i>
                                <h3>Telepon Kami</h3>
                                <p>
                                    <?= $meta->telepon ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row" data-aos="fade-up" data-aos-delay="100">
                        <div class="col-lg-6">
                            <iframe class="mb-4 mb-lg-0" src="<?= $meta->google_map ?>" frameborder="0"
                                style="border: 0; width: 100%; height: 384px;" allowfullscreen></iframe>
                        </div>
                        <div class="col-lg-6">
                            <form action="<?= base_url('website/send_pesan_kontak') ?>" method="post" role="form"
                                id="pesan-kontak" class="php-email-form">
                                <div class="row">
                                    <div class="col form-group">
                                        <input type="text" name="nama" class="form-control" id="name" placeholder="Nama Anda"
                                            required />
                                    </div>
                                    <div class="col form-group">
                                        <input type="email" class="form-control" name="email" id="email"
                                            placeholder="Email Anda" required />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject"
                                        required />
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" name="pesan" rows="5" placeholder="Pesan"
                                        required></textarea>
                                </div>
                                <div class="text-center">
                                    <div class="btn btn-primary btn-send" onclick="sendPesan()">
                                        <i class='bx bx-paper-plane'></i> Kirim pesan

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End Contact Section -->
        <?php endif; ?>
    <?php endforeach; ?>
</main>
<script>
    function sendPesan() {
        Swal.fire({
            title: `<div class="spinner-border text-primary" role="status"></div>`,
            text: 'Mohon Tunggu Sebentar',
            showConfirmButton: false,
            allowOutsideClick: false
        });
        var form = $('#pesan-kontak');
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
                        html: 'Pesan anda berhasil dikirim',
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
</script>