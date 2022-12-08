<?php

get_head();
get_header();

if(isset($_POST) && isset($_POST["btn_envoie"])){
    $token = $_POST['gtoken'];
    $url = "https://www.google.com/recaptcha/api/siteverify?secret=".CAPTCHASECRET."&response=".$token;
    $recaptcha = file_get_contents($url);
    $response = json_decode($recaptcha);
        
    if($response->success == true && $response->score >= 0.5){
        if(isset($_POST['nom']) && $_POST['nom']){
            $values = [];
            $values += ['formulaire' => "modelisation"];

            if(isset($_POST['nom'])) $values += ['nom' => $Tools->data_secure($_POST['nom'])];
            if(isset($_POST['prenom'])) $values += ['prenom' => $Tools->data_secure($_POST['prenom'])];
            if(isset($_POST['email'])) $values += ['email' => $Tools->data_secure($_POST['email'])];
            if(isset($_POST['telephone'])) $values += ['telephone' => $Tools->data_secure($_POST['telephone'])];
            if(isset($_POST['objet'])) $values += ['objet' => $Tools->data_secure($_POST['objet'])];
            if(isset($_POST['message'])) $values += ['message' => $Tools->data_secure($_POST['message'])];

            if($Client->setInsertContact($values)){
                $error_message = "Nous avons bien reçu votre demande, elle sera traitée dans les plus brefs délais.";
                $error_color = "success";
            }else{
                $error_message = "Une erreur est survenu, merci de réessayer ultérieurement.";
                $error_color = "danger";
            }
        }
        $contenuPage = $Contenu->getLstContenu('id_page="'.$_SESSION['data_page']['id'].'"');
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
                <li>
                    <a href="sur-mesure/">Sur mesure</a>
                </li>
                <li class="active">Formation</li>
            </ul>
        </div>
    </div>
</div>
<div class="about-story-area pt-100 pb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="story-img">
                    <a href="#"><img src="media/pages/formation-3d-access.jpg" alt=""></a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="story-details pl-50">
                    <div class="story-details-top">
                        <h2>Formation</h2>
                        
                        <p></p>
                    </div>
                    <div class="story-details-bottom">
                        <h4>WE START AT 2015</h4>
                        <p></p>
                    </div>
                    <div class="story-details-bottom">
                        <h4>WIN BEST ONLINE SHOP AT 2017</h4>
                        <p>Parlo provide how all this mistaken idea of denouncing pleasure and sing pain was born an will give you a complete account of the system, and expound the actual teachings of the eat explorer. </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="about-story-area pt-50 pb-100">
    <div class="container">
        <div class="row">
            <?php if($error_message): ?>
            <div class="col-lg-12 col-md-12">
                <div class="alert alert-<?=$error_color?> fade show w-100 mb-0" role="alert">
                    <?=$error_message?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <?php endif; ?>
            <div class="col-lg-12 col-md-12">
                <div class="contact-from contact-shadow m-0">
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-lg-6 col-md-12">
                                <input name="nom" type="text" placeholder="Nom *" required>                    
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <input name="prenom" type="text" placeholder="Prénom *" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-12">              
                                <input name="email" type="email" placeholder="Email *" required>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <input name="telephone" type="phone" placeholder="Téléphone">
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <p class="pt-3 pl-3" d-inline-block">Fichier(s) JPG, JPEG, PNG, PDF, STL</p>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <input name="fichier" type="file" class="d-inline-block w-auto" accept=".stl, .jpg, .jpeg, .png, .pdf" multiple>
                            </div>
                        </div>
                        <input name="objet" type="text" placeholder="Objet *" required>
                        <textarea name="message" placeholder="Votre demande *" required></textarea>
                        <input name="btn_envoie" type="submit" value="Envoyer une demande">
                        <input type="hidden" id="g-token" name="gtoken">                        
                    </form>
                    <script>
                            grecaptcha.ready(function() {
                              grecaptcha.execute('<?=CAPTCHAPUBLIC?>', {action: 'submit'}).then(function(token) {
                                  document.getElementById('g-token').value = token;
                              });
                          });
                      </script> 
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    get_footer();
?>