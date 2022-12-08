<?php

    get_head();
    get_header();

?>

<div class="breadcrumb-area pt-35 pb-35 bg-gray">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <ul>
                <li class="active">Mentions légales</li>
            </ul>
        </div>
    </div>
</div>
<div class="shop-area pt-5 pb-100">
    <div class="container">
        <div class="row flex-row-reverse">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left">
                <h1 class="h1-theme">Mentions légales</h1>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-left">
                <h2 class="mb-4">Qui sommes-nous ?</h2>
                <p>Propriétaire du site : <?=ENTREPRISEDENOMINATION?></p>
                <p>Création du site et maintenance : <?=ENTREPRISEDENOMINATION?></p>
                <p>Siège social : <?=ENTREPRISEADRESSECOMPLETE?></p>
                <p>Immatriculé au RCS d’Amiens le 01/04/2018 sous le numéro <?=SIRET?>.</p>
                <p>Téléphone : <?=CONTACTTELEPHONE?></p>
                <p>Mail : <?=CONTACTEMAIL?></p>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-left">
                <h2 class="mb-4">Directeur de la publication :</h2>
                <p>Vittorio Mondelli : <?=CONTACTEMAIL?></p>
                <h2 class="mb-4">Hébergeur du site :</h2>
                <p>OVH SAS</p>
                <p>Capital : 10 350 €</p>
                <p>Siège social : 62 rue des 3 cailloux - 80000 Amiens - France</p>
            </div>
        </div>
    </div>
</div>


<?php
    get_footer();
?>