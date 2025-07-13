<?php
$datameta = json_decode($produk->meta);
$datafoto = json_decode($produk->foto_json);
?>
<main id="main" data-aos="fade-up">

    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h2>
                    <?= $produk->nama ?>
                </h2>
                <ol>
                    <li><a href="index.html">Halaman Utama</a></li>
                    <li><a href="<?= base_url('produk') ?>">Produk</a></li>
                    <li>
                        <?= $produk->nama ?>
                    </li>
                </ol>
            </div>

        </div>
    </section><!-- Breadcrumbs Section -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
        <div class="container">

            <div class="row gy-4">

                <div class="col-lg-8">
                    <div class="portfolio-details-slider swiper">
                        <div class="swiper-wrapper align-items-center">
                            <?php foreach ($datafoto as $key_foto => $val_foto)
                            { ?>

                                <div class="swiper-slide">
                                    <img src="<?= base_url($val_foto) ?>" alt="">
                                </div>
                            <?php } ?>

                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="portfolio-info">
                        <h3>Informasi Produk</h3>
                        <ul>
                            <?php foreach ($datameta->nama_informasi as $key => $value)
                            { ?>

                                <li>
                                    <strong>
                                        <?= $value ?>
                                    </strong>:
                                    <?= $datameta->keterangan_informasi[$key] ?>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="portfolio-description">
                        <?= $produk->informasi ?>
                    </div>
                </div>

            </div>

        </div>
    </section><!-- End Portfolio Details Section -->

</main><!-- End #main -->