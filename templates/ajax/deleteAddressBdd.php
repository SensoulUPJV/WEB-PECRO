<?php
include('../../../parametres/constante.php');

$idAdresse = $Tools->data_secure($_POST['idAdresse']);



if($idAdresse){
    if($Client->setDeleteAdresse($idAdresse))
        echo true;
    else
        echo false;
}
?>