<?php
require_once ('db.php');
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
    $firstname = htmlentities(trim($_POST['firstname']));
    $lastanme = htmlentities(trim($_POST['lastname']));
    $iso = htmlentities(trim($_POST['code_iso']));
    $email = htmlentities(trim($_POST['email']));
    $siret = htmlentities(trim($_POST['siret']));
    $adresse = htmlentities(trim($_POST['adresse']));
    $sold = htmlentities(trim($_POST['sold']));
    $sql = "INSERT INTO Client (firstname, lastname, code_iso, email, siret, adresse, sold) values(?, ?, ?, ?, ?, ?, ?)";
    $q = $db->prepare($sql);
    $q->execute(array($firstname, $lastanme, $iso, $email, $siret, $adresse, $sold));
    logBDD($db, 'created', "Client");
    header("Location: clients.php");
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>Ajouter un client</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <?php include "partials/header-link.php"; ?>
</head>

<body>

<!-- Begin page -->
<div id="wrapper">

    <!-- Topbar Start -->
    <?php include ('topbar.php') ?>
    <!-- end Topbar -->

    <!-- ========== Left Sidebar Start ========== -->
    <?php include('sidebar.php') ?>
    <!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Clients</a></li>
                                    <li class="breadcrumb-item active">Ajouter</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Ajouter un client</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card-box">
                            <h4 class="header-title">Ajouter un client</h4>

                            <form class="form-horizontal" method="POST" action="client-add.php">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="firstname">Prénom</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="firstname" class="form-control" id="firstname" placeholder="Prénom">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="lastname">Nom</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="lastname" class="form-control" id="lastname" placeholder="Nom">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="email">Email</label>
                                    <div class="col-sm-6">
                                        <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="code_iso">Pays</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" id="code_iso" name="code_iso" required>
                                            <option value="" selected disabled>Sélectionnez un pays</option>
                                            <option value="AF">Afghanistan</option>
                                            <option value="ZA">Afrique du sud</option>
                                            <option value="AX">Åland, îles</option>
                                            <option value="AL">Albanie</option>
                                            <option value="DZ">Algérie</option>
                                            <option value="DE">Allemagne</option>
                                            <option value="AD">Andorre</option>
                                            <option value="AO">Angola</option>
                                            <option value="AI">Anguilla</option>
                                            <option value="AQ">Antarctique</option>
                                            <option value="AG">Antigua et barbuda</option>
                                            <option value="SA">Arabie saoudite</option>
                                            <option value="AR">Argentine</option>
                                            <option value="AM">Arménie</option>
                                            <option value="AW">Aruba</option>
                                            <option value="AU">Australie</option>
                                            <option value="AT">Autriche</option>
                                            <option value="AZ">Azerbaïdjan</option>
                                            <option value="BS">Bahamas</option>
                                            <option value="BH">Bahreïn</option>
                                            <option value="BD">Bangladesh</option>
                                            <option value="BB">Barbade</option>
                                            <option value="BY">Bélarus</option>
                                            <option value="BE">Belgique</option>
                                            <option value="BZ">Belize</option>
                                            <option value="BJ">Bénin</option>
                                            <option value="BM">Bermudes</option>
                                            <option value="BT">Bhoutan</option>
                                            <option value="BO">Bolivie, l'état plurinational de</option>
                                            <option value="BQ">Bonaire, saint eustache et saba</option>
                                            <option value="BA">Bosnie herzégovine</option>
                                            <option value="BW">Botswana</option>
                                            <option value="BV">Bouvet, île</option>
                                            <option value="BR">Brésil</option>
                                            <option value="BN">Brunei darussalam</option>
                                            <option value="BG">Bulgarie</option>
                                            <option value="BF">Burkina faso</option>
                                            <option value="BI">Burundi</option>
                                            <option value="KY">Caïmans, îles</option>
                                            <option value="KH">Cambodge</option>
                                            <option value="CM">Cameroun</option>
                                            <option value="CA">Canada</option>
                                            <option value="CV">Cap vert</option>
                                            <option value="CF">Centrafricaine, république</option>
                                            <option value="CL">Chili</option>
                                            <option value="CN">Chine</option>
                                            <option value="CX">Christmas, île</option>
                                            <option value="CY">Chypre</option>
                                            <option value="CC">Cocos (keeling), îles</option>
                                            <option value="CO">Colombie</option>
                                            <option value="KM">Comores</option>
                                            <option value="CG">Congo</option>
                                            <option value="CD">Congo, la république démocratique du</option>
                                            <option value="CK">Cook, îles</option>
                                            <option value="KR">Corée, république de</option>
                                            <option value="KP">Corée, république populaire démocratique de</option>
                                            <option value="CR">Costa rica</option>
                                            <option value="CI">Côte d'ivoire</option>
                                            <option value="HR">Croatie</option>
                                            <option value="CU">Cuba</option>
                                            <option value="CW">Curaçao</option>
                                            <option value="DK">Danemark</option>
                                            <option value="DJ">Djibouti</option>
                                            <option value="DO">Dominicaine, république</option>
                                            <option value="DM">Dominique</option>
                                            <option value="EG">Égypte</option>
                                            <option value="SV">El salvador</option>
                                            <option value="AE">Émirats arabes unis</option>
                                            <option value="EC">Équateur</option>
                                            <option value="ER">Érythrée</option>
                                            <option value="ES">Espagne</option>
                                            <option value="EE">Estonie</option>
                                            <option value="US">États unis</option>
                                            <option value="ET">Éthiopie</option>
                                            <option value="FK">Falkland, îles (malvinas)</option>
                                            <option value="FO">Féroé, îles</option>
                                            <option value="FJ">Fidji</option>
                                            <option value="FI">Finlande</option>
                                            <option value="FR">France</option>
                                            <option value="GA">Gabon</option>
                                            <option value="GM">Gambie</option>
                                            <option value="GE">Géorgie</option>
                                            <option value="GS">Géorgie du sud et les îles sandwich du sud</option>
                                            <option value="GH">Ghana</option>
                                            <option value="GI">Gibraltar</option>
                                            <option value="GR">Grèce</option>
                                            <option value="GD">Grenade</option>
                                            <option value="GL">Groenland</option>
                                            <option value="GP">Guadeloupe</option>
                                            <option value="GU">Guam</option>
                                            <option value="GT">Guatemala</option>
                                            <option value="GG">Guernesey</option>
                                            <option value="GN">Guinée</option>
                                            <option value="GW">Guinée bissau</option>
                                            <option value="GQ">Guinée équatoriale</option>
                                            <option value="GY">Guyana</option>
                                            <option value="GF">Guyane française</option>
                                            <option value="HT">Haïti</option>
                                            <option value="HM">Heard et îles macdonald, île</option>
                                            <option value="HN">Honduras</option>
                                            <option value="HK">Hong kong</option>
                                            <option value="HU">Hongrie</option>
                                            <option value="IM">Île de man</option>
                                            <option value="UM">Îles mineures éloignées des états unis</option>
                                            <option value="VG">Îles vierges britanniques</option>
                                            <option value="VI">Îles vierges des états unis</option>
                                            <option value="IN">Inde</option>
                                            <option value="ID">Indonésie</option>
                                            <option value="IR">Iran, république islamique d'</option>
                                            <option value="IQ">Iraq</option>
                                            <option value="IE">Irlande</option>
                                            <option value="IS">Islande</option>
                                            <option value="IL">Israël</option>
                                            <option value="IT">Italie</option>
                                            <option value="JM">Jamaïque</option>
                                            <option value="JP">Japon</option>
                                            <option value="JE">Jersey</option>
                                            <option value="JO">Jordanie</option>
                                            <option value="KZ">Kazakhstan</option>
                                            <option value="KE">Kenya</option>
                                            <option value="KG">Kirghizistan</option>
                                            <option value="KI">Kiribati</option>
                                            <option value="KW">Koweït</option>
                                            <option value="LA">Lao, république démocratique populaire</option>
                                            <option value="LS">Lesotho</option>
                                            <option value="LV">Lettonie</option>
                                            <option value="LB">Liban</option>
                                            <option value="LR">Libéria</option>
                                            <option value="LY">Libye</option>
                                            <option value="LI">Liechtenstein</option>
                                            <option value="LT">Lituanie</option>
                                            <option value="LU">Luxembourg</option>
                                            <option value="MO">Macao</option>
                                            <option value="MK">Macédoine, l'ex république yougoslave de</option>
                                            <option value="MG">Madagascar</option>
                                            <option value="MY">Malaisie</option>
                                            <option value="MW">Malawi</option>
                                            <option value="MV">Maldives</option>
                                            <option value="ML">Mali</option>
                                            <option value="MT">Malte</option>
                                            <option value="MP">Mariannes du nord, îles</option>
                                            <option value="MA">Maroc</option>
                                            <option value="MH">Marshall, îles</option>
                                            <option value="MQ">Martinique</option>
                                            <option value="MU">Maurice</option>
                                            <option value="MR">Mauritanie</option>
                                            <option value="YT">Mayotte</option>
                                            <option value="MX">Mexique</option>
                                            <option value="FM">Micronésie, états fédérés de</option>
                                            <option value="MD">Moldova, république de</option>
                                            <option value="MC">Monaco</option>
                                            <option value="MN">Mongolie</option>
                                            <option value="ME">Monténégro</option>
                                            <option value="MS">Montserrat</option>
                                            <option value="MZ">Mozambique</option>
                                            <option value="MM">Myanmar</option>
                                            <option value="NA">Namibie</option>
                                            <option value="NR">Nauru</option>
                                            <option value="NP">Népal</option>
                                            <option value="NI">Nicaragua</option>
                                            <option value="NE">Niger</option>
                                            <option value="NG">Nigéria</option>
                                            <option value="NU">Niué</option>
                                            <option value="NF">Norfolk, île</option>
                                            <option value="NO">Norvège</option>
                                            <option value="NC">Nouvelle calédonie</option>
                                            <option value="NZ">Nouvelle zélande</option>
                                            <option value="IO">Océan indien, territoire britannique de l'</option>
                                            <option value="OM">Oman</option>
                                            <option value="UG">Ouganda</option>
                                            <option value="UZ">Ouzbékistan</option>
                                            <option value="PK">Pakistan</option>
                                            <option value="PW">Palaos</option>
                                            <option value="PS">Palestinien occupé, territoire</option>
                                            <option value="PA">Panama</option>
                                            <option value="PG">Papouasie nouvelle guinée</option>
                                            <option value="PY">Paraguay</option>
                                            <option value="NL">Pays bas</option>
                                            <option value="PE">Pérou</option>
                                            <option value="PH">Philippines</option>
                                            <option value="PN">Pitcairn</option>
                                            <option value="PL">Pologne</option>
                                            <option value="PF">Polynésie française</option>
                                            <option value="PR">Porto rico</option>
                                            <option value="PT">Portugal</option>
                                            <option value="QA">Qatar</option>
                                            <option value="RE">Réunion</option>
                                            <option value="RO">Roumanie</option>
                                            <option value="GB">Royaume uni</option>
                                            <option value="RU">Russie, fédération de</option>
                                            <option value="RW">Rwanda</option>
                                            <option value="EH">Sahara occidental</option>
                                            <option value="BL">Saint barthélemy</option>
                                            <option value="SH">Sainte hélène, ascension et tristan da cunha</option>
                                            <option value="LC">Sainte lucie</option>
                                            <option value="KN">Saint kitts et nevis</option>
                                            <option value="SM">Saint marin</option>
                                            <option value="MF">Saint martin(partie française)</option>
                                            <option value="SX">Saint martin (partie néerlandaise)</option>
                                            <option value="PM">Saint pierre et miquelon</option>
                                            <option value="VA">Saint siège (état de la cité du vatican)</option>
                                            <option value="VC">Saint vincent et les grenadines</option>
                                            <option value="SB">Salomon, îles</option>
                                            <option value="WS">Samoa</option>
                                            <option value="AS">Samoa américaines</option>
                                            <option value="ST">Sao tomé et principe</option>
                                            <option value="SN">Sénégal</option>
                                            <option value="RS">Serbie</option>
                                            <option value="SC">Seychelles</option>
                                            <option value="SL">Sierra leone</option>
                                            <option value="SG">Singapour</option>
                                            <option value="SK">Slovaquie</option>
                                            <option value="SI">Slovénie</option>
                                            <option value="SO">Somalie</option>
                                            <option value="SD">Soudan</option>
                                            <option value="SS">Soudan du sud</option>
                                            <option value="LK">Sri lanka</option>
                                            <option value="SE">Suède</option>
                                            <option value="CH">Suisse</option>
                                            <option value="SR">Suriname</option>
                                            <option value="SJ">Svalbard et île jan mayen</option>
                                            <option value="SZ">Swaziland</option>
                                            <option value="SY">Syrienne, république arabe</option>
                                            <option value="TJ">Tadjikistan</option>
                                            <option value="TW">Taïwan, province de chine</option>
                                            <option value="TZ">Tanzanie, république unie de</option>
                                            <option value="TD">Tchad</option>
                                            <option value="CZ">Tchèque, république</option>
                                            <option value="TF">Terres australes françaises</option>
                                            <option value="TH">Thaïlande</option>
                                            <option value="TL">Timor leste</option>
                                            <option value="TG">Togo</option>
                                            <option value="TK">Tokelau</option>
                                            <option value="TO">Tonga</option>
                                            <option value="TT">Trinité et tobago</option>
                                            <option value="TN">Tunisie</option>
                                            <option value="TM">Turkménistan</option>
                                            <option value="TC">Turks et caïcos, îles</option>
                                            <option value="TR">Turquie</option>
                                            <option value="TV">Tuvalu</option>
                                            <option value="UA">Ukraine</option>
                                            <option value="UY">Uruguay</option>
                                            <option value="VU">Vanuatu</option>
                                            <option value="VE">Venezuela, république bolivarienne du</option>
                                            <option value="VN">Viet nam</option>
                                            <option value="WF">Wallis et futuna</option>
                                            <option value="YE">Yémen</option>
                                            <option value="ZM">Zambie</option>
                                            <option value="ZW">Zimbabwe​​​​​</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="siret">Siret</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="siret" class="form-control" id="siret" placeholder="Siret">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="adresse">Adresse</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="adresse" class="form-control" id="adresse" placeholder="15 rue Voltaire Paris 75000">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="sold">Solde</label>
                                    <div class="col-sm-6">
                                        <input type="number" name="sold" class="form-control" id="sold" placeholder="Solde">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="offset-sm-2"></div>
                                    <div class="col-sm-6">
                                        <button type="submit" class="btn btn-success">Créer</button>
                                    </div>
                                </div>
                            </form>

                        </div> <!-- end card-box -->
                    </div><!-- end col -->
                </div>
                <!-- end row -->

            </div> <!-- container-fluid -->

        </div> <!-- content -->

        <!-- Footer Start -->
        <?php include('footer.php') ?>
        <!-- end Footer -->

    </div>

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->


</div>
<!-- END wrapper -->

<!-- Right Sidebar -->
<div class="right-bar">
    <div class="rightbar-title">
        <a href="javascript:void(0);" class="right-bar-toggle float-right">
            <i class="mdi mdi-close"></i>
        </a>
        <h5 class="m-0 text-white">Settings</h5>
    </div>
    <div class="slimscroll-menu">
        <!-- User box -->
        <div class="user-box">
            <div class="user-img">
                <img src="assets/images/users/avatar-1.jpg" alt="user-img" title="Mat Helme" class="rounded-circle img-fluid">
                <a href="javascript:void(0);" class="user-edit"><i class="mdi mdi-pencil"></i></a>
            </div>

            <h5><a href="javascript: void(0);">Agnes Kennedy</a> </h5>
            <p class="text-muted mb-0"><small>Admin Head</small></p>
        </div>

        <!-- Settings -->
        <hr class="mt-0" />
        <h5 class="pl-3">Basic Settings</h5>
        <hr class="mb-0" />


        <div class="p-3">
            <div class="checkbox checkbox-primary mb-2">
                <input id="checkbox1" type="checkbox" checked>
                <label for="checkbox1">
                    Notifications
                </label>
            </div>
            <div class="checkbox checkbox-primary mb-2">
                <input id="checkbox2" type="checkbox" checked>
                <label for="checkbox2">
                    API Access
                </label>
            </div>
            <div class="checkbox checkbox-primary mb-2">
                <input id="checkbox3" type="checkbox">
                <label for="checkbox3">
                    Auto Updates
                </label>
            </div>
            <div class="checkbox checkbox-primary mb-2">
                <input id="checkbox4" type="checkbox" checked>
                <label for="checkbox4">
                    Online Status
                </label>
            </div>
            <div class="checkbox checkbox-primary mb-0">
                <input id="checkbox5" type="checkbox" checked>
                <label for="checkbox5">
                    Auto Payout
                </label>
            </div>
        </div>

        <!-- Timeline -->
        <hr class="mt-0" />
        <h5 class="pl-3 pr-3">Messages <span class="float-right badge badge-pill badge-danger">25</span></h5>
        <hr class="mb-0" />
        <div class="p-3">
            <div class="inbox-widget">
                <div class="inbox-item">
                    <div class="inbox-item-img"><img src="assets/images/users/avatar-1.jpg" class="rounded-circle" alt=""></div>
                    <p class="inbox-item-author"><a href="javascript: void(0);" class="text-dark">Chadengle</a></p>
                    <p class="inbox-item-text">Hey! there I'm available...</p>
                    <p class="inbox-item-date">13:40 PM</p>
                </div>
                <div class="inbox-item">
                    <div class="inbox-item-img"><img src="assets/images/users/avatar-2.jpg" class="rounded-circle" alt=""></div>
                    <p class="inbox-item-author"><a href="javascript: void(0);" class="text-dark">Tomaslau</a></p>
                    <p class="inbox-item-text">I've finished it! See you so...</p>
                    <p class="inbox-item-date">13:34 PM</p>
                </div>
                <div class="inbox-item">
                    <div class="inbox-item-img"><img src="assets/images/users/avatar-3.jpg" class="rounded-circle" alt=""></div>
                    <p class="inbox-item-author"><a href="javascript: void(0);" class="text-dark">Stillnotdavid</a></p>
                    <p class="inbox-item-text">This theme is awesome!</p>
                    <p class="inbox-item-date">13:17 PM</p>
                </div>

                <div class="inbox-item">
                    <div class="inbox-item-img"><img src="assets/images/users/avatar-4.jpg" class="rounded-circle" alt=""></div>
                    <p class="inbox-item-author"><a href="javascript: void(0);" class="text-dark">Kurafire</a></p>
                    <p class="inbox-item-text">Nice to meet you</p>
                    <p class="inbox-item-date">12:20 PM</p>

                </div>
                <div class="inbox-item">
                    <div class="inbox-item-img"><img src="assets/images/users/avatar-5.jpg" class="rounded-circle" alt=""></div>
                    <p class="inbox-item-author"><a href="javascript: void(0);" class="text-dark">Shahedk</a></p>
                    <p class="inbox-item-text">Hey! there I'm available...</p>
                    <p class="inbox-item-date">10:15 AM</p>

                </div>
            </div> <!-- end inbox-widget -->
        </div> <!-- end .p-3-->

    </div> <!-- end slimscroll-menu-->
</div>
<!-- /Right-bar -->

<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>

<?php include "partials/scripts.php" ?>

</body>
</html>