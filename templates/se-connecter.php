<?php

    /*if(empty($_POST['reponse-recaptcha'])){
        $urlcaptcha = $_SESSION['accueil'];
        $Tools->redirection($urlcaptcha);
    }*/
    
    get_head();
    get_header();
    

if(isset($_POST) && (isset($_POST["btn_inscription"]) | isset($_POST["btn_connexion"]))){
    $token = $_POST['gtoken'];
    $url = "https://www.google.com/recaptcha/api/siteverify?secret=".CAPTCHASECRET."&response=".$token;
    $recaptcha = file_get_contents($url);
    $response = json_decode($recaptcha);

    if($response->success == true && $response->score >= 0.5){
        
        if(isset($_POST['connexion-user-email']) && $_POST['connexion-user-email'] && isset($_POST['connexion-user-password']) && $_POST['connexion-user-password']){
                $email = $Tools->data_secure($_POST['connexion-user-email']);
                $password = $Tools->data_secure($_POST['connexion-user-password']);

                $dataUser = $Client->getClient("email='".$email."'");

                $password = hash('sha256', $password);
                if($dataUser['password'] == $password){
                    $values = [];
                    $values += ['last_log' => date('Y-m-d H:i:s')];
                    $Client->updateDataClient($dataUser['id'], $values);
                    $_SESSION['logUser'] = true;
                    $_SESSION['idUser'] = $dataUser['id'];
                    $_SESSION['emailUser'] = $dataUser['email'];
                    $_SESSION['first_nameUser'] = $dataUser['first_name'];
                    $_SESSION['last_nameUser'] = $dataUser['last_name'];
                    if(isset($_SESSION['idPanier']) && $_SESSION['idPanier']) 
                        $Panier->checkPanier();
                    if(isset($_SESSION['page_call']) && $_SESSION['page_call']){
                        $url = $_SESSION['page_call'];
                        unset($_SESSION['page_call']);
                        $Tools->redirection($url);
                    }else
                        $Tools->redirection(URLSITEWEB.'mon-compte/');
                }else{
                    $_SESSION['logUser'] = false;
                }
            }else{
                if(isset($_POST['inscription-user-email']) && $_POST['inscription-user-email'] && isset($_POST['inscription-user-password']) && $_POST['inscription-user-password']){
                    /*$email = $Tools->data_secure($_POST['inscription-user-email']);
                    $password = $Tools->data_secure($_POST['inscription-user-password']);
                    $password = hash('sha256', $password);
                    if($set_user_where($email, $password)){
                        $_SESSION['logUser'] = true;
                        $_SESSION['idUser'] = $dataUser['id'];
                        $_SESSION['emailUser'] = $dataUser['email'];
                        $_SESSION['first_nameUser'] = $dataUser['first_name'];
                        $_SESSION['last_nameUser'] = $dataUser['last_name'];
                        $Tools->redirection(URLSITEWEB.'mon-compte');
                    }else{
                        $_SESSION['logUser'] = false;
                    }*/
                }elseif(isset($_POST['forget_email']) && $_POST['forget_email']){
                    $email = $Tools->data_secure($_POST['forget_email']);

                    $data_user = "";
                    $data_user = $set_user_where("email = '".$email."'");

                    if($data_user && $data_user['email']){
                        $key="";

                        $chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        for($i=0; $i<6; $i++){
                            $key .= $chars[rand(0, strlen($chars)-1)];
                        }

                        $_SESSION['key'] = $key;
                        $_SESSION['email'] = $email;
                        $Tools->send_email($email, 'email-forgetpassword');
                    }
                    else{
                        $error_message_forget = "Oups, je ne connais pas votre adresse mail, n'hésitez pas à vous créer un compte.";
                    }
                }elseif(isset($_POST['forget_code']) && $_POST['forget_code']){
                    if($_POST['forget_code'] == $_SESSION['key']){
                        if($_POST['forget_password_1'] == $_POST['forget_password_2']){
                            $values = array(
                                "password" => hash('sha256',$Tools->data_secure($_POST['forget_password_1'])),
                            );

                            $Client->set_user_where($_SESSION['email'], $values, 0);
                            $error_message_connection = "good";
                        }
                        else
                            $error_message_connection = "Votre mot de passe vient d'être modifier avec succès.";
                    }
                    else
                        $error_message_connection = "Le code saisie ne correspond pas, veuillez réessayer ultérieurement.";
                }
            }
    }else {
        $error_message = "Erreur reCAPTCHA V3";
        $error_color = "danger";
    }
} 
?>

<div class="breadcrumb-area pt-35 pb-35 bg-gray">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <ul>
                <li class="active">Se connecter / S'inscrire </li>
            </ul>
        </div>
    </div>
</div>
<div class="login-register-area pt-100 pb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                <div class="login-register-wrapper">
                    <div class="login-register-tab-list nav">
                        <a class="active" data-toggle="tab" href="#lg1">
                            <h4> Connexion </h4>
                        </a>
                        <a data-toggle="tab" href="#lg2">
                            <h4> Inscription </h4>
                        </a>
                    </div>
                    <div class="tab-content">
                        <?php if(isset($error_message) && $error_message != ""): ?>
                            <div class="alert alert-<?=$error_color?> alert-dismissible fade show" role="alert">
                                <?=$error_message?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>
                        <div id="lg1" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <form method="post">
                                        <input type="text" name="connexion-user-email" placeholder="Email" required>
                                        <input type="password" name="connexion-user-password" placeholder="Mot de passe" required>
                                        <div class="button-box">
                                            <div class="login-toggle-btn">
                                                <input type="checkbox">
                                                <label>Reste connecté</label>
                                                <a onclick="forget_password()" class="link-classic">Mot de passe oublié</a>
                                            </div>
                                            <button name="btn_connexion" id='btn_connexion' type="submit">Connexion</button>
                                        </div>
                                        <input type="hidden" id="g-token" name="gtoken">
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div id="lg2" class="tab-pane">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <form method="post">
                                        <input type="text" name="inscription-user-first-name" placeholder="Nom">
                                        <input type="text" name="inscription-user-last-name" placeholder="Prénom">
                                        <input type="mail" name="inscription-user-email" placeholder="Email">
                                        <input type="password" name="inscription-user-password" id="inscription-user-password" placeholder="Mot de passe">
                                        <div id="message">
                                        <h3>Password must contain the following:</h3>
                                            <p id="letter" class="password_invalid">Minuscule</p>
                                            <p id="capital" class="password_invalid">Majuscule</p>
                                            <p id="number" class="password_invalid">1 Chiffre</p>
                                            <p id="length" class="password_invalid">Minimum <b>8 characters</b></p>
                                        </div>
                                        <div class="button-box">
                                            <button name="btn_inscription" type="submit">Inscription</button>
                                        </div>
                                        <input type="hidden" id="g-token" name="gtoken">
                                    </form>
                                    <script>
                                        grecaptcha.ready(function() {
                                          grecaptcha.execute('<?=CAPTCHAPUBLIC?>', {action: 'submit'}).then(function(token) {
                                              document.getElementById('g-token').value = token;
                                              console.log(token);
                                          });
                                        });
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="" method="POST">
                <div class="modal-header">
                    <h2 class="modal-title h2-classic" id="exampleModalLongTitle">Mot de passe oublié</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <?php if(isset($error_message_forget) && $error_message_forget): ?>
                            <div class="col-12">
                                <div class="alert alert-danger alert-dismissible fade show w-100" role="alert">
                                  <?=$error_message_forget?>
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="col-12">
                            <label for='forget_email'>Veuillez saisir l'adresse email de votre compte :</label>
                            <input type="email" name="forget_email" class="w-100" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn-simple">Modifier mon mot de passe</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php if(isset($_POST['forget_email']) && $_POST['forget_email'] && $data_user && $data_user['email']){ ?>
<div class="modal fade" id="forget_password" tabindex="-1" role="dialog" aria-labelledby="forget_password" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="" method="POST">
                <div class="modal-header">
                    <h2 class="modal-title h2-classic" id="exampleModalLongTitle">Modifier mon mot de passe</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row align-items-center">
                        <div class="col-md-6 col-xs-12">
                            <label for='forget_code'>Code :</label>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <input type="text" name="forget_code" class="w-100" required>
                        </div>
                        <div class="col-12">
                            <hr>
                        </div>
                        <div class="col-12">
                            <label for='forget_password_1'>Nouveau mot de passe :</label>
                            <input type="password" name="forget_password_1" class="w-100" required>
                        </div>
                        <div class="col-12 mt-3">
                            <label for='forget_password_2'>Nouveau mot de passe :</label>
                            <input type="password" name="forget_password_2" class="w-100" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit">Modifier mon mot de passe</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $('#forget_password').modal('show');
</script>
<?php } ?>
<script>
    <?php if(isset($error_message_forget) && $error_message_forget): ?>
        $('#exampleModalCenter').modal('show');
    <?php endif; ?>

    function forget_password(){
        $('#forget_password').modal('show');
    }
    
    

    var myInput = document.getElementById("inscription-user-password");
    var letter = document.getElementById("letter");
    var capital = document.getElementById("capital");
    var number = document.getElementById("number");
    var length = document.getElementById("length");
    
    myInput.onkeyup = function() {
        // Validate lowercase letters
        var lowerCaseLetters = /[a-z]/g;
        if(myInput.value.match(lowerCaseLetters)) {  
            letter.classList.remove("password_invalid");
            letter.classList.add("password_valid");
        } else {
            letter.classList.remove("password_valid");
            letter.classList.add("password_invalid");
        }

        // Validate capital letters
        var upperCaseLetters = /[A-Z]/g;
        if(myInput.value.match(upperCaseLetters)) {  
            capital.classList.remove("password_invalid");
            capital.classList.add("password_valid");
        } else {
            capital.classList.remove("password_valid");
            capital.classList.add("password_invalid");
        }

        // Validate numbers
        var numbers = /[0-9]/g;
        if(myInput.value.match(numbers)) {  
            number.classList.remove("password_invalid");
            number.classList.add("password_valid");
        } else {
            number.classList.remove("password_valid");
            number.classList.add("password_invalid");
        }

        // Validate length
        if(myInput.value.length >= 8) {
            length.classList.remove("password_invalid");
            length.classList.add("password_valid");
        } else {
            length.classList.remove("password_valid");
            length.classList.add("password_invalid");
        }
    }
    
</script>





<?php
    get_footer();
?>