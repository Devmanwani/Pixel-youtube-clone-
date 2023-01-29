<?php require_once("assets/includes/config.php");
require_once("assets/includes/classes/formEdit.php");
require_once("assets/includes/classes/account.php");
require_once("assets/includes/classes/constants.php");

$account = new account($con);

if (isset($_POST["submitButton"])){
    $firstName = formEdit::formEditString($_POST["firstName"]);
    $lastName = formEdit::formEditString($_POST["lastName"]);

    $username = formEdit::formEditUsername($_POST["username"]);

    $email = formEdit::formEditEmail($_POST["email"]);
    $email2 = formEdit::formEditEmail($_POST["email2"]);

    $password = formEdit::formEditPassword($_POST["password"]);
    $password2 = formEdit::formEditPassword($_POST["password2"]);

    $wasSuccessful = $account->register($firstName, $lastName, $username, $email, $email2, $password, $password2);
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
<title> Sign Up</title>
<link rel="stylesheet" type= "text/css" href="assets/bootstrap-5.1.0-dist/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="style.css">
<script src="assets/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.1/umd/popper.min.js" integrity="sha512-8jeQKzUKh/0pqnK24AfqZYxlQ8JdQjl9gGONwGwKbJiEaAPkD3eoIjz3IuX4IrP+dnxkchGUeWdXLazLHin+UQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="assets/bootstrap-5.1.0-dist/js/bootstrap.min.js"></script>

</head>
<body>
<div class="signUpContainer">

<div class="column">

    <div class="header">
    <img src="assets/images/icons/logo.png" title="logo" alt="PIXEL">
        <h3><b>Sign Up<b></h3>
        <span style="font-size:16px;"><b>to continue to PIXEL<b></span>
    </div>

    <div class="loginForm">
        <form action="signup.php" method = "POST">

            <?php echo $account->getError(constants::$firstNameCharacters);?>
                <input type="text" name="firstName" placeholder="First name" autocomplete="off" value="<?php getInputValue('firstName');?>" required>

                <?php echo $account->getError(constants::$lastNameCharacters);?>
                <input type="text" name="lastName" placeholder="Last name" autocomplete="off" value="<?php getInputValue('lastName');?>"  required>

                <?php echo $account->getError(constants::$usernameCharacters);?>
                <?php echo $account->getError(constants::$usernameTaken);?>
                <input type="text" name="username" placeholder="Username" autocomplete="off" value="<?php getInputValue('username');?>" required>

                <?php echo $account->getError(constants::$emailsDoNotMatch);?>
                <?php echo $account->getError(constants::$emailInvalid);?>
                <?php echo $account->getError(constants::$emailTaken);?>
                <input type="email" name="email" placeholder="Email"  value="<?php getInputValue('email');?>"  required>
                <input type="email" name="email2" placeholder="Confirm email" value="<?php getInputValue('email2');?>"  required>

                <?php echo $account->getError(constants::$passwordsDoNotMatch);?>
                <?php echo $account->getError(constants::$passwordLength);?>
                <input type="password" name="password" placeholder="Password" autocomplete="off"  required>
                <input type="password" name="password2" placeholder="Confirm password" autocomplete="off"  required>

                <input type="submit" name="submitButton" value="SUBMIT">
        </form> 
    
    </div>

    <a class="signInMessage" href="signIn.php"><b>Already have an account? Sign in here!<b></a>

</div>

</div>




</body>
</html>