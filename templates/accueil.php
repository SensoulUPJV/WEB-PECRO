<?php
    $_SESSION['title'] = "".NOMSITE;
    $_SESSION['meta_titre'] = "Promenades de groupe pour chien - My dog friends";
    $_SESSION['meta_description'] = "Envie d'une promenade pour profiter du grand air ? Venez organiser une promenade de groupe avec votre chien pour qu'il rencontre de nouveaux amis. ".NOMSITE;
    $_SESSION['meta_image'] = "assets/img/sliders/border-my-dog-friends.jpg";
    $_SESSION['meta_url'] = URLSITEWEB;
    $_SESSION['meta_img_type'] = "jpg";
    $_SESSION['meta_img_alt'] = "My dog friends";

    get_head();
    get_header();
    
    $lstProduit = $Produit->getLstProduitOnline(null, "id DESC", 8);
?>

    <div class="slider-area section-padding-1">
        <div class="slider-active owl-carousel nav-style-1">
            <div class="single-slider slider-height-1 bg-paleturquoise">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-6">
                            <div class="slider-content">
                                <h1>Impression 3D de figurines</h1>
                                <p>Les meilleures figurines sur le marché. Une impression d'une qualité hors du commun.</p>
                                <div class="slider-btn btn-hover">
                                    <a href="<?=URLSITEWEB?>catalogue/figurine">Découvrez nos figurines<i class="sli sli-basket-loaded"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-6">
                            <div class="slider-single-img">
                                <img src="<?=URLSITEWEB?>media/banner/fig_image.jpeg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="single-slider slider-height-1 bg-paleturquoise">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-6">
                            <div class="slider-conten">
                                <h1>Impression 3D de voitures</h1>
                                <p>MondelliCorp est aussi spécialisé dans l'impression 3D de voitures miniatures. De nombreuses miniatures fidèles aux voitures originelles sont disponibles dès maintenant ! </p>
                                <div class="slider-btn btn-hover">
                                    <a href="<?=URLSITEWEB?>catalogue/voiture">Découvrez nos voitures<i class="sli sli-basket-loaded"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 col-sm-6">
                            <div class="slider-single-img">
                                <img src="<?=URLSITEWEB?>media/banner/3daccess-new-3d-model.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="banner-area pt-100 pb-65">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="single-banner mb-30 scroll-zoom">
                        <a href="<?=URLSITEWEB?>catalogue/"><img class="animated" src="assets/img/banner/banner-1.png" alt=""></a>
                        <div class="banner-content banner-position-1">
                            <h3>Nouveau</h3>
                            <h2>Jeux vidéo</h2>
                            <a href="<?=URLSITEWEB?>catalogue/">Découvrir</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="single-banner mb-30 scroll-zoom">
                        <a href="<?=URLSITEWEB?>catalogue/"><img class="animated" src="assets/img/banner/banner-2.png" alt=""></a>
                        <div class="banner-content banner-position-2">
                            <h2>Décoration</h2>
                            <a href="<?=URLSITEWEB?>catalogue/">Découvrir</a>
                        </div>
                    </div>
                    <div class="single-banner mb-30 scroll-zoom">
                        <a href="<?=URLSITEWEB?>catalogue/"><img class="animated" src="assets/img/banner/banner-3.png" alt=""></a>
                        <div class="banner-content banner-position-2">
                            <h2>Pour la maison</h2>
                            <a href="<?=URLSITEWEB?>catalogue/">Découvrir</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="product-area pb-150">
        <div class="container">
            <div class="section-title text-center pb-60">
                <h2>Découvrez nos produits</h2>
                <p> Des figurines et des voitures pour tout les gouts </p>
            </div>
            <div class="arrivals-wrap item-wrapper">
                <div class="ht-products row">
                    <?php 
                    foreach($lstProduit as $dataProduit){
                        $promotion = $Produit->getPromotionProduit($dataProduit['id'], $dataProduit['prix']);
                        $Produit->printProduitGrid(true, $dataProduit['id'], $dataProduit['nom'], $dataProduit['identifiant'], $dataProduit['image_principale'], $dataProduit['prix'], $promotion, $dataProduit['id_tva']);
                    }
                    ?>
                </div>
                <div class="show-more-btn text-center mt-10 toggle-btn">
                    <a href="catalogue" class="btn-simple m-auto">Consulter nos produits</a>
                </div>
            </div>
        </div>
    </div>
    <div class="banner-area pb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="single-banner mb-30 scroll-zoom">
                        <a href="sur-mesure/modelisation/"><img src="media/banner/modelisation-3daccess.jpg" alt=""></a>
                        <div class="banner-content banner-position-3">
                            <h3>Modélisation</h3>
                            <h2>Création de votre projet, réparation, ...</h2>
                            <a href="sur-mesure/modelisation/">Découvrir</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="single-banner mb-30 scroll-zoom">
                        <a href="sur-mesure/impression/"><img src="media/banner/3d-printer-3daccess.jpg" alt=""></a>
                        <div class="banner-content banner-position-3">
                            <h3>Impression sur mesure</h3>
                            <h2>Un objet à votre image</h2>
                            <a href="sur-mesure/impression/">Découvrir</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="feature-area">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-4">
                    <div class="single-feature mb-40">
                        <div class="feature-icon">
                            <img src="assets/img/icon-img/support.png" alt="">
                        </div>
                        <div class="feature-content">
                            <h4>Service à l'écoute</h4>
                            <p>Notre objectif, créer l'objet de vos rêves.</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4">
                    <div class="single-feature mb-40 pl-50">
                        <div class="feature-icon">
                            <img src="assets/img/icon-img/security.png" alt="">
                        </div>
                        <div class="feature-content">
                            <h4>Controle qualité</h4>
                            <p>Vérification des objets en suivant nos exigences qualités.</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4">
                    <div class="single-feature mb-40">
                        <div class="feature-icon">
                            <img src="assets/img/icon-img/free-shipping.png" alt="">
                        </div>
                        <div class="feature-content">
                            <h4>Suivi complet de votre projet</h4>
                            <p>De la conception à la livraison, nous sommes à votre écoute.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="blog-area pt-50 pb-65">
        <div class="container">
            <div class="section-title text-center pb-60">
                <h2>Ils nous ont fais confiance, pourquoi pas vous ?</h2>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="blog-wrap mb-30 mr-20 text-center scroll-zoom">
                        <div class="blog-img mb-25 partners-img-index">
                            <a href="https://s3-gp38.kevinpecro.info/" target="_blank"><img src="media/partners/MarcosIndustrie_logo.png" alt=""></a>
                        </div>
                        <div class="blog-content">
                            <h3><a href="https://www.enedis.fr/" target="_blank">MarcosIndustries</a></h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="blog-wrap mb-30 ml-20 text-center scroll-zoom">
                        <div class="blog-img mb-25 partners-img-index">
                            <a href="https://www.boulanger.com/" target="_blank"><img src="media/partners/logo-boulanger.png" alt=""></a>
                        </div>
                        <div class="blog-content">
                            <h3><a href="https://www.boulanger.com/" target="_blank">Boulanger</a></h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="blog-wrap mb-30 ml-20 text-center scroll-zoom">
                        <div class="blog-img mb-25 partners-img-index">
                            <a href="https://fr.pg.com/" target="_blank"><img src="media/partners/logo-procter-et-gamble.png" alt=""></a>
                        </div>
                        <div class="blog-content">
                            <h3><a href="https://fr.pg.com/" target="_blank">Procter & Gamble</a></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
<?php
    get_footer();
?>