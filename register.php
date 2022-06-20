<?php
/*
 * @Author: Emma Forslund - emfo2102 
 * @Date: 2022-06-19 17:47:33 
 * @Last Modified by: Emma Forslund - emfo2102
 * @Last Modified time: 2022-06-20 02:03:52
 */

$page_title = "Skapa blogg";
include('includes/header.php');

//Saving the data posted from form
if (isset($_POST['blogname'])) {
    $email = $_POST['email'];
    $blogname = $_POST['blogname'];
    $password = $_POST['password'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $age = $_POST['age'];
    $description= $_POST['info'];

    $register = new User();
    $success = true;

    //Check password
    if (!$register->setPassword($password)) {
        $success = false;
        $errorpassword = "<span class='error-form'>Lösenordet måste innehålla minst 8 tecken</span>";
    }
    //Check email
    if (!$register->setEmail($email)) {
        $success = false;
        $errorpassword = "<span class='error-form'>Lösenordet måste innehålla minst 8 tecken</span>";
    }
    //Check blogname
    if (!$register->setBlogname($blogname)) {
        $success = false;
        $errorpassword = "<span class='error-form'>Lösenordet måste innehålla minst 8 tecken</span>";
    }

    //Check the names, age and description
    if (!$register->setUser($fname, $lname, $age, $description)) {
        $success = false;
        $errorpassword = "<span class='error-form'>Lösenordet måste innehålla minst 8 tecken</span>";
    }

    //Check to see if blogname and email is unique
    if ($register->uniqueNames($blogname, $email)) {
        $message = "<p class='error-message'> Användare finns redan </p>";
    } else {
        if ($register->registerUser($fname, $lname, $age, $description, $blogname, $email, $password)) {
            $message = "<p> Användare skapad </p>";
        } else {
            $message = "<p class='error-message'> Fel vid skapande av användare </p>";
        }
    }
}


?>
<main>
    <!--Form for registration-->
    <form action="register.php" method="POST" id="register">
        <h2>Skapa en matblogg</h2>
        <p>Här kan du skapa en matblogg helt gratis</p>
        <?php
        //Output error-message
        if (isset(
            $message
        )) {
            echo $message;
        }
        ?>

        <!--Bloggens namn-->
        <label for="blogname">Bloggens namn:</label><br>
        <input type="text" name="blogname" id="blogname"><br><br>
        <div class="error-js"></div>
        <?php
        //Skriver ut felmeddelande
        if (isset($errorblogname)) {
            echo $errorblogname;
        } ?>


        <!--Epost-->
        <label for="email">Epost:</label><br>
        <input type="email" name="email" id="email"><br><br>
        <div class="error-js"></div>
        <?php
        //Skriver ut felmeddelande
        if (isset($errormail)) {
            echo $errormail;
        }
        ?>


        <!--Förnamn-->
        <label for="fname">Förnamn:</label><br>
        <input type="text" name="fname" id="fname"><br><br>
        <div class="error-js"></div>
        <?php
        //Skriver ut felmeddelande
        if (isset($errorename)) {
            echo $errorename;
        }
        ?>


        <!--Efternamn-->
        <label for="lname">Efternamn:</label><br>
        <input type="text" name="lname" id="lname"><br><br>
        <div class="error-js"></div>
        <?php
        //Skriver ut felmeddelande
        if (isset($errorfname)) {
            echo $errorfname;
        }
        ?>


        <!--Age-->
        <label for="age">Ålder</label><br>
        <input type="text" name="age" id="age"><br><br>
        <div class="error-js"></div>
        <?php
        //Skriver ut felmeddelande
        if (isset($errorfname)) {
            echo $errorfname;
        }
        ?>

        <!--Description-->
        <label for="info">Beskrivning av blogg:</label><br>
        <textarea name="info" id="info"></textarea>
        <div class="error-js"></div>
        <?php
        //Skriver ut felmeddelande
        if (isset($errorfname)) {
            echo $errorfname;
        }
        ?>

        <!--Lösenord-->
        <label for="password">Lösenord:</label><br>
        <input type="password" name="password" id="password" placeholder="Lösenordet måste innehålla minst 8 tecken" onchange="passwordValidation()"><br><br>
        <p id="ok"></p>
        <?php
        //Skriver ut felmeddelande
        if (isset($errorpassword)) {
            echo $errorpassword;
        }
        ?>


        <!--Godkänn lagring-->
        <input type="checkbox" id="approve" name="approve" value="Jag godkänner">
        <label for="approve">Jag godkänner lagring av mina uppgifter</label><br><br>
        <p id="approve-p"></p>

        <!--Logga in-->
        <input type="submit" value="Skapa blogg" id="submitEl">
    </form>

</main>
<?php
include('includes/footer.php');
?>