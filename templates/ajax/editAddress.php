<?php
include('../../../parametres/constante.php');

$idAdresse = $Tools->data_secure($_POST['idAdresse']);
$dataAdresse = $Client->getAdresse('id = "'.$idAdresse.'"');
?>
<div class="row">
    <input type="hidden" name="idAddress" id="idAddress" value="<?=$dataAdresse['id']?>"/>
    <div class="col-lg-6">
        <div class="single-input-item">
            <label for="nom" class="required">Nom</label>
            <input type="text" name="nom" id="nom" value="<?=$dataAdresse['nom']?>"/>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="single-input-item">
            <label for="prenom" class="required">Prénom</label>
            <input type="text" name="prenom" id="prenom" value="<?=$dataAdresse['prenom']?>"/>
        </div>
    </div>   
</div>
<div class="single-input-item">
    <label for="adresse" class="required">Adresse</label>
    <input type="text" name="adresse" id="adresse" value="<?=$dataAdresse['adresse']?>"/>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="single-input-item">
            <label for="complement" class="required">Complément</label>
            <input type="text" name="complement" id="complement" value="<?=$dataAdresse['complement']?>"/>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="single-input-item">
            <label for="code_postal" class="required">Code postal</label>
            <input type="text" name="code_postal" id="code_postal" value="<?=$dataAdresse['zip']?>"/>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="single-input-item">
            <label for="ville" class="required">Ville</label>
            <input type="text" name="ville" id="ville" value="<?=$dataAdresse['ville']?>"/>
        </div>
    </div>   
</div>
<div class="row">
    <div class="col-md-6 col-12 text-left">
        <div class="single-input-item">
            <button class="check-btn sqr-btn" id="editAddressButton" onclick="changeAdresseBdd()">Modifier</button>
        </div>
    </div>
    <div class="col-md-6 col-12 text-left">
        <div class="single-input-item" id="divDeleteAdresse">
            <button class="check-btn sqr-btn" onclick="deleteAdresseBdd()">Supprimer</button>
        </div>
    </div>
</div>