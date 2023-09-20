<?php
include "header.php";
?>
<head>
    <link href="css/admin.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="container registerContainer">
        <h1>Voeg activiteit toe</h1>
        <form method="post" action="">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="naam" name="naam" placeholder="Naam">
                <label for="naam">Naam</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="locatie" name="locatie" placeholder="Locatie">
                <label for="locatie">Locatie</label>
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" value="" id="eten" name="eten">
                <label class="form-check-label" for="eten">Eten</label>
            </div>
            <div class="form-floating mb-3">
                <input type="number" class="form-control" id="minDeelnemers" name="minDeelnemers" placeholder="1">
                <label for="minDeelnemers">Minimale deelnemers</label>
            </div>
            <div class="form-floating mb-3">
                <input type="number" class="form-control" id="maxDeelnemers" name="maxDeelnemers" placeholder="1">
                <label for="maxDeelnemers">Maximale deelnemers</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="kosten" name="kosten" placeholder="Kosten">
                <label for="kosten">Kosten</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="benodigdheden" name="benodigdheden" placeholder="Benodigdheden">
                <label for="benodigdheden">Benodigdheden</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="omschrijving" name="omschrijving" placeholder="Omschrijving">
                <label for="omschrijving">Omschrijving</label>
            </div>
            <div class="form-floating mb-3"> <!-- Hier moet voor de database de start tijd en eindtijd weggehaald worden, en moet er een string veld met datum toegevoegd worden -->
                <input type="text" class="form-control" id="datum" name="datum" placeholder="Datum"> <!-- Voorbeeld datum: 9 januari 10:00 tot 10 januari 15:00 -->
                <label for="datum">Datum</label>
            </div>
            <div class="mb-3">
                <label for="afbeelding" class="form-label"><b>Afbeelding</b></label>
                <input class="form-control" type="file" id="afbeelding" name="afbeelding">
            </div>
            <input type="button" class="btn btn-primary mt-1" value="Voeg toe">
        </form>

        <h1>Activiteiten</h1>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Naam</th>
                <th scope="col">Locatie</th>
                <th scope="col">Eten</th>
                <th scope="col">Deelnemers</th>
                <th scope="col">Kosten</th>
                <th scope="col">Benodigdheden</th>
                <th scope="col">Omschrijving</th>
                <th scope="col">Datum</th>
                <th scope="col">Acties</th>
              </tr>
            </thead>
            <tbody>
              <tr class="align-middle">
                <td>Naam</td>
                <td>Locatie</td>
                <td>Ja</td>
                <td>4-9</td>
                <td>300 euro</td>
                <td>Vervoer</td>
                <td>We gaan in Doetinchem midget golfen en...</td>
                <td>9 Januari 10:00 tot 15:00</td>
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