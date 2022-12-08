<?php

header("HTTP/1.0 404 Not Found");

get_head();
get_header();

?>
<div class="container">
    <div class="row justify-content-center spacet-3"><!--align-items-center-->
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h1 class="text-center">Oups ! Je n'arrive pas à trouver votre page.</h1>
        </div>
        <div class="col-12 text-center">
            <img src="/assets/img/emoji/dog_bad.png" class="w-25">
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 text-center">
            <a href="organiser-une-promenade" class="theme_link mt-5 w-75">Organiser une promenade</a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 text-center">
            <a href="participer-a-une-promenade" class="theme_link mt-5 w-75">Participer à une promenade</a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 text-center">
            <a href="blog" class="theme_link mt-5 w-75">Blog</a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 text-center">
            <a href="nos-partenaires" class="theme_link mt-5 w-75">Nos partenaires</a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 text-center">
            <a href="s'inscrire-se-connecter" class="theme_link mt-5 w-75">S'inscrire / Se connecter</a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 text-center">
            <a href="contact" class="theme_link mt-5 w-75">Contact</a>
        </div>
    </div>
</div>


<?php
get_footer();
?>