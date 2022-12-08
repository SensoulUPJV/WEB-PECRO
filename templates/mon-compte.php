<?php

if(isset($_SESSION['logUser']) && $_SESSION['logUser']==true){
    get_head();
    get_header();
    
    if(isset($_POST['first_name']) && $_POST['first_name'] && isset($_POST['last_name']) && $_POST['last_name']){
        $values = [];        
        if(isset($_POST['first_name'])) $values += ['first_name' => $Tools->data_secure($_POST['first_name'])];
        if(isset($_POST['last_name'])) $values += ['last_name' => $Tools->data_secure($_POST['last_name'])];
        
        if($Client->updateDataClient($_SESSION['idUser'], $values)){
            $error_message = "Vos informations viennent d'être modifiées avec succès.";
            $error_color = "success";
        }else{
            $error_message = "Une erreur est survenu, veuillez réessayer plus tard.";
            $error_color = "danger";
        }
        unset($dataUser);
    }
    
    if(isset($_POST['current_pwd']) && $_POST['current_pwd'] && isset($_POST['new_pwd']) && $_POST['new_pwd'] && isset($_POST['confirm_pwd']) && $_POST['confirm_pwd']){
        $current_pwd = $Tools->data_secure($_POST['current_pwd']);
        $new_pwd = $Tools->data_secure($_POST['new_pwd']);
        $confirm_pwd = $Tools->data_secure($_POST['confirm_pwd']);
        if($new_pwd == $confirm_pwd){
            if($result = $Client->updatePasswordClient($_SESSION['idUser'], $current_pwd, $new_pwd)){
                $error_message = "Votre mot de passe vient d'être modifié avec succés.";
                $error_color = "success";
            }else{
                $error_message = "Une erreur est survenu, veuillez réessayer plus tard.";
                $error_color = "danger";
            }
        }else{
            $error_message = "Les nouveaux mot de passe doivent être identique.";
            $error_color = "danger";
        }
    }
    
    
    
    $dataUser = $Client->getDataClient($_SESSION['idUser'], $_SESSION['emailUser']);
    if($dataUser){
        $first_name = $dataUser['first_name'];
        $last_name = $dataUser['last_name'];
        $email = $dataUser['email'];
    }else
        $Tools->redirection(URLSITEWEB.'se-connecter');
    
    $lstAdresse = $Client->getLstAdresse('id_client = "'.$_SESSION['idUser'].'" AND type = "web"');
    
?>
<div class="breadcrumb-area pt-35 pb-35 bg-gray">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <ul>
                <li class="active">Mon compte</li>
            </ul>
        </div>
    </div>
</div>
<!-- my account wrapper start -->
<div class="my-account-wrapper pt-100 pb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- My Account Page Start -->
                <div class="myaccount-page-wrapper">
                    <!-- My Account Tab Menu Start -->
                    <div class="row">
                        <div class="col-lg-3 col-md-4">
                            <div class="myaccount-tab-menu nav" role="tablist">
                                <a href="#dashboad" <?php if(strstr($url, "actualite") || $url == "mon-compte") echo 'class="active"'; ?> data-toggle="tab"><i class="fa fa-dashboard"></i>
                                    Actualités</a>   
                                <a href="#orders" <?php if(strstr($url, "mes-commandes")) echo 'class="active"'; ?> data-toggle="tab"><i class="fa fa-cart-arrow-down"></i> Commandes</a>
                                <a href="#address-edit" <?php if(strstr($url, "mes-adresses")) echo 'class="active"'; ?> data-toggle="tab"><i class="fa fa-map-marker"></i> Adresse</a>    
                                <a href="#account-info" <?php if(strstr($url, "mes-informations")) echo 'class="active"'; ?> data-toggle="tab"><i class="fa fa-user"></i> Mes informations</a>    
                                <a href="se-deconnecter/"><i class="fa fa-sign-out"></i> Déconnexion</a>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-8">
                            <div class="tab-content" id="myaccountContent">
                                <?php if(isset($error_message) && $error_message != ""): ?>
                                    <div class="alert alert-<?=$error_color?> alert-dismissible fade show" role="alert">
                                        <?=$error_message?>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <?php endif; ?>
                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade <?php if(strstr($url, "actualite") || $url == "mon-compte") echo 'show active'; ?>" id="dashboad" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3>Actualités</h3>    
                                        <div class="welcome">
                                            <p>Bonjour, <strong><?=$first_name.' '.$last_name?></strong> (If Not <strong>Tuntuni !</strong><a href="login-register.html" class="logout"> Logout</a>)</p>
                                        </div>

                                        <p class="mb-0">From your account dashboard. you can easily check & view your recent orders, manage your shipping and billing addresses and edit your password and account details.</p>
                                    </div>
                                </div>
                                <!-- Single Tab Content End -->    
                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade <?php if(strstr($url, "mes-commandes")) echo 'show active'; ?>" id="orders" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3>Commandes</h3>    
                                        <div class="myaccount-table table-responsive text-center">
                                            <table class="table table-bordered">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>Order</th>
                                                        <th>Date</th>
                                                        <th>Status</th>
                                                        <th>Total</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>    
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Aug 22, 2018</td>
                                                        <td>Pending</td>
                                                        <td>$3000</td>
                                                        <td><a href="cart.html" class="check-btn sqr-btn ">View</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>July 22, 2018</td>
                                                        <td>Approved</td>
                                                        <td>$200</td>
                                                        <td><a href="cart.html" class="check-btn sqr-btn ">View</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>June 12, 2017</td>
                                                        <td>On Hold</td>
                                                        <td>$990</td>
                                                        <td><a href="cart.html" class="check-btn sqr-btn ">View</a></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single Tab Content End -->
                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade <?php if(strstr($url, "mes-adresses")) echo 'show active'; ?>" id="address-edit" role="tabpanel">
                                    <div class="myaccount-content">
                                        <div class="alert alert-success alert-dismissible fade show display-none" role="alert" id="alertAddress">
                                            Votre adresse vient d'être modifié
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <h3>Adresse</h3>
                                        <div class="row" id="divLstAddress">
                                            <?php foreach($lstAdresse as $dataAdresse){ ?>
                                                <div class="col-xl-4 col-md-6 col-12">
                                                    <address class="div-color-address" title="Modifier l'adresse" onclick="changeAdresse(<?=$dataAdresse['id']?>)">
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
                                        </div>
                                    </div>
                                </div>
                                <!-- Single Tab Content End -->    
                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade <?php if(strstr($url, "mes-informations")) echo 'show active'; ?>" id="account-info" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3>Mes informations</h3>    
                                        <div class="account-details-form">
                                            <form action="<?=URLSITEWEB?>mon-compte/mes-informations/" method="POST">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="single-input-item">
                                                            <label for="first_name" class="required">Prénom</label>
                                                            <input type="text" name="first_name" id="first_name" value="<?=$first_name?>"/>
                                                        </div>
                                                    </div>   
                                                    <div class="col-lg-6">
                                                        <div class="single-input-item">
                                                            <label for="last_name" class="required">Nom</label>
                                                            <input type="text" name="last_name" id="last_name" value="<?=$last_name?>"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="single-input-item">
                                                    <label for="email" class="required">Email</label>
                                                    <input type="email" id="email" name="email" value="<?=$email?>" disabled/>
                                                </div>    
                                                <div class="single-input-item">
                                                    <button class="check-btn sqr-btn ">Modifier</button>
                                                </div>
                                            </form>
                                            <form action="" method="POST" class="mt-5">
                                                <fieldset>
                                                    <legend>Modifier mon mot de passe</legend>
                                                    <div class="single-input-item">
                                                        <label for="current_pwd" class="required">Mot de passe actuel</label>
                                                        <input type="password" name="current_pwd" id="current_pwd" required/>
                                                    </div>   
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="single-input-item">
                                                                <label for="new_pwd" class="required">Nouveau mot de passe</label>
                                                                <input type="password" name="new_pwd" id="new_pwd" required/>
                                                            </div>
                                                        </div>    
                                                        <div class="col-lg-6">
                                                            <div class="single-input-item">
                                                                <label for="confirm_pwd" class="required">Nouveau mot de passe</label>
                                                                <input type="password" name="confirm_pwd" id="confirm_pwd" required/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                                <div class="single-input-item">
                                                    <button class="check-btn sqr-btn ">Modifier</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div> <!-- Single Tab Content End -->
                            </div>
                        </div> <!-- My Account Tab Content End -->
                    </div>
                </div> <!-- My Account Page End -->
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title h2-classic" id="exampleModalLongTitle">Modifier l'adresse</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="myaccount-content">
                <div class="account-details-form mt-0" id="dataAddress">
                    <div class="row">
                        <div class="col-lg-6">
                            <input type="hidden" name="idAddress" id="idAddress" value="0"/>
                            <div class="single-input-item">
                                <label for="nom" class="required">Nom</label>
                                <input type="text" name="nom" id="nom"/>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="single-input-item">
                                <label for="prenom" class="required">Prénom</label>
                                <input type="text" name="prenom" id="prenom"/>
                            </div>
                        </div>   
                    </div>
                    <div class="single-input-item">
                        <label for="adresse" class="required">Adresse</label>
                        <input type="text" name="adresse" id="adresse"/>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="single-input-item">
                                <label for="complement" class="required">Complément</label>
                                <input type="text" name="complement" id="complement"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="single-input-item">
                                <label for="code_postal" class="required">Code postal</label>
                                <input type="text" name="code_postal" id="code_postal"/>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="single-input-item">
                                <label for="ville" class="required">Ville</label>
                                <input type="text" name="ville" id="ville"/>
                            </div>
                        </div>   
                    </div>
                    <div class="single-input-item">
                        <button class="check-btn sqr-btn" id="editAddressButton" onclick="changeAdresseBdd()">Modifier</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    get_footer();
}else{
    $Tools->redirection(URLSITEWEB.'se-connecter');
}
?>
<script type="text/javascript">
    
    function changeAdresse(idAdresse){
        if(idAdresse == 0){
            $('#idAddress').val("");
            $('#nom').val("");
            $('#prenom').val("");
            $('#adresse').val("");
            $('#complement').val("");
            $('#code_postal').val("");
            $('#ville').val("");
            $('#exampleModalLongTitle').html('Ajouter une adresse');
            $('#editAddressButton').html('Ajouter');
            $("#divDeleteAdresse").empty();
        }
        else{
            $.ajax({
                data: 'idAdresse='+idAdresse,
                url: '<?=URLSITEWEB?>pages/templates/ajax/editAddress.php',
                method: 'POST', // or GET
                success: function(msg) {
                    $("#dataAddress").empty();
                    $("#dataAddress").html(msg);
                }
            });
            $('#exampleModalLongTitle').html("Modifier l'adresse");
            $('#editAddressButton').html('Modifier');
        }
        $('#exampleModalCenter').modal('show');
    }
    
    function changeAdresseBdd(){
        var idAdresse = $('#idAddress').val();
        var nom = $('#nom').val();
        var prenom = $('#prenom').val();
        var adresse = $('#adresse').val();
        var complement = $('#complement').val();
        var zip = $('#code_postal').val();
        var ville = $('#ville').val();
        
        $.ajax({
            data: 'idAdresse='+idAdresse+'&nom='+nom+'&prenom='+prenom+'&adresse='+adresse+'&complement='+complement+'&zip='+zip+'&ville='+ville,
            url: '<?=URLSITEWEB?>pages/templates/ajax/editAddressBdd.php',
            method: 'POST', // or GET
            success: function(msg) {
                $('#alertAddress').css('display', 'block');
            }
        });
        refreshAddress();
        $('#exampleModalCenter').modal('hide');
    }
    
    function deleteAdresseBdd(){
        var idAdresse = $('#idAddress').val();
        $.ajax({
            data: 'idAdresse='+idAdresse,
            url: '<?=URLSITEWEB?>pages/templates/ajax/deleteAddressBdd.php',
            method: 'POST', // or GET
            success: function(msg) {
                $('#alertAddress').css('display', 'block');
            }
        });
        refreshAddress();
        $('#exampleModalCenter').modal('hide');
    }
    
    function refreshAddress(){
        $.ajax({
            url: '<?=URLSITEWEB?>pages/templates/ajax/editAddressRefresh.php',
            method: 'POST', // or GET
            success: function(msg) {
                $("#divLstAddress").empty();
                $("#divLstAddress").html(msg);
            }
        });
    }
    
    
    $('#new_pwd, #confirm_pwd').on('keyup', function () {
        if ($('#new_pwd').val() == $('#confirm_pwd').val()) {
            $('#confirm_pwd').html('Matching').css('color', 'green');
        } else 
            $('#confirm_pwd').html('Not Matching').css('color', 'red');
    });
</script>