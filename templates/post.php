<?php

get_head();
get_header();
$identifiant = $Tools->data_secure($_GET['identifiant']);
$article = $Blog->getBlog("identifiant='".$identifiant."' AND statut=1");
    
?>
<div class="breadcrumb-area pt-35 pb-35 bg-gray">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <ul>
                <li>
                    <a href="blog/">Blog</a>
                </li>
                <li class="active"><?=$article['titre']?></li>
            </ul>
        </div>
    </div>
</div>
<div class="blog-area pt-100 pb-100">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-lg-9">
                <div class="blog-details-wrapper mr-20">
                    <div class="blog-details-top">
                        <div class="blog-details-img">
                            <img alt="" src="<?=URLSITEWEB.$article['image']?>">
                        </div>
                        <div class="blog-details-content">
                            <h3><?=$article['titre']?></h3>
                            <div class="blog-details-meta">
                                <ul>
                                    <li><?=$Tools->convert_date_to_print($article['date_online'])?></li>
                                </ul>
                            </div>
                            <?=$article['contenu']?>
                        </div>
                    </div>
                    <div class="tag-share">
                        <div class="blog-share">
                            <div class="share-social">
                                <?php
                                    $url_facebook = URLSITEWEB.'blog/post/'.$post['url'].'/';
                                    $url_facebook = str_replace(":", "%3A", $url_facebook);
                                    $url_facebook = str_replace("/", "%2F", $url_facebook);
                                ?>
                                <ul>
                                    <li>
                                        <a href="https://www.facebook.com/sharer.php?u=<?=$url_facebook
                                        ?>" target="_blank" id="share-facebook"><i class="fab fa-facebook"></i> Partager</a>
                                    </li>
                                    <li>
                                        <a href="https://twitter.com/share?ref_src=<?=$url_facebook
                                        ?>" target="_blank" id="share-twitter"><i class="fab fa-twitter"></i> Partager</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php /*
                    <div class="next-previous-post">
                        <a href="#"> <i class="sli sli-arrow-left"></i> Précédent</a>
                        <a href="#">Suivant <i class="sli sli-arrow-right"></i></a>
                    </div>*/?>
                </div>
            </div>
            <?php /*
            <div class="col-lg-3">
                <div class="sidebar-style">
                    <div class="sidebar-widget">
                        <h4 class="pro-sidebar-title">Rechercher </h4>
                        <div class="pro-sidebar-search mb-50 mt-25">
                            <form class="pro-sidebar-search-form" action="#">
                                <input type="text" placeholder="Votre recherche">
                                <button>
                                    <i class="sli sli-magnifier"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="sidebar-widget mt-40">
                        <h4 class="pro-sidebar-title">Recent Post </h4>
                        <div class="sidebar-project-wrap mt-30">
                            <div class="single-sidebar-blog">
                                <div class="sidebar-blog-img">
                                    <a href="#"><img src="assets/img/blog/sidebar-1.jpg" alt=""></a>
                                </div>
                                <div class="sidebar-blog-content">
                                    <span>Photography</span>
                                    <h4><a href="#">Demo Product Name</a></h4>
                                </div>
                            </div>
                            <div class="single-sidebar-blog">
                                <div class="sidebar-blog-img">
                                    <a href="#"><img src="assets/img/blog/sidebar-2.jpg" alt=""></a>
                                </div>
                                <div class="sidebar-blog-content">
                                    <span>Branding</span>
                                    <h4><a href="#">Demo Product Name</a></h4>
                                </div>
                            </div>
                            <div class="single-sidebar-blog">
                                <div class="sidebar-blog-img">
                                    <a href="#"><img src="assets/img/blog/sidebar-3.jpg" alt=""></a>
                                </div>
                                <div class="sidebar-blog-content">
                                    <span>Design</span>
                                    <h4><a href="#">Demo Product Name</a></h4>
                                </div>
                            </div>
                            <div class="single-sidebar-blog">
                                <div class="sidebar-blog-img">
                                    <a href="#"><img src="assets/img/blog/sidebar-1.jpg" alt=""></a>
                                </div>
                                <div class="sidebar-blog-content">
                                    <span>Photography</span>
                                    <h4><a href="#">Demo Product Name</a></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> */?>
        </div>
    </div>
</div>
<?php
    get_footer();
?>