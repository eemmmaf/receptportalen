<?php
/*
 * @Author: Emma Forslund - emfo2102 
 * @Date: 2022-06-20 01:57:47 
 * @Last Modified by: Emma Forslund - emfo2102
 * @Last Modified time: 2022-06-20 03:09:53
 */
$page_title = "Logga in";
include('includes/header.php');

//Sparar användarens mail och lösenord i variabler
if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    //Skapar instans av klassen User
    $login = new User();
    //Loggar in användaren om rätt användarnamn och lösenord anges
    if ($login->logIn($email, $password)) {
        header('Location:admin.php');
    } else {
        $message = "<p class='error-message'> Felaktig mailadress eller lösenord </p>";
    }
}
?>
<!--Formulär för att logga in-->
<form method="POST" action="login.php" id="login-form">
    <h2>Logga in</h2>
    <?php
    //Skriver ut felmeddelanden
    if (isset($message)) {
        echo $message;
    }
    ?>
    <div class="login">
        <label for="email">Epost:</label><br>
        <input type="email" name="email" id="email"><br><br>
        <label for="password">Lösenord:</label><br>
        <input type="password" name="password" id="password"><br><br>
        <input type="submit" value="Logga in">
        <div class="form-flex">
            <!--Länkar till register.php-->
            <div>
                <h3>Har du inget konto?</h3>
            </div>
            <div><a href="register.php" id="member">Bli medlem</a></div>
        </div>
    </div>
</form>
<!--Slut på formulär-->
<script src="js/main.js"></script>
</body>

</html>