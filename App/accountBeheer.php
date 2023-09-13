<?php
include "header.php";
?>
<head>
    <link href="css/accountBeheer.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="container registerContainer">
        <h1>Registreer personen</h1>
        <form method="post" action="">
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="email" placeholder="naam@voorbeeld.com">
                <label for="email">Email address</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="name" placeholder="naam">
                <label for="name">Name</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="password" placeholder="wachtwoord">
                <label for="password">Wachtwoord</label>
            </div>
            <div class="form-floating">
                <select class="form-select" id="rolId">
                  <option value="1" selected>Werknemer</option>
                  <option value="2">Admin</option>
                </select>
                <label for="rolId">Rol</label>
            </div>
            <input type="button" class="btn btn-primary mt-3" value="Registreer">
        </form>

        <h1>Personen (Accounts)</h1>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Naam</th>
                <th scope="col">Email</th>
                <th scope="col">Wachtwoord</th>
                <th scope="col">Rol</th>
                <th scope="col">Acties</th>
              </tr>
            </thead>
            <tbody>
              <tr class="align-middle">
                <td>Naam</td>
                <td>email@voorbeeld.example</td>
                <td>wachtwoord</td>
                <td>Werknemer</td>
                <td class="d-flex gap-3">
                    <button type="button" class="btn btn-warning">Bewerk</button>
                    <button type="button" class="btn btn-danger">Verwijder</button>
                </td>
              </tr>
            </tbody>
          </table>
    </div>
</body>

<?php
include "footer.php";
?>