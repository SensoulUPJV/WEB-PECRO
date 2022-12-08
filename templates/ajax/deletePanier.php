<?php
include('../../../parametres/constante.php');

$idLigne = $Tools->data_secure($_POST['idLigne']);
$Panier->setDeletePanierProduit($idLigne);

$panierProductFull = $Panier->getProduitPanierFull($_SESSION['idPanier']);
    
$personnalisation = false;
foreach($panierProductFull as $dataProduct){
    if($dataProduct['personnalisation']) $personnalisation = true;
}

?>
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
                foreach($panierProductFull as $dataProduct){
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
                            <input class="cart-plus-minus-box" type="text" name="qtybutton" value="<?=$dataProduct['quantite']?>">
                        </div>
                    </td>
                    <td class="product-subtotal"><?=number_format($dataProduct['quantite'] * $prixProduit,2)?> €</td>
                    <td class="product-remove">
                        <i class="sli sli-close" onclick="deleteProduit(<?=$dataProduct['id']?>)"></i>
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
                <form>
                    <input type="text" required="" name="name">
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
                <h5>Mode de livraison</h5>
                <ul>
                    <li><input type="checkbox"> Colissimo <span>20.00 €</span></li>
                    <li><input type="checkbox"> Mondial Relay <span>30.00 €</span></li>
                </ul>
            </div>
            <h4 class="grand-totall-title">Total  <span><?=number_format($prixTotal,2)?> €</span></h4>
            <a href="<?=URLSITEWEB.'commander/'?>">Valider</a>
        </div>
    </div>
</div>