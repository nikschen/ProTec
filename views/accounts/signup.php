<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/registration.css">
    <script type="text/javascript" src="..\..\assets\js\registerform.js"></script>
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
    <? if($success === true ) : ?>
    <div class="success-message">
    Ihr Konto wurde angelegt. Sie werden in auf die Login-Seite weitergeleitet...
    <meta http-equiv="refresh" content="5; URL=index.php?c=pages&a=login">
    </div>
    <? else : ?>
        <h2>Ihre Anmeldedaten</h2>
        <hr>
        <form method="POST">
            
            <input type="text" name="lastName" placeholder="Ihr Name*" <?if (isset($_POST['lastName'])){echo "value=".htmlspecialchars($_POST["lastName"]);};?> required ><br>
            <input type="text" name="firstName" placeholder="Ihr Vorname*" <?if (isset($_POST['firstName'])){echo "value=".htmlspecialchars($_POST['firstName']);};?> required ><br>
            
            <select name="Anrede" id="selectgender">
                <option value="male">Herr</option>
                <option value="female">Frau</option>
                <option value="heli">ApacheHelicopter</option>
            </select><br>

            <input type="text" name="title" placeholder="Titel" <?if (isset($_POST['title'])){echo "value=".htmlspecialchars($_POST['title']);};?>><br>
            <input type="text" name="email" placeholder="Ihre E-Mail-Adresse*" <?if (isset($_POST['email'])){echo "value=".htmlspecialchars($_POST['email']);};?> required ><br>
            <input type="text" name="fon" placeholder="Telefon oder Mobilnummer:" <?if (isset($_POST['fon'])){echo "value=".htmlspecialchars($_POST['fon']);};?>><br>
            <input type="password" id="password1" name="password" placeholder="Ihr Passwort*" required>
            <input type="password" id="password2" name="passwort-repeat" placeholder="Ihr Passwort wiederholt*" required>



            <h2>Ihre Adresse</h2>
            <hr>

            <input type="text" name="streetInfo" placeholder="Straße*" <?if (isset($_POST['streetInfo'])){echo "value=".htmlspecialchars($_POST['streetInfo']);};?> required >
            <input type="text" name="streetNo" placeholder="Hausnummer*" <?if (isset($_POST['streetNo'])){echo "value=".htmlspecialchars($_POST['streetNo']);};?> required ><br>
            <input type="text" name="address2" placeholder="Adresszusatz" <?if (isset($_POST['address2'])){echo "value=".htmlspecialchars($_POST['address2']);};?>><br>
            <input type="text" name="zipcode" placeholder="PLZ*" <?if (isset($_POST['zipcode'])){echo "value=".htmlspecialchars($_POST['zipcode']);};?> required >
            <input type="text" name="city" placeholder="Ort*" <?if (isset($_POST['city'])){echo "value=".htmlspecialchars($_POST['city']);};?> required ><br>
            <input type="text" name="country" placeholder="Land*" <?if (isset($_POST['country'])){echo "value=".htmlspecialchars($_POST['country']);};?> required ><br><br>

            <input type="submit" name="submit" value="Absenden"></input>

        </form>

    </div>
    <? endif;?>
</body>