<?php

    get_head();
    get_header();
    
    $lstBlog = $Blog->getLstBlog("statut=1");
    
?>
<div class="breadcrumb-area pt-35 pb-35 bg-gray">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <ul>
                <li class="active">Blog</li>
            </ul>
        </div>
    </div>
</div>
<div class="blog-area pt-100 pb-100">
    <div class="container">
        <div class="row">
            <?php
            foreach($lstBlog as $article){ ?>
            <div class="col-lg-6 col-md-6">
                <div class="blog-wrap mb-40 text-center scroll-zoom">
                    <div class="blog-img mb-25">
                        <a href="<?=URLSITEWEB.'blog/'.$article['identifiant'].'/'?>"><img src="<?=URLSITEWEB.$article['image']?>" alt=""></a>
                    </div>
                    <div class="blog-content">
                        <h3><a href="<?=URLSITEWEB.'blog/'.$article['identifiant'].'/'?>"><?=$article['titre']?></a></h3>
                        <div class="blog-meta blog-mrg-border">
                            <ul>
                                <li><a href="<?=URLSITEWEB.'blog/'.$article['identifiant'].'/'?>"><?=$Tools->convert_date_to_print($article['date_online'])?></a></li>
                            </ul>
                        </div>
                        <p><?=$article['resume']?></p>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
        <?php /*
        <div class="pro-pagination-style text-center mt-20 pagination-mrg-xs-none">
         
            <ul>
                <li><a class="prev" href="#"><i class="sli sli-arrow-left"></i></a></li>
                <li><a class="active" href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a class="next" href="#"><i class="sli sli-arrow-right"></i></a></li>
            </ul>
        </div>
         */?>
    </div>
</div>
<?php
    get_footer();
?>