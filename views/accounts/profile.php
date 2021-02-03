<body class="Site">
<main class="Site-content">

<div class="registrationForm">

<?
    $customerTable = getUser($_SESSION['email']);




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

            <input type="text" name="lastName" placeholder="Ihr Name*" value="<?=htmlspecialchars($customerTable->lastName);?>"><br>
            <input type="text" name="firstName" placeholder="Ihr Vorname*" value="<?=htmlspecialchars($customerTable->firstName);?>"><br>
            <input type="text" class="birthDate" name="birthDate" placeholder="Geburtsdatum*" onchange='checkBirthDate()' value="<?=htmlspecialchars($customerTable->birthDate);?>"><br>

            <p class="messageDate"></p>

            <input type="text" class="email" name="email" placeholder="Ihre E-Mail-Adresse*" onchange='checkEmail()' value="<?=htmlspecialchars($customerTable->eMail);?>"><br>

            <p class="messageMail" ></p>

            <input type="text" name="fon" placeholder="Telefon oder Mobilnummer:" <?if (isset($_POST['fon'])){echo "value=".htmlspecialchars($_POST['fon']);};?>><br>
            
            <input class="password1" type="password"  name="password" placeholder="Ihr Passwort*" onchange='checkPassword()'required>
            <input class="password2" type="password"  name="password-repeat" placeholder="Ihr Passwort wiederholt*" onchange='checkPassword()'required><br>

            <p class="messagePassword"></p>
        

            <h2>Ihre Adresse</h2>
            <hr>

            <input type="text" class="streetInfo" name="streetInfo" placeholder="Straße*" <?if (isset($_POST['streetInfo'])){echo "value=".htmlspecialchars($_POST['streetInfo']);};?> required >
            <input class="streetNo" type="text" name="streetNo" placeholder="Hausnummer*" <?if (isset($_POST['streetNo'])){echo "value=".htmlspecialchars($_POST['streetNo']);};?> required ><br>
            <input type="text" name="address2" placeholder="Adresszusatz" <?if (isset($_POST['address2'])){echo "value=".htmlspecialchars($_POST['address2']);};?>><br>
            <input class="oneLine" type="text" name="zipcode" placeholder="PLZ*" <?if (isset($_POST['zipcode'])){echo "value=".htmlspecialchars($_POST['zipcode']);};?> required >
            <input class="oneLine" type="text" name="city" placeholder="Ort*" <?if (isset($_POST['city'])){echo "value=".htmlspecialchars($_POST['city']);};?> required ><br>
            <input type="text" name="country" placeholder="Land*" <?if (isset($_POST['country'])){echo "value=".htmlspecialchars($_POST['country']);};?> required ><br><br>
            <p>Die mit * markierten Felder sind Pflichtfelder</p>
            <input type="submit" name="submit" value="Absenden"></input>
        </form>

<h2>Profilbearbeitung</h2>

</div>
</main>
</body>