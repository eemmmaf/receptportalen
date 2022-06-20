<?php
/*
 * @Author: Emma Forslund - emfo2102 
 * @Date: 2022-06-20 02:02:13 
 * @Last Modified by: Emma Forslund - emfo2102
 * @Last Modified time: 2022-06-20 02:33:44
 */
$page_title = "Mina sidor";
include('includes/header.php');
//Kontroll för att se om användaren är inloggad. Olika navigeringar visas beroende på om användare är inloggad eller ej
if (!isset($_SESSION['email'])) {
    header("Location:login.php");
}

//Creating new instance with Class User
$user = new User();
$username = $_SESSION['email'];

//Loopar igenom listan med användare
$aboutUser = $user->getUserInfo();

foreach ($aboutUser as $user) {
?>
    <main>
        <section class="userinfo">
            <div class="user">
        <h2><?= $user['blogname'] ?>s blogg <i class="fa-solid fa-user"></i></h2>
        <div id="profilepic">
                    <p>Hej</p>
                </div>
        <h3>Bloggarens namn</h3>
        <p><?= $user['fname'] . "  " . $user['lname'] ?></p>
        <h3>Bloggarens mailadress</h3>
        <p><?= $user['email']?></p>
        <h3>Blogg skapad</h3>
        <p><?= $user['user_created']?></p>
        <h3>Beskrivning av bloggen</h3>
        <p><?= $user['user_info']?></p>
        <h3>Antal blogginlägg</h3>
        <p>10</p>
        </div>
        
        </section>
    </main>

<?php }
include('includes/footer.php');
?>