<?php
/*
 * @Author: Emma Forslund - emfo2102 
 * @Date: 2022-06-20 13:04:18 
 * @Last Modified by: Emma Forslund - emfo2102
 * @Last Modified time: 2022-06-20 13:15:19
 */

$page_title = "Mina inlägg";
include('includes/header.php');
//Kontroll för att se om användaren är inloggad. Olika navigeringar visas beroende på om användare är inloggad eller ej
if (!isset($_SESSION['email'])) {
    header("Location:login.php");
}

//New instances of both classes
$user = new User();
$post = new Post();
$email = $_SESSION['email'];
?>

<main class="admin-main">
    <h2>Lagrade inlägg</h2>

    <?php
    //Anropar funktionen som hämtar den inloggade användarens inlägg
    $post_list = $post->getPostByUser();
    //Loopar igenom listan med inlägg och skriver ut alla inlägg om det finns några. Om det är tomt skrivs meddelande ut
    if (empty($post_list)) {
        echo "<p class='stored'> Det finns inga lagrade inlägg </p>";
    } else {
        foreach ($post_list as $row) {

    ?>

            <!--Utskrift-->
            <article class="create-article">
                <h3><?= $row['title'] ?></h3>
                <p class="posted">Postat: <?= $row['post_created'] ?></p>
                <p class="posted">Kategori: <?= $row['category_name'] ?></p>
                <?= $row['content'] ?>
            </article>


    <?php
        }
    }
    ?>
</main>
<?php
include('includes/footer.php');
?>