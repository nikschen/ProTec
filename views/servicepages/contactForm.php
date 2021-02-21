<body class="Site">
<main class="Site-content">
    <h3>Kontaktformular</h3>
    
        <strong>Händler werden </strong><br>
            <p>Sie möchten unsere Produkte in Ihr Sortiment aufnehmen? <br>Da sind wird dabei!<br><br>
            Unsere Rabatte speziell für Geschäftskunden und Großabnehmer werden Ihnen gefallen.
            <br>
            Nehmen Sie hierzu mit uns per Mail Kontakt auf, und wir richten Ihnen Ihr Konto ein.
            </p>

            <strong>Formular Kontaktaufnahme</strong><br>
            
           
            <div class="registrationForm">
            <div class="contactForm">
            <form>
            <input type="text" name="company" placeholder="Firmenname*" <?if (isset($_POST['company'])){echo "value=".htmlspecialchars($_POST["company"]);};?> required >
            <input type="text" name="contactName" placeholder="Ansprechpartner*" <?if (isset($_POST['contactName'])){echo "value=".htmlspecialchars($_POST['contactName']);};?> required ><br>
            
            <input type="text" name="email" placeholder="Ihre E-Mail-Adresse*" <?if (isset($_POST['email'])){echo "value=".htmlspecialchars($_POST['email']);};?> required ><br>
            <input type="text" name="fon" placeholder="Telefon oder Mobilnummer:" <?if (isset($_POST['fon'])){echo "value=".htmlspecialchars($_POST['fon']);};?>><br>
            
        

            <h2>Ihre Adresse</h2>
            <hr>

            <input class="oneLine" type="text" name="streetInfo" placeholder="Straße*" <?if (isset($_POST['streetInfo'])){echo "value=".htmlspecialchars($_POST['streetInfo']);};?> required >
            <input class="oneLine" type="text" name="streetNo" placeholder="Hausnummer*" <?if (isset($_POST['streetNo'])){echo "value=".htmlspecialchars($_POST['streetNo']);};?> required ><br>
            <input type="text" name="address2" placeholder="Adresszusatz" <?if (isset($_POST['address2'])){echo "value=".htmlspecialchars($_POST['address2']);};?>><br>
            <input class="oneLine" type="text" name="zipcode" placeholder="PLZ*" <?if (isset($_POST['zipcode'])){echo "value=".htmlspecialchars($_POST['zipcode']);};?> required >
            <input class="oneLine" type="text" name="city" placeholder="Ort*" <?if (isset($_POST['city'])){echo "value=".htmlspecialchars($_POST['city']);};?> required ><br>
            <input type="text" name="country" placeholder="Land*" <?if (isset($_POST['country'])){echo "value=".htmlspecialchars($_POST['country']);};?> required ><br><br>
            <input type="submit" name="submit" value="Absenden"></input>
            <p style="font-size:small">Die mit * markierten Felder sind Pflichtfelder</p>
            
            </form>
            </div>
            </div>
        
    
</main>
</body>




