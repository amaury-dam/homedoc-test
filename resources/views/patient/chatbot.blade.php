<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/home.css">

    <title>Home'Doc</title>

    <!-- Bootstrap core CSS -->
    <link href="/css/chatbot.css" rel="stylesheet">
    <!-- Custom styles for this template -->

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

  </head>

  <body>








        <!--- Chat-bot --->
          @include('patient/menu')
        <div class="container">


            <div style="margin-top: 90px; text-align: center; box-shadow: 0 3px 6px rgba(0,0,0,.16),0 3px 6px rgba(0,0,0,.23);">
                <div style="height: 80px; border-bottom: 2px solid rgba(52, 58, 64, 0.4);">
                    <div class="logo">
                        <img alt="logo" height="60" src="/ressources/logo-petit.png">
                    </div>
                    <h3 style="float: left; margin: 20px;color:#343a40; font-weight: bold;">Chatbot</h3>
                    <span id="action_menu_btn" style="float: right; margin: 20px; font-size: 25px;"><i style="color: #343a40;" class="fas fa-cog"></i></span>
                    <div style="display: none;" class="action_menu">
                        <ul style="list-style-type: none; padding: 0px;">
                            <li><a id="delete"><i class="far fa-trash-alt"></i> Supprimer</a></li>
                        </ul>
                    </div>
                </div>
                <div class="body-chat">
                    <div class="in-body-chat" id="body-chat">

                    </div>

                </div>
                <div class="foot-chat">
                    <textarea id="input" type="text" class="input-chat" placeholder="Dites moi quelque chose ..."></textarea>
                    <button id="rec" class="btn btn-dark button-chat">Envoyer</button>
                </div>
            </div>
        </div>


    <script>


    </script>
    <script defer src="https://assets.dialogflow.com/prod/1056_20180315163314/js/bundles/agentDemo.bundle.min.js"></script>





    <!-- Bootstrap core JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="/js/chatbot.js"></script>

  </body>

</html>
