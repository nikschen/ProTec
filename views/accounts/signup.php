<body class="Site">
<main class="Site-content">

    <?php if(isset($errors) && count($errors) > 0) : ?>
     <div class="error-message" style ="border: 1px dottet red">
     <ul>
         <?php foreach($errors as $key => $value) : ?>
            <li><?=$value?></li>
            <?php endforeach?>
         </ul>
         </div>
         <?php endif; ?>

   

    <div class="registrationForm">


    
    
  
        <?
        //$email= \protec\model\Customer::find();
        /*
        $email1 = "FreeWilly2000@gmx.de";
        $db = $GLOBALS['db'];
        $firstName = "Bernd";
        $lastName = "Hallelujah";
        $birthDate ="1000-03-03";
        $email = new \protec\model\Customer(['eMail' => $email1 , 'firstName' => $firstName, 'lastName' => $lastName, 'birthDate' => $birthDate]);//,['firstName' => $firstName ],['lastName' => $lastName ],['birthDate' => $birthDate ]);
        $changing = ['bernd@gmx.de', 'Bernd', 'Nachmany', '1000-02-02'];
        
        echo "<pre>";
        print_r($email);
        echo "</pre>";
        
        $email->insert();
        */
        
        
        //Working Insert Beispiel
        
        
        //insert von Hand zum Testen
        /*
        $sql="INSERT INTO customer ( firstName, lastName, birthDate ) VALUES (\"Bernd\",\"Stelter\",\"1000-02-02\" )";
        print_r($sql);
        $statement = $db->prepare($sql);
        $statement->execute();
         */




        /*echo "<pre>";
        print_r($email1);
        echo "</pre>";*/
        //exit(0);
        ?>
        
        
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
            <input type="text" name="birthDate" placeholder="Geburtsdatum*" <?if (isset($_POST['birthDate'])){echo "value=".htmlspecialchars($_POST['birthDate']);};?> required ><br>
            
            <input type="text" id="email" name="email" placeholder="Ihre E-Mail-Adresse*" onchange='checkEmail()' <?if (isset($_POST['email'])){echo "value=".htmlspecialchars($_POST['email']);};?> required ><pre id="message"></pre><br>
            <input type="text" name="fon" placeholder="Telefon oder Mobilnummer:" <?if (isset($_POST['fon'])){echo "value=".htmlspecialchars($_POST['fon']);};?>><br>
            <input class="oneLine" type="password" id="password1" name="password" placeholder="Ihr Passwort*" onkeyup='checkPassword()'required>
            <input class="oneLine" type="password" id="password2" name="password-repeat" placeholder="Ihr Passwort wiederholt*" onkeyup='checkPassword()'required>

        

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
</main>
</body>

