<?php
$page_title = "Skapa nytt inlägg";
include('includes/header.php');
//Kontroll för att se om användaren är inloggad. Olika navigeringar visas beroende på om användare är inloggad eller ej
if (!isset($_SESSION['email'])) {
    header("Location:login.php");
}

//New instances of both classes
$user = new User();
$post = new Post();
$email = $_SESSION['email'];

//Sätter variablerna som sparar innehållet till default
$title = "";
$content = "";

//Kontroll för att se om formuläret är skickat
if (isset($_POST['title'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $categoryname = $_POST['category'];

    //Felmeddelanden
    $success = true; //Variabel för när det postade är OK
    if (!$post->setPost($title, $content, $categoryname)) {
        $success = false;

        $errormessage = "<p class='error-create'>Titel måste innehålla minst ett tecken</p>";
    }


    //Lägger till inlägget om input-fälten innehåller minst ett tecken
    if ($success) {
        if ($post->addPost($title, $content, $categoryname, $email)) {
            $message = "<p class='stored'> Inlägget har lagrats <i class='fa-solid fa-circle-check'></i> </p>";
            //Nollställer default variablerna om inlägget postas
            $title = "";
            $content = "";
            $categoryname = "";
        } else {
            $message =  "<p class='stored'> Fel vid lagring </p>";
        }
    } else {
        $message =  "<p class='stored'>Blogginlägg ej lagrat. Kontrollera innehållet och försök igen</p>";
    }
}
?>
<main class="admin-main">
    <!--Formulär för att skapa inlägg-->
    <form id="admin-form" method="post" action="create.php">
        <h2>Skapa ett inlägg</h2>
        <div class="output-form">
        <?php
        if (isset($message)) {
            echo $message;
        }
        ?>
        </div>
        <div class="centered">
            <br>
            <div><label for="title">Titel:</label><br></div>
            <div><input type="text" id="title" name="title" value='' <?= $title; ?>><br><br></div>
            <div><label for="category">Kategori:</label><br></div>
            <select name="category" id="category">
                <option value="">Välj rättens kategori</option>
                <option value="Lättlagat">Lättlagat</option>
                <option value="Festmiddag">Festmiddag</option>
                <option value="Fläsk">Fläsk</option>
                <option value="Kyckling">Kyckling</option>
                <option value="Nötkött">Nötkött</option>
                <option value="Vegetariskt">Vegetariskt </option>
            </select>
        </div>
        <label for="content">Innehåll:</label><br>
        <textarea id="content" name="content" rows="20"><?= $content; ?></textarea><br><br>
        <!--Byter ut textarea till CKEDITOR-->
        <script>
            CKEDITOR.replace('content');
        </script>
        <input type="submit" value="Skapa inlägg">
    </form>
</main>
<?php
include('includes/footer.php'); ?>