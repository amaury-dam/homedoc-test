<!doctype html>
<html lang="fr" style="height: 100%;">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/home.css">
    <link rel="stylesheet" href="css/animate.css">
    <script src="js/wow.min.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>

<nav class="navbar navbar-expand-lg fixed-top bg-dark navbar-dark">
    <a class="navbar-brand" href="{{ url('patient/home') }}"><img height="30" src="/ressources/logo-petit.png"> Home'Doc</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <!--     <li class="nav-item active">
                     <a style="color: white;" class="nav-link" href="#"><i class="far fa-comment"></i> Chat</a>
                 </li> -->
        </ul>
        <ul class="navbar-nav ">
            <li class="nav-item">
                <a style="color: #2a9055" class="nav-link"  href="{{ url('patient/login') }}"><i class="fas fa-user" ></i> Patient</a>
            </li>
            <li class="nav-item">
                <a style="color: red" class="nav-link"  href="{{ url('doctor/login') }}"><i class="fas fa-user-md"></i> Docteur</a>
            </li>
        </ul>
    </div>
</nav>
<div class="container">
    <script>
        new WOW(
            {
                live:         true
            }
        ).init();
    </script>
    <script>
        AOS.init();
    </script>
    <section style="margin-top: 90px !important;" class="resume-section" id="apropos">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <h2>Home'<span class="color_title">Doc</span></h2>
                <p class="subheading">Assistant de santé connecté</p>
                <p class="introduction">La solution Home’Doc pour un diagnostic rapide de symptômes.</p>
                <p>Un assistant de santé permettant de conseiller l’utilisateur à l’aide de données vérifiées et vulgarisées par des médecins.</p>
                <p> À la portée de tous, Home’Doc est un vrai assistant personnel. Il sera accessible par de nombreux outils technologiques.</p>

            </div>
            <div class="col-lg-6 col-md-6">
                <img class="logo" src="/ressources/logo.png">
            </div>
        </div>
    </section>
    <section class="resume-section" id="chiffres" style="margin-top: 100px">
        <h2 class="color_title">Chiffres</h2>
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <div class="circle" data-aos="fade-up"
                     data-aos-anchor-placement="bottom-bottom" data-aos-duration="1500">
                    60 %
                </div>
                <div class="descript_chiffres text-md-center text-lg-center">60 % de la population française recherche leurs symptômes sur internet</div>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="circle" data-aos="fade-up"
                     data-aos-anchor-placement="bottom-bottom" data-aos-duration="1500">
                    42 %
                </div>
                <div class="descript_chiffres text-md-center text-lg-center">42% de la population française déclare s’auto-diagnostiquer</div>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="circle" data-aos="fade-up"
                     data-aos-anchor-placement="bottom-bottom" data-aos-duration="1500">
                    25 %
                </div>
                <div class="descript_chiffres text-md-center text-lg-center">25 % de ces personnes vérifient l'exactitude des données consultées</div>
            </div>
        </div>
    </section>
    <section class="resume-section" data-aos="fade-in" style="margin-top: 100px"
             data-aos-anchor-placement="bottom-bottom" data-aos-duration="1500" id="outils">
        <h2 class="color_title">Outils</h2>
        <p>On pourra intéragir avec Home'Doc à l'aide de différents outils technologiques comme le Google Home, l’Amazon Echo et le Apple HomePod qui sont les principaux assistants personnels intelligents pouvant réagir aux commandes vocales. Home'Doc sera également accessible en version web via un chatbot, notre solution pourra donc être utilisé de n’importe où.</p>
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <img class="outils" src="/ressources//amazon-echo.jpg">
            </div>
            <div class="col-lg-4 col-md-4">
                <img class="outils" src="/ressources//homepod-white.jpg">
            </div>
            <div class="col-lg-4 col-md-4">
                <img class="outils" src="/ressources//home.jpg">
            </div>
        </div>
        <p>Avec son Intelligence Artificielle, Home’Doc sera capable de commencer un diagnostic, via une simple phrase donnée aux assistants connectés ou bien écrite sur l’interface web. Ce diagnostic sera fait le plus simplement possible, l’IA posera de nouvelles questions en fonction des réponses précédentes de l’utilisateur. Une fois le diagnostic posé, l’utilisateur sera redirigé vers une fiche descriptive de sa maladie et une section commentaire.</p>
    </section>
    <section class="resume-section" id="rendu" style="margin-top: 100px">
        <h2 class="color_title">Rendu</h2>
        <div class="row">
            <div class="col-lg-6 col-md-6" data-aos="fade-right"
                 data-aos-anchor-placement="bottom-bottom" data-aos-duration="1500">
                <img class="rendu_img" src="ressources//resultat.png">
                <h5 class="text-center">Une fiche d'information simple et complète</h5>
                <p class="text-center">La fiche d’information sur la maladie sera présentée avec les symptômes, les jours d’incubations et de contagions et les gestes à suivre.</p>
            </div>
            <div class="col-lg-6 col-md-6" data-aos="fade-left"
                 data-aos-anchor-placement="bottom-bottom" data-aos-duration="1500">
                <img class="rendu_img" src="ressources//overflow.png">
                <h5 class="text-center">La section de commentaire</h5>
                <p class="text-center">La section commentaire servira aux utilisateurs pour se conseiller entre eux. Un premier utilisateur pourra dire que ce qui l’a aidé pour sa grippe était de prendre un thé tous les matins. Un second utilisateur pourra alors tester ce conseil et voter par un + ou – afin d’indiquer si le commentaire lui a été utile. Les commentaires seront affichés selon leur note ce qui permettra d’avoir le commentaire le mieux noté tout en haut pour une meilleure visibilité pour l’utilisateur arrivant sur la fiche.</p>
            </div>
        </div>
    </section>
    <section class="resume-section" id="avantages" style="margin-top: 100px">
        <h2 class="color_title">Avantages</h2>
        <div class="row">
            <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-anchor-placement="bottom-bottom" data-aos-duration="1500">
                <h5 class="text-center">Entreprises</h5>

                <ul class="avantages">
                    <li>Moins d'absentéisme</li>
                    <li>Plus de productivité</li>
                    <li>Moins de remboursements</li>
                </ul>
            </div>
            <div class="col-lg-6 col-md-6" data-aos="fade-down" data-aos-anchor-placement="bottom-bottom" data-aos-duration="7000">
                <h5 class="text-center">Utilisateurs</h5>

                <ul class="avantages">
                    <li>Plus rassurant</li>
                    <li>Moins de douleurs</li>
                    <li>Plus préventif</li>
                    <li>Gain de temps</li>
                    <li>Partager son expérience</li>
                </ul>
            </div>
        </div>
    </section>
</div>
</body>
</html>