<body class="Site">
<main class="Site-content">

<div class="registrationForm">

<?
    $customerTable = getUserInformation($_SESSION['email']); //initializes the logged in user with all his required infos




?>

<form method="POST">
        <h1>Ihre Anmeldedaten</h1>
        <p>Ändern Sie hier bequem Ihre Daten...</p>
       
        <h2>Ihre Anmeldedaten</h2>
        <hr>
        <select name="Anrede">
                <option value="male">Herr</option>
                <option value="female">Frau</option>
                <option value="heli">ApacheHelicopter</option>
            </select><br>

            <input type="text" name="title" placeholder="Titel" value="Titel noch nicht in DB"><br>

            <input type="text" name="lastName" placeholder="Ihr Name*" value="<?=htmlspecialchars($customerTable[0]['lastName']);?>"><br>
            <input type="text" name="firstName" placeholder="Ihr Vorname*" value="<?=htmlspecialchars($customerTable[0]['firstName']);?>"><br>
            <input type="text" class="birthDate" name="birthDate" placeholder="Geburtsdatum*" onchange='checkBirthDate()' value="<?=htmlspecialchars($customerTable[0]['birthDate']);?>"><br>

            <p class="messageDate"></p>

            <input type="text" class="email" name="email" placeholder="Ihre E-Mail-Adresse*" onchange='checkEmail()' value="<?=htmlspecialchars($customerTable[0]['eMail']);?>"><br>

            <p class="messageMail" ></p>

            <input type="text" name="fon" placeholder="Telefon oder Mobilnummer:" value="<?=htmlspecialchars($customerTable[0]['phone']);?>"><br>
            
            <input class="password1" type="password"  name="password" placeholder="Ihr Passwort*" onchange='checkPassword()'required>
            <input class="password2" type="password"  name="password-repeat" placeholder="Ihr Passwort wiederholt*" onchange='checkPassword()'required><br>

            <p class="messagePassword"></p>
        

            <h2>Ihre Adresse</h2>
            <hr>

            <input type="text" class="streetInfo" name="streetInfo" placeholder="Straße*" value="<?=htmlspecialchars($customerTable[0]['street']);?>"><br>
            <input class="streetNo" type="text" name="streetNo" placeholder="Hausnummer*" value="<?=htmlspecialchars($customerTable[0]['streetNumber']);?>"><br>
            <input type="text" name="address2" placeholder="Adresszusatz" value="<?=htmlspecialchars($customerTable[0]['additionalInformation']);?>"><br>
            <input class="oneLine" type="text" name="zipcode" placeholder="PLZ*" value="<?=htmlspecialchars($customerTable[0]['zipCode']);?>"><br>
            <input class="oneLine" type="text" name="city" placeholder="Ort*" value="<?=htmlspecialchars($customerTable[0]['city']);?>"><br>
            <input type="text" name="country" placeholder="Land*" value="<?=htmlspecialchars($customerTable[0]['country']);?>"><br><br>
            <p>Die mit * markierten Felder sind Pflichtfelder</p>
            <input type="submit" name="submit" value="Absenden"></input>
        </form>

<h2>Profilbearbeitung</h2>

</div>
</main>
</body>