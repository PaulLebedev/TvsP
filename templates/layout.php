<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Teams vs. Problems</title>

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
      <link href="../css/bootstrap-glyphicons.css" rel="stylesheet">
    <link href="../css/user.css" rel="stylesheet">
      <script src="//code.jquery.com/jquery-latest.min.js"></script>
      <script src="/js/bootstrap.min.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>


      <![endif]-->
  </head>
  <body>
      
 <!-- header -->     
    <nav class="navbar navbar-inverse" role="navigation">
        <div class="container">
          <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
                <a class="navbar-brand"><img src="http://www.iconsdb.com/icons/preview/soylent-red/skull-42-l.png" height="30"></a>
                <a class="navbar-brand" href="/">Teams vs Problems</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                <li ><a href="/about">About</a></li>
                <li><a href="/list/IT">Problems</a></li>

                  <? if ($login->isUserLoggedIn() != true) { ?>
                  <li><a href="/register" class="navbar-link">Sign up</a></li>
                  <? } ?>
                <!--<li><a href="/register">Sign Up</a></li>-->
              </ul>

                <?
                if ($login->isUserLoggedIn() == true) { ?>
              <!-- when logged in -->
                <p class="navbar-text navbar-right">
                    
                    <a href="/profile/<?= $_SESSION["user_id"] ?>" class="navbar-link"><?= $_SESSION["user_name"]; ?></a>&nbsp;
                    <span class="glyphicon glyphicon-envelope"></span>&nbsp;|&nbsp;
                    Exp: <span class="badge">0</span> Cha: <span class="badge">0</span>
                    &nbsp;|&nbsp;                                      
                  
                    <span class="glyphicon glyphicon-remove"></span>
                    <a href="/?logout" class="navbar-link">Log out</a>
                </p>
              <!-- end when logged in --> 
                <? } else { ?>


                    <form method="post" action="/" class="navbar-form navbar-right" name="loginform">
                        <div class="form-group">
                            <label class="sr-only" for="login_input_username">Username</label>
                            <input class="form-control" id="login_input_username" class="login_input" type="text" name="user_name" required/>
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="login_input_password">Password</label>
                            <input class="form-control" id="login_input_password" class="login_input" type="password" name="user_password" autocomplete="off" required/>
                        </div>
                        <button type="submit" name="login" class="btn btn-success">Sign in</button>
                    </form>
                    <p class="navbar-text navbar-right">

                    </p>
                    <? }?>
              
             <!-- entrance form -->  

             <!-- end of entrance form -->
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </div>
    </nav>
<!-- end of header -->   
 
<!-- main part -->
<? $app->render($view . '.php', array("login" => $login)) ?>
<!-- end of main part -->

<!-- footer --> 
        <nav class="navbar navbar-default navbar-fixed-bottom" role="navigation">
        <div class="container">
            <p class='navbar-text pull-right'>Team vs Problems 2014</p>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                <li><a href="/about">About</a></li>
                <li><a href="/list/IT">Problems</a></li>
              </ul>
            </div><!-- /.navbar-collapse -->
            
        </div><!-- /.container-fluid -->
    
    </nav>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>-->
    <!-- Include all compiled plugins (below), or include individual files as needed -->

<!-- end of footer -->     
  </body>
</html>