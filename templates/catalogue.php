<?php
$categorie = "";

if(isset($_POST['search']) && $_POST['search']){
    $search = $Tools->data_secure($_POST['search']);
    $searchSql = " nom like '%".$search."%' OR ".
        "description like '%".$search."%' OR".
        " nom like '%".strtolower($search)."%' OR ".
        "description like '%".strtolower($search)."%' OR".
        " nom like '%".strtoupper($search)."%' OR ".
        "description like '%".strtoupper($search)."%'";
}

if(isset($_GET['identifiant']) && $_GET['identifiant']){
    $categorie = $Produit->getCategorie('identifiant = "'.$Tools->data_secure($_GET['identifiant']).'"');
    if($categorie && $categorie['statut'] == 1)
        if($searchSql)
            $lstProduit = $Produit->getLstProduitOnline("categorie LIKE '%;".$categorie['id'].";%' AND ( ".$searchSql." )");
        else
            $lstProduit = $Produit->getLstProduitOnline("categorie LIKE '%;".$categorie['id'].";%'");
    else
        $Tools->redirection(URLSITEWEB.'catalogue/');
}else
    if($searchSql)
        $lstProduit = $Produit->getLstProduitOnline($searchSql);
    else
        $lstProduit = $Produit->getLstProduitOnline();

$link_header = "catalogue/";
$link_header_to_print = "";

function printCategorieParent($idCategorie){
    global $Produit, $link_header, $link_header_to_print;
    $categorieParent = $Produit->getCategorie("id='".$idCategorie."'");
    $link_header_to_print = '<li><a href="'.$link_header.$categorieParent['identifiant'].'/">'.$categorieParent['nom'].'</a></li>'.$link_header_to_print;
    if($categorieParent['id_parent']) printCategorieParent($categorieParent['id_parent']);
}

get_head();
get_header();

?>

<div class="breadcrumb-area pt-35 pb-35 bg-gray">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <ul>
                <li>
                    <a href="<?=$link_header?>">Catalogue</a>
                </li>
                <?php
                if(isset($categorie['id_parent']) && $categorie['id_parent']){
                    printCategorieParent($categorie['id_parent']);
                    echo $link_header_to_print;
                }
                if($categorie) echo '<li class="active">'.$categorie['nom'].'</li>';
                ?>
            </ul>
        </div>
    </div>
</div>
<div class="shop-area pt-5 pb-100">
    <div class="container">
        <div class="row flex-row-reverse">
            <?php if($search) : ?>
                <div class="col-12">
                    <h2 class="mb-1">Votre recherche : <?=$search?></h2>
                </div>
            <?php endif; ?>
            <div class="col-lg-9 pt-5">
                <div class="shop-top-bar">
                    <div class="select-shoing-wrap">
                        <div class="shop-select">
                            <select>
                                <option value="">Prix - à +</option>
                                <option value="">Prix + à -</option>
                                <option value="">Nom A à Z</option>
                                <option value="">Nom Z à A</option>
                            </select>
                        </div>
                        <?php $nb_produit = count($lstProduit); ?>
                        <p>Produits <?php if($nb_produit>=1) echo "1";?> à <?=$nb_produit?></p>
                    </div>
                    <?php /*<div class="shop-tab nav">
                            <a class="active" href="#shop-1" data-toggle="tab">
                                <i class="sli sli-grid"></i>
                            </a>
                            <a href="#shop-2" data-toggle="tab">
                                <i class="sli sli-menu"></i>
                            </a>
                        </div>*/?>
                </div>
                <div class="shop-bottom-area mt-35">
                    <div class="tab-content jump">
                        <div id="shop-1" class="tab-pane active">
                            <div class="row ht-products">
                                <?php
                                foreach($lstProduit as $dataProduit){
                                    $promotion = $Produit->getPromotionProduit($dataProduit['id'], $dataProduit['prix']);
                                    $Produit->printProduitGrid(false, $dataProduit['id'], $dataProduit['nom'], $dataProduit['identifiant'], $dataProduit['image_principale'], $dataProduit['prix'], $promotion, $dataProduit['id_tva']);
                                }
                                ?>
                            </div>
                        </div>
                        <?php /*<div id="shop-2" class="tab-pane">
                                <?php
                                foreach($lstProduit as $dataProduit){
                                    $promotion = $Produit->getPromotionProduit($dataProduit['id'], $dataProduit['prix']);
                                    $Produit->printProduitGridList($dataProduit['id'], $dataProduit['nom'], $dataProduit['identifiant'], $dataProduit['image_principale'], $dataProduit['prix'], $promotion, $dataProduit['id_tva']);
                                }
                                ?>
                            </div>*/?>
                    </div>
                    <?php /*<div class="pro-pagination-style text-center mt-30">
                            <ul>
                                <li><a class="prev" href="#"><i class="sli sli-arrow-left"></i></a></li>
                                <li><a class="active" href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a class="next" href="#"><i class="sli sli-arrow-right"></i></a></li>
                            </ul>
                        </div>*/ ?>
                </div>
            </div>
            <div class="col-lg-3 pt-5">
                <div class="sidebar-style mr-30">
                    <div class="sidebar-widget">
                        <h4 class="pro-sidebar-title">Rechercher </h4>
                        <div class="pro-sidebar-search mb-50 mt-25">
                            <form class="pro-sidebar-search-form" action="" method="POST">
                                <input type="text" name="search" placeholder="Votre recherche" <?php if($search) echo 'value="'.$search.'"';?>>
                                <button>
                                    <i class="sli sli-magnifier"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="sidebar-widget">
                        <h4 class="pro-sidebar-title">Catégorie</h4>
                        <div class="sidebar-widget-list mt-30 scroll-list">
                            <ul>
                                <?php
                                $lstCategorie = $Produit->getLstCategorie("(id_parent = 0 OR id_parent is NULL) AND statut = 1");

                                if($lstCategorie):
                                    foreach($lstCategorie as $dataCategorie){
                                        if($dataCategorie):
                                            ?>
                                            <li>
                                                <div class="sidebar-widget-list-left">
                                                    <input type="checkbox" name="<?=$dataCategorie['id']?>" id="<?=$dataCategorie['id']?>" onclick="changeCategorie('<?=$dataCategorie['id']?>')"><label for="<?=$dataCategorie['id']?>"><?=$dataCategorie['nom']?></label>
                                                    <span class="checkmark"></span>
                                                </div>
                                            </li>
                                        <?php
                                            //$Produit->printChildCategorie($dataCategorie['id'], 1);
                                        endif;
                                    } endif;?>
                            </ul>
                        </div>
                    </div>
                    <div class="sidebar-widget mt-45">
                        <h4 class="pro-sidebar-title">Filtrer par prix </h4>
                        <div class="price-filter mt-10">
                            <div class="price-slider-amount">
                                <input type="text" id="amount" name="price"  placeholder="Ajouter un prix" />
                            </div>
                            <div id="slider-range"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$min_price = $Produit->getMinPrice($lstProduit);
$max_price = $Produit->getMaxPrice($lstProduit);
?>
<?php get_footer(); ?>
<script type="text/javascript">
    var sliderrange = $('#slider-range');
    var amountprice = $('#amount');
    $(function() {
        sliderrange.slider({
            range: true,
            min: <?=$min_price?>,
            max: <?=$max_price?>,
            values: [<?=$min_price?>, <?=$max_price?>],
            slide: function(event, ui) {
                amountprice.val(ui.values[0] + " € - " + ui.values[1] + " €");
            }
        });
        amountprice.val(sliderrange.slider("values", <?=$min_price?>) + " € - " +
            sliderrange.slider("values", <?=$max_price?>) + " €");
    });

    function changeCategorie(idCategorie){
        var requete = 'idCategorie='+idCategorie;
        <?php if($search): ?> var search = '<?=$search?>'; <?php endif; ?>
        <?php if($categorie): ?> var search = '<?=$Tools->crypt($categorie['id'], KEY)?>'; <?php endif; ?>
        $.ajax({
            data: '&idColor='+idColor+'&quantite='+quantityAdd,
            url: '<?=URLSITEWEB?>pages/templates/ajax/addPanier.php',
            method: 'POST', // or GET
            success: function(msg) {
                document.getElementById("modalTitre").innerText = "Votre article a bien été ajouté à votre panier";
                $('#modalProduct').modal('show');
                const reponse = msg.split(';variablesuivante;');
                $("#panierTotal_desktop").empty();
                $("#panierTotal_desktop").append(reponse[0]+" €");
            }
        });
    }
</script>