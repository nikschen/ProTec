<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/registration.css">
</head>

<body>


    <h1>Registrieren Sie sich als neuer Kunde von ProTec</h1>
    <p>Willkommen in der Welt von Morgen...heute schon.</p>

    <div class="registrationForm">

    <?//show Errors on RegistrationBoard
    if (isset($errors) && count($errors)>0) :        ?>
    <div class="error-message">
        <ul>
        <? foreach($errors as $key => $value)  :     ?>
            <li><?$value ?></li>
        <?endforeach?>
        </ul>
    </div>
    <? endif;?>
    
        <h2>Ihre Anmeldedaten</h2>

        <hr>
        <form method="POST">
            <?//PostArray elemnente behalten ohne Placeholder mit null zu überschreiben -> in meiner Lösung ist die Shorthand nicht verwendbar?>
            <input type="text" name="lastName" placeholder="Ihr Name*" <?if (isset($_POST['lastName'])){echo "value=".htmlspecialchars($_POST['lastName']);};?> required ><br>
            <input type="text" name="firstName" placeholder="Ihr Vorname*" <?if (isset($_POST['firstName'])){echo "value=".htmlspecialchars($_POST['firstName']);};?> required ><br>

            <select name="Anrede" id="selectgender">
                <option value="male">Herr</option>
                <option value="female">Frau</option>
                <option value="heli">ApacheHelicopter</option>
            </select><br>

            <input type="text" name="title" placeholder="Titel"><br>
            <input type="text" name="email" placeholder="Ihre E-Mail-Adresse*" required><br>
            <input type="text" name="title" placeholder="Telefon oder Mobilnummer:" required><br>
            <input type="password" name="passwort" placeholder="Ihr Passwort*" required>
            <input type="password" name="passwort-repeat" placeholder="Ihr Passwort wiederholt*" required>



            <h2>Ihre Adresse</h2>
            <hr>

            <input type="text" name="streetinfo" placeholder="Straße und Nr.*" required><br>
            <input type="text" name="additionaladdressinfo" placeholder="Adresszusatz"><br>
            <input type="text" name="zipcode" placeholder="PLZ*" required>
            <input type="text" name="city" placeholder="Ort*" required><br>
            <input type="text" name="country" placeholder="Land*" required><br><br>

            <input type="submit" name="submit" value="Absenden"></button>

        </form>

    </div>

</body>