<?php
    include "header.php";
    include "./config/database_functions.php";
    include "./config/database_config.php";

?>

<body>
    <div class="container registerContainer">
        <h1>Bewerk persoon</h1>
        <form method="post" action="#">
            <div class="form-floating mb-3">
                <input type="email" class="form-control" name="email" placeholder="naam@voorbeeld.com">
                <label for="email">Email address</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="name" placeholder="naam">
                <label for="name">Name</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" name="password" placeholder="wachtwoord">
                <label for="password">Wachtwoord</label>
            </div>
            <div class="form-floating">
                <select class="form-select" name="rolId">
                  <option value="1" selected>Werknemer</option>
                  <option value="2">Admin</option>
                </select>
                <label for="rolId">Rol</label>
            </div>
            <input type="hidden" name="id" value="<?php echo $_POST['id']; ?>">
            <input type="submit" class="btn btn-primary mt-3" name="bewerken" value="Bewerken">
        </form>
</body>


<?php
if (isset($_POST['bewerken'])) {
    // Haal de ingevulde gegevens op uit het formulier
    $id = $_POST['id'];
    $email = $_POST['email'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    $rolId = $_POST['rolId'];

    // Voer de update uit
    // $id = $_GET['id']; // Hier ga ik ervan uit dat je een id-parameter in de URL hebt om de specifieke gebruiker te identificeren
    if (db_updateCovadiaan($id, $email, $name, $password, $rolId)) {
        //echo "Gegevens zijn succesvol bijgewerkt.";
        header("Location: accountBeheer.php");
        exit();
    } else {
        //echo "Fout bij het bijwerken van de gegevens.";
    }
}
?>


<?php
include "footer.php";
?>