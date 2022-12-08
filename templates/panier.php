<?php

    get_head();
    get_header();
    
    $panierProductFull = $Panier->getProduitPanierFull($_SESSION['idPanier']);
    
    $personnalisation = false;
    foreach($panierProductFull as $dataProduct){
        if($dataProduct['personnalisation']) $personnalisation = true;
    }
    
    $code_promo_message = "";
    
    if(isset($_POST['code_promo']) && $_POST['code_promo']){
        $code_promo = $Tools->data_secure($_POST['code_promo']);
        
        //getPromotion($where)
        $code_promo_message = "Le code promo saisie est incorrect.";
        $code_promo_couleur = "danger";
    }   
    
?>
<div class="breadcrumb-area pt-35 pb-35 bg-gray">
        <div class="container">
            <div class="breadcrumb-content text-center">
                <ul>
                    <li>
                        <a href="catalogue/">Catalogue</a>
                    </li>
                    <li class="active">Panier </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="cart-main-area pt-95 pb-100">
        <div class="container">
            <?php if(isset($code_promo_message) && $code_promo_message): ?>
                <div class="alert alert-<?=$code_promo_couleur?> fade show w-100 mb-3" role="alert">
                    <?=$code_promo_message?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>
            <h3 class="cart-page-title">Mon panier</h3>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12" id="panierContent">
                    <form action="#">
                        <div class="table-content table-responsive cart-table-content">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Produit</th>
                                        <th>Couleur</th>
                                        <?php if($personnalisation) echo "<th>Personnalisation</th>"; ?>
                                        <th>Quantité</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $prixTotal = 0;
                                    $poidsTotal = 0;
                                    foreach ($panierProductFull as $dataProduct) {
                                        $poidsTotal += ($dataProduct['poids']*$dataProduct['quantite']);
                                        $promotion = $Produit->getPromotionProduit($dataProduct['id'], $dataProduct['prix']);
                                            if($promotion != false)
                                                $prixProduit = $Produit->getPriceWithTva($promotion, $dataProduct['id_tva']);
                                            else
                                                $prixProduit = $Produit->getPriceWithTva($dataProduct['prix'], $dataProduct['id_tva']);
                                        $prixTotal += $prixProduit*$dataProduct['quantite'];
                                    ?>
                                    <tr>
                                        <td class="product-thumbnail">
                                            <a href="<?=URLPRODUIT.$dataProduct['identifiant']?>"><img src="<?=URLSITEWEB.$dataProduct['image_principale']?>" alt="" class="w-100"></a>
                                        </td>
                                        <td class="product-name"><a href="<?=URLPRODUIT.$dataProduct['identifiant']?>"><?=$dataProduct['nom'].' - '.$prixProduit.' €'?></a></td>
                                        <td class="product-color"><?=$Imprimante->printColorProduit($dataProduct['id_color'])?></td>
                                        <?php if($personnalisation) 
                                            echo '<td class="product-personnalisation">'.$dataProduct['personnalisation'].'</td>';
                                        ?>
                                        <td class="product-quantity">
                                            <div class="cart-plus-minus">
                                                <input class="cart-plus-minus-box" type="text" name="qtybutton" value="<?=$dataProduct['quantite']?>" onchange="changeQuantity(<?=$dataProduct['id_ligne']?>, this.value)">
                                            </div>
                                        </td>
                                        <td class="product-subtotal"><?=number_format($dataProduct['quantite'] * $prixProduit,2)?> €</td>
                                        <td class="product-remove">
                                            <i class="sli sli-close" onclick="deleteProduit(<?=$dataProduct['id_ligne']?>)"></i>
                                       </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </form>
                    <div class="mt-3 row">
                        <div class="col-lg-4 col-md-6">
                            <div class="discount-code-wrapper">
                                <div class="title-wrap">
                                   <h4 class="cart-bottom-title section-bg-gray">Code promo</h4> 
                                </div>
                                <div class="discount-code">
                                    <p>Saisir un code promo</p>
                                    <form action="" method="POST">
                                        <input type="text" name="code_promo" required>
                                        <button class="cart-btn-2" type="submit">Appliquer</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                        </div>
                        <div class="col-lg-4 col-md-12">
                            <div class="grand-totall">
                                <div class="title-wrap">
                                    <h4 class="cart-bottom-title section-bg-gary-cart">Panier total</h4>
                                </div>
                                <h5>Total produit <span><?=number_format($prixTotal,2)?> €</span></h5>
                                <div class="total-shipping">
                                    <h5>Mode de livraison (France Métropolitaine)</h5>
                                    <?php
                                    $poidsTotal += COLISLIVRAISON;
                                    $prixLivraison = $Produit->getLivraison('id_entreprise = 1 AND poids_max > "'.$poidsTotal.'" ORDER BY prix');
                                    $prixLivraison = number_format($prixLivraison['prix'], 2);
                                    ?>
                                    <?php $prixTotal += $prixLivraison; ?>
                                    <ul>
                                        <li><input type="radio" checked required> Colissimo <span><?=$prixLivraison?> €</span></li>
                                    </ul>
                                </div>
                                <h4 class="grand-totall-title">Total  <span><?=number_format($prixTotal,2)?> €</span></h4>
                                <a href="<?=URLSITEWEB.'commander/'?>">Valider</a>
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
    
    function deleteProduit(idLigne){
        $.ajax({
            data: 'idLigne='+idLigne,
            url: '<?= URLSITEWEB ?>pages/templates/ajax/deletePanier.php',
            method: 'POST', // or GET
            success: function(msg) {
                $("#panierContent").empty();
                $("#panierContent").append(msg);
            }
        });
    }
    
    function changeQuantity(idLigne, quantite){
        $.ajax({
            data: 'idLigne='+idLigne+'&quantite='+quantite,
            url: '<?= URLSITEWEB ?>pages/templates/ajax/quantityPanier.php',
            method: 'POST', // or GET
            success: function(msg) {
                $("#panierContent").empty();
                $("#panierContent").append(msg);
            }
        });
    }
    
</script>