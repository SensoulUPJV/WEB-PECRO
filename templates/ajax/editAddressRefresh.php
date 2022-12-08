<?php
include('../../../parametres/constante.php');

$lstAdresse = $Client->getLstAdresse('id_client = "'.$_SESSION['idUser'].'" AND type = "web"');
?>
<?php foreach ($lstAdresse as $dataAdresse) { ?>
    <div class="col-xl-4 col-md-6 col-12">
        <address class="div-color-address" title="Modifier l'adresse" onclick="changeAdresse(<?= $dataAdresse['id'] ?>)">
            <p><strong><?=$dataAdresse['prenom'].' '.$dataAdresse['nom']?></strong></p>
            <p><?=$dataAdresse['adresse']?></p>
            <p><?=$dataAdresse['complement']?></p>
            <p><?=$dataAdresse['zip'].' '.$dataAdresse['ville']?></p>
            <p class="check-btn sqr-btn"><i class="fa fa-edit"></i> Modifier l'adresse</p>
        </address>
    </div>
<?php } ?>
<div class="col-xl-4 col-md-6 col-12">
    <address class="div-color-address" title="Ajouter une adresse" onclick="changeAdresse(0)">
        <p class="check-btn sqr-btn"><i class="fa fa-plus"></i> Ajouter une adresse</p>
    </address>    
</div>