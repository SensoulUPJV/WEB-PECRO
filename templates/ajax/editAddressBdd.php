<?php
include('../../../parametres/constante.php');

$idAdresse = $Tools->data_secure($_POST['idAdresse']);

$values = [];        
if(isset($_POST['nom'])) $values += ['nom' => $Tools->data_secure($_POST['nom'])];
if(isset($_POST['prenom'])) $values += ['prenom' => $Tools->data_secure($_POST['prenom'])];
if(isset($_POST['adresse'])) $values += ['adresse' => $Tools->data_secure($_POST['adresse'])];
if(isset($_POST['complement'])) $values += ['complement' => $Tools->data_secure($_POST['complement'])];
if(isset($_POST['zip'])) $values += ['zip' => $Tools->data_secure($_POST['zip'])];
if(isset($_POST['ville'])) $values += ['ville' => $Tools->data_secure($_POST['ville'])];

if($idAdresse){
    if($Client->setUpdateAdresse($idAdresse, $values))
        echo true;
    else
        echo false;
}else{
    $values += ['id_client' => $_SESSION['idUser']];
    $values += ['type' => "web"];
    if($Client->setAddAdresse($values))
        echo true;
    else
        echo false;
}
?>