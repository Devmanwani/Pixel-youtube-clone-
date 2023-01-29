<?php require_once("assets/includes/config.php");
require_once("assets/includes/classes/formEdit.php");
require_once("assets/includes/classes/account.php");
require_once("assets/includes/classes/constants.php");

$account = new account($con);

if (isset($_POST["submitButton"])){
    
    $username = formEdit::formEditUsername($_POST["username"]);
    $password = formEdit::formEditPassword($_POST["password"]);

    $wasSuccessful = $account->login($username, $password);
    
    if($wasSuccessful){
        $_SESSION["userLoggedIn"] = $username;
        header("Location:index.php");
    }
    else{
        echo "failed";
    }
}

function getInputValue($name){
    if(isset($_POST[$name])){
        echo $_POST[$name];
    }
}

?>
<!DOCTYPE html>
<html>
<head>
<title> PIXEL</title>
<link rel="stylesheet" type= "text/css" href="assets/bootstrap-5.1.0-dist/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="style.css">
<script src="assets/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.1/umd/popper.min.js" integrity="sha512-8jeQKzUKh/0pqnK24AfqZYxlQ8JdQjl9gGONwGwKbJiEaAPkD3eoIjz3IuX4IrP+dnxkchGUeWdXLazLHin+UQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="assets/bootstrap-5.1.0-dist/js/bootstrap.min.js"></script>
<script src="javascript/commonActions.js"></script>
</head>
<body>
    <div class="signInContainer">

        <div class="column">

            <div class="header">
                <img src="assets/images/icons/logo.png" title="logo" alt="PIXEL">
                <h3>Sign In</h3>
                <span>to continue to VideoTube</span>
            </div>

            <div class="loginForm">

                <form action="signIn.php" method = "POST">

                <?php echo $account->getError(constants::$loginFailed);?>
                    <input type="text" name="username" placeholder="Username" required autocomplete="off" value="<?php getInputValue('username');?>" >
                    <input type="password" name="password" placeholder="Password"  required >
                    <input type="submit" name="submitButton" value="SUBMIT">
                
                </form>


            </div>

            <a class="signInMessage" href="signup.php">Need an account? Sign up here!</a>
        
        </div>
    
    </div>




</body>
</html>