<?php

if(isset($_SESSION['logUser']) && $_SESSION['logUser']) $_SESSION['logUser'] = false;
if(isset($_SESSION['idUser']) && $_SESSION['idUser']) unset($_SESSION['idUser']);
if(isset($_SESSION['emailUser']) && $_SESSION['emailUser']) unset($_SESSION['emailUser']);
if(isset($_SESSION['first_nameUser']) && $_SESSION['first_nameUser']) unset($_SESSION['first_nameUser']);
if(isset($_SESSION['last_nameUser']) && $_SESSION['last_nameUser']) unset($_SESSION['last_nameUser']);
if(isset($_SESSION['idPanier']) && $_SESSION['idPanier']) unset($_SESSION['idPanier']);

$Tools->redirection(URLSITEWEB.'mon-compte');