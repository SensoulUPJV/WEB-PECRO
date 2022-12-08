<?php
    
    $dataProduit = $Produit->getProduitWithIdentifiant($_GET['identifiant']);
    if($Produit->checkProduitOnline($dataProduit['id']) == false)
        $Tools->redirection(URLSITEWEB);
    
    get_head();
    get_header();
   
    $promotion = $Produit->getPromotionProduit($dataProduit['id'], $dataProduit['prix']);
    if($promotion != false)
        $promotion = $Produit->getPriceWithTva($promotion, $dataProduit['id_tva']);
    $prix = $Produit->getPriceWithTva($dataProduit['prix'], $dataProduit['id_tva']);
    $lstImage = explode(";", $dataProduit['image']);
?>
<div class="product-details-area pt-100 pb-95">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="product-details-img">
                    <div class="zoompro-border zoompro-span">
                        <img class="zoompro" src="<?=URLSITEWEB.$dataProduit['image_principale']?>" data-zoom-image="<?=URLSITEWEB.$dataProduit['image_principale']?>" alt=""/>
                        <?php if($promotion != false) echo '<span>- '.round(100-(($promotion*100)/$prix)).' %</span>'; ?>
                    </div>
                    <div id="gallery" class="mt-20 product-dec-slider">
                        <?php foreach($lstImage as $dataImage){ ?>
                            <a data-image="<?=URLSITEWEB.$dataImage?>" data-zoom-image="<?=URLSITEWEB.$dataImage?>">
                                <img src="<?=URLSITEWEB.$dataImage?>" alt="">
                            </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="product-details-content ml-30">
                    <h2><?=$dataProduit['nom']?></h2>
                    <?php if($Produit->checkProduitOnlineBuy($dataProduit['id'])): ?>
                        <div class="product-details-price">
                            <?php 
                            if($promotion != false){
                                echo '<span class="new">'.$promotion.' €</span>';
                                echo '<span class="old">'.$prix.' €</span>';
                            }else
                                echo '<span class="new">'.$prix.' €</span>';
                            ?>
                        </div>
                        <?php if($dataProduit['couleur']): ?>
                    <div class="col-12" >
                        <div id="alert" class="alert alert-danger collapse">
                            <a id="alert_close" class="close">&times</a>
                            <strong>Erreur !</strong> Aucune couleur sélectionnée.
                        </div>
                    </div>
                        <div class="pro-details-size-color">
                            <div class="pro-details-color-wrap w-100">
                                <span>Couleur</span>
                                <div class="pro-details-color-content">
                                    <div class="row">
                                        <?php $Imprimante->printLstColorProduit($dataProduit['couleur']); ?>
                                        <input type="hidden" name="input-color" id="input-color">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="pro-details-quality">
                            <div class="cart-plus-minus">
                                <input class="cart-plus-minus-box" type="text" name="quantityAdd" id="quantityAdd" value="1" max="20">
                            </div>
                            <div class="pro-details-cart btn-hover">
                                <button id="btn_add_panier" onclick="addPanier(<?=$dataProduit['id']?>)">Ajouter au panier</button>
                            </div>
                            <?php /*<div class="pro-details-wishlist">
                                <a title="Ajouter à ma liste d'envies" href="#"><i class="sli sli-heart"></i></a>
                            </div>
                            <div class="pro-details-compare">
                                <a title="Comparer" href="#"><i class="sli sli-refresh"></i></a>
                            </div>*/ ?>
                        </div>
                    <?php endif; ?>
                    <div class="pro-details-meta">
                        <span>Catégories :</span>
                        <ul>
                            <?php
                            $lstCategorie = str_replace(";;", ";", $dataProduit['categorie']);
                            $lstCategorie = explode(";", $lstCategorie);
                            foreach($lstCategorie as $categorie){
                                if($categorie):
                                $dataCategorie = $Produit->getCategorie('id="'.$categorie.'"');
                                if($dataCategorie){
                                ?>
                                <li><a href="<?=$dataCategorie['identifiant']?>"><?=$dataCategorie['nom']?>, </a></li>
                            <?php
                                }
                                endif;
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="description-review-area pb-95">
    <div class="container">
        <div class="row">
            <div class="<?php /*col-lg-8 col-md-8 */ ?> col-12">
                <div class="description-review-wrapper">
                    <div class="description-review-topbar nav">
                        <button id="buttonDescription" class="active" onclick="showDiv('description')">Description</button>
                        <button id="buttonAutre" onclick="showDiv('autre')">Autres informations</button>
                    </div>
                    <div class="tab-content description-review-bottom">
                        <div id="divDescription" class="tab-pane active">
                            <div class="product-description-wrapper">
                                <?= str_replace("https://[[URLSITEWEB]]", URLSITEWEB, $dataProduit['description'])?>
                            </div>
                        </div>
                        <div id="divAutre" class="tab-pane">
                            <div class="product-anotherinfo-wrapper">
                                <ul>
                                    <li><span>Poids</span> <?=$dataProduit['poids']?> g</li>
                                    <?php if($dataProduit['dimensions']) echo '<li><span>Dimensions</span>'.$dataProduit['dimensions'].' mm </li>'; ?>
                                    <?php if($dataProduit['createur']): ?>
                                    <li><span>Créateur</span>
                                        <?php 
                                        if($dataProduit['createur_url']) echo '<a href="'.$dataProduit['createur_url'].'">'.$dataProduit['createur'].'</a>'; 
                                        else echo $dataProduit['createur'];
                                        ?>
                                    </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php /*<div class="col-lg-4 col-md-4">
                <div class="pro-dec-banner">
                    <a href="#"><img src="assets/img/banner/banner-15.png" alt=""></a>
                </div>
            </div>*/ ?>
        </div>
    </div>
</div>
<?php if($dataProduit['id_produit_associe']): ?>
    <div class="product-area pb-70">
        <div class="container">
            <div class="section-title text-center pb-60">
                <h2>Nos produits liés à cet article</h2>
                <?php /* <p> Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical</p>*/ ?>
            </div>
            <div class="arrivals-wrap item-wrapper">
                <div class="ht-products row">
                    <?php 
                    foreach($lstProduit as $dataProduit){
                        $promotion = $Produit->getPromotionProduit($dataProduit['id'], $dataProduit['prix']);
                        $Produit->printProduitGrid(true, 5, $dataProduit['nom'], $dataProduit['identifiant'], $dataProduit['image_principale'], $dataProduit['prix'], $promotion, $dataProduit['id_tva']);
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?=$Tools->printLinkModelisationImpression();?>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="modalProduct" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <p class="h2 modal-title text-center" id="modalTitre"></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 section-title text-center mt-3 pb-60">
                            <p class="w-100 h3">Découvrez nos recommandations</p>
                        </div>
                        <div class="arrivals-wrap item-wrapper w-100">
                            <div class="ht-products row">
                            <?php
                                if($dataProduit['id_produit_panier']) {
                                    $produitAssocie = explode(";", str_replace(";;", ";", $dataProduit['id_produit_panier']));
                                    $reqPdtAssocie = "";
                                    foreach ($produitAssocie as $pdtAssocie) {
                                        if ($pdtAssocie) {
                                            if ($reqPdtAssocie)
                                                $reqPdtAssocie .= " OR id = " . $pdtAssocie;
                                            else
                                                $reqPdtAssocie = "( id = " . $pdtAssocie;
                                        }
                                    }
                                    $lstProduit = $Produit->getLstProduitOnline($reqPdtAssocie . ")");
                                }else if($dataProduit['id_produit_associe']) {
                                    $produitAssocie = explode(";", str_replace(";;", ";", $dataProduit['id_produit_associe']));
                                    $reqPdtAssocie = "";
                                    foreach ($produitAssocie as $pdtAssocie) {
                                        if ($pdtAssocie) {
                                            if ($reqPdtAssocie)
                                                $reqPdtAssocie .= " OR id = " . $pdtAssocie;
                                            else
                                                $reqPdtAssocie = "( id = " . $pdtAssocie;
                                        }
                                    }    
                                   $lstProduit = $Produit->getLstProduitOnline($reqPdtAssocie . ")");
                                }else
                                    $lstProduit = $Produit->getLstProduitOnline(null, "id DESC", 8);
                                
                                if($lstProduit){
                                    $nb_produit = 0;
                                    foreach($lstProduit as $dataProduit){
                                        if ($nb_produit !== 6){
                                            $nb_produit = $nb_produit + 1;
                                            $promotion = $Produit->getPromotionProduit($dataProduit['id'], $dataProduit['prix']);
                                            $Produit->printProduitGrid(false, $dataProduit['id'], $dataProduit['nom'], $dataProduit['identifiant'], $dataProduit['image_principale'], $dataProduit['prix'], $promotion, $dataProduit['id_tva']);
                                        }
                                    }
                                }
                                else 
                            ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
<?php
    get_footer();
?>

<script type="text/javascript">
    
    function showDiv(div){
        $("#buttonDescription").removeClass("active");
        $("#divDescription").css("display", "none");
        $("#buttonAutre").removeClass("active");
        $("#divAutre").css("display", "none");
        
        if(div == "description"){
            $("#buttonDescription").addClass("active");
            $("#divDescription").css("display", "block");
        }else{
            if(div == "autre"){
                $("#buttonAutre").addClass("active");
                $("#divAutre").css("display", "block");
            }
        }
        
    }
    function changeColor(idColor){
        $("div").removeClass("div-color-checked");
        var colorChecked = document.getElementById(idColor);

        colorChecked.classList.add("div-color-checked");
        document.getElementById("input-color").value = idColor;
    }
    
    function addPanier(idProduit){
        var color = document.getElementById("input-color");
        if(typeof(color) != 'undefined' && color != null){
            var idColor = document.getElementById("input-color");
            var quantityAdd = document.getElementById("quantityAdd");
            var reponse = "";
            idColor = idColor.value;
            quantityAdd = quantityAdd.value;
            
            if(idColor){
                $.ajax({
                    data: 'idProduit='+idProduit+'&idColor='+idColor+'&quantite='+quantityAdd,
                    url: '<?=URLSITEWEB?>pages/templates/ajax/addPanier.php',
                    method: 'POST', // or GET
                    success: function(msg) {
                        document.getElementById("modalTitre").innerText = "Votre article a bien été ajouté à votre panier";
                        $('#modalProduct').modal('show');
                        const reponse = msg.split(';variablesuivante;');
                        $("#panierTotal_desktop").empty();
                        $("#panierTotal_desktop").append(reponse[0]+" €");
                        $("#panierTotal_mobile").empty();
                        $("#panierTotal_mobile").append(reponse[0]+" €");
                        
                        $("#panierTotalDetail_desktop").empty();
                        $("#panierTotalDetail_desktop").append(reponse[0]+" €");
                        $("#panierTotalDetail_mobile").empty();
                        $("#panierTotalDetail_mobile").append(reponse[0]+" €");
                        
                        $("#panierNbProduit_desktop").empty();
                        $("#panierNbProduit_desktop").append(reponse[1]);
                        $("#panierNbProduit_mobile").empty();
                        $("#panierNbProduit_mobile").append(reponse[1]);
                        
                        $("#panier_desktop").empty();
                        $("#panier_desktop").append(reponse[2]);
                        $("#panier_mobile").empty();
                        $("#panier_mobile").append(reponse[2]);
                    }
                });
            }else{
                $('#btn_add_panier').click(function (){
                    $('#alert').show('fade');
                });
                $('#alert_close').click(function (){
                    $('#alert').hide('fade');
                });
            }
        }else{
            alert("pas de couleur");
        }
    }

</script>

