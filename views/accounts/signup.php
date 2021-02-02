<body class="Site">
<main class="Site-content">

    <?php if(isset($errors) && count($errors) > 0) : ?>
     <div class="error-message" style ="border-radius:5px;background-color: red; color: white">
     <ul>
         <?php foreach($errors as $key => $value) : ?>
            <li><?=$value?></li>
            <?php endforeach?>
         </ul>
         </div>
         <?php endif; ?>

    

    <div class="registrationForm">


    
    
  
    <?php if(isset($success) && $success) : ?>
        <div class="success-message" style="border-radius:5px;background-color:green; color: white">
        <p>Erfolgreich angemeldet!</p>
        </div>
        <?php endif; ?>
        
        
        <form method="POST">
        <h1>Registrieren Sie sich als neuer Kunde von ProTec!</h1>
        <p>Willkommen in der Welt von Morgen...heute schon.</p>
       
        <h2>Ihre Anmeldedaten</h2>
        <hr>
        <select name="Anrede" id="selectgender">
                <option value="male">Herr</option>
                <option value="female">Frau</option>
                <option value="heli">ApacheHelicopter</option>
            </select><br>

            <input type="text" name="title" placeholder="Titel" <?if (isset($_POST['title'])){echo "value=".htmlspecialchars($_POST['title']);};?>><br>

            <input type="text" name="lastName" placeholder="Ihr Name*" <?if (isset($_POST['lastName'])){echo "value=".htmlspecialchars($_POST["lastName"]);};?> required ><br>
            <input type="text" name="firstName" placeholder="Ihr Vorname*" <?if (isset($_POST['firstName'])){echo "value=".htmlspecialchars($_POST['firstName']);};?> required ><br>
            <input type="text" id="birthDate" name="birthDate" placeholder="Geburtsdatum*" onchange='checkBirthDate()' <?if (isset($_POST['birthDate'])){echo "value=".htmlspecialchars($_POST['birthDate']);};?> required >
            <p id="messageDate"></p>
            <input type="text" id="email" name="email" placeholder="Ihre E-Mail-Adresse*" onchange='checkEmail()' <?if (isset($_POST['email'])){echo "value=".htmlspecialchars($_POST['email']);};?> required >
            <p id="messageMail" ></p>
            <input type="text" name="fon" placeholder="Telefon oder Mobilnummer:" <?if (isset($_POST['fon'])){echo "value=".htmlspecialchars($_POST['fon']);};?>><br>
            <input class="oneLine" type="password" id="password1" name="password" placeholder="Ihr Passwort*" onchange='checkPassword()'required>
            <input class="oneLine" type="password" id="password2" name="password-repeat" placeholder="Ihr Passwort wiederholt*" onchange='checkPassword()'required><br>
            <p id="messagePassword"></p>
        

            <h2>Ihre Adresse</h2>
            <hr>

            <input type="text" class="oneLine"  id="streetInfo" name="streetInfo" placeholder="Straße*" <?if (isset($_POST['streetInfo'])){echo "value=".htmlspecialchars($_POST['streetInfo']);};?> required >
            <input class="oneLine" type="text" name="streetNo" placeholder="Hausnummer*" <?if (isset($_POST['streetNo'])){echo "value=".htmlspecialchars($_POST['streetNo']);};?> required ><br>
            <input type="text" name="address2" placeholder="Adresszusatz" <?if (isset($_POST['address2'])){echo "value=".htmlspecialchars($_POST['address2']);};?>><br>
            <input class="oneLine" type="text" name="zipcode" placeholder="PLZ*" <?if (isset($_POST['zipcode'])){echo "value=".htmlspecialchars($_POST['zipcode']);};?> required >
            <input class="oneLine" type="text" name="city" placeholder="Ort*" <?if (isset($_POST['city'])){echo "value=".htmlspecialchars($_POST['city']);};?> required ><br>
            <input type="text" name="country" placeholder="Land*" <?if (isset($_POST['country'])){echo "value=".htmlspecialchars($_POST['country']);};?> required ><br><br>
            <p>Die mit * markierten Felder sind Pflichtfelder</p>
            <input type="submit" name="submit" value="Absenden"></input>
        </form>
    </div>
    <div class="testing">
    <?

    
    
    
    
    
    

?>
    </div>
</main>
</body>

