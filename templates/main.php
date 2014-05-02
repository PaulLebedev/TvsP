<?php

if ($login->isUserLoggedIn() != true) {
// show potential errors / feedback (from login object)
    if (isset($login)) {
        if ($login->errors) {
            foreach ($login->errors as $error) {
                echo $error;
            }
        }
        if ($login->messages) {
            foreach ($login->messages as $message) {
                echo $message;
            }
        }
    }
    ?>

<!-- login form box -->
<form method="post" action="/" name="loginform">

    <label for="login_input_username">Username</label>
    <input id="login_input_username" class="login_input" type="text" name="user_name" required/>

    <label for="login_input_password">Password</label>
    <input id="login_input_password" class="login_input" type="password" name="user_password" autocomplete="off"
           required/>

    <input type="submit" name="login" value="Log in"/>

</form>

<a href="/register">Register new account</a>

<? } else { ?>

Hey, <?php echo $_SESSION['user_name']; ?>.
<br/>
<iframe src="http://91.210.106.63:8888/chat?username=<?php echo $_SESSION['user_name']; ?>&room=1" width="900" height="600" frameBorder="0"></iframe>
<br/><a href="/?logout">Logout</a>

<? } ?>