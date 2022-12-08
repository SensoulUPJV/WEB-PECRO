<?php
include('../../../parametres/constante.php');

$idProduit = $Tools->data_secure($_POST['idProduit']);

if(isset($_POST['quantite'])) $quantite = $Tools->data_secure($_POST['quantite']);
else $quantite = 1;

if(isset($_POST['idColor'])) $idColor = $Tools->data_secure($_POST['idColor']);
else $idColor = "";

if(isset($_POST['personnalisation'])) $personnalisation = $Tools->data_secure($_POST['personnalisation']);
else $personnalisation = "";

if($Panier->addPanier($idProduit, $quantite, $idColor, $personnalisation)){
    $panierProduct = $Panier->getProduitPanierWithNamePicture($_SESSION['idPanier']);
    foreach($panierProduct as $dataProduit){
        $quantiteTotal += $dataProduit['quantite'];
        $promotion = $Produit->getPromotionProduit($dataProduit['id'], $dataProduit['prix']);
        if($promotion != false)
            $prix = $Produit->getPriceWithTva($promotion, $dataProduit['id_tva']);
        else
            $prix = $Produit->getPriceWithTva($dataProduit['prix'], $dataProduit['id_tva']);
        $prixTotal += $dataProduit['quantite']*$prix;
    }
    echo number_format($prixTotal,2);
    echo ";variablesuivante;";
    ?>
    <i class="fas fa-shopping-basket"></i>
    <span class="count-style">
    <?= $quantiteTotal; ?>
    </span>
    <?=";variablesuivante;"?>
    
    <div class="shopping-cart-top">
        <h4>Panier</h4>
        <a class="cart-close" href="#"><i class="sli sli-close"></i></a>
    </div>
    <ul>
    <?php
    foreach($panierProduct as $dataProduit){
        $promotion = $Produit->getPromotionProduit($dataProduit['id'], $dataProduit['prix']);
        if($promotion != false)
            $prix = $Produit->getPriceWithTva($promotion, $dataProduit['id_tva']);
        else
            $prix = $Produit->getPriceWithTva($dataProduit['prix'], $dataProduit['id_tva']);
        ?>
        <li class="single-shopping-cart">
            <div class="shopping-cart-img">
                <a href="<?=URLPRODUIT.$dataProduit['identifiant']?>"><img alt="" src="<?=URLSITEWEB.$dataProduit['image_principale']?>"></a>
                <?php /*<div class="item-close">
                    <a href="#"><i class="sli sli-close"></i></a>
                </div>*/ ?>
            </div>
            <div class="shopping-cart-title">
                <h4><a href="<?=URLPRODUIT.$dataProduit['identifiant']?>"><?=$dataProduit['nom']?> </a></h4>
                <span><?=$dataProduit['quantite']?> x <?=number_format($prix,2)?> €</span>
            </div>
        </li>
        <?php
    }?>
    </ul>
        <div class="shopping-cart-bottom">
            <div class="shopping-cart-total">
                <h4>Total : <span class="shop-total" id="panierTotalDetail_desktop"><?= number_format($prixTotal,2) ?> €</span></h4>
        </div>
        <div class="shopping-cart-btn btn-hover text-center">
            <a class="default-btn" href="panier/">Voir mon panier</a>
        </div>
    </div>
<?php
    
}else
    return false;
?>