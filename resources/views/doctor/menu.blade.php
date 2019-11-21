<nav class="navbar navbar-dark navbar-expand-lg fixed-top" style="background-color: #0083ca;">
    <a style="color: white;" class="navbar-brand item-menu-doctor" href="{{ url('doctor/home') }}"><img height="45" style="background-color: white; padding: 4px; border-radius: 5px;" src="/ressources/logo-homedoc-moyen.png"></a>
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
                <a style="color: white;" class="nav-link item-menu-doctor" href="{{ url('doctor/wiki') }}"><i class="far fa-file"></i> Fiches</a>
            </li>
            <li class="nav-item">
                <a style="color: white;" class="nav-link item-menu-doctor" href="{{ url('doctor/messaging') }}"><i class="far fa-comment"></i> Conversations</a>
            </li>
            <li class="nav-item">
                <a style="color: white;" class="nav-link item-menu-doctor" href="{{ url('doctor/profil') }}"><i class="far fa-user"></i> Profil</a>
            </li>
            <li class="nav-item">
                <a style="color: white;" class="nav-link item-menu-doctor" href="{{ url('doctor/login') }}"><i class="fas fa-sign-out-alt"></i> Déconnexion</a>
            </li>
        </ul>
    </div>
</nav>
