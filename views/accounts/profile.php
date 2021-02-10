<body class="Site">
<main class="Site-content">

<div class="registrationForm">

<?php if(isset($errors) && count($errors) > 0) : ?>
     <div class="error-message" style ="border-radius:5px;background-color: red; color: white">
     <ul>
         <?php foreach($errors as $key => $value) : ?>
            <li><?=$value?></li>
            <?php endforeach?>
         </ul>
         </div>
         <?php endif; ?>
         <?php if(isset($success) && $success) : ?>
        <div class="success-message" style="border-radius:5px;background-color:green; color: white">
        <p>Daten erfolgreich geändert!</p>
        </div>
        <?php endif; ?>

<?
    $customerTable = getUserInformation($_SESSION['email']); //initializes the logged in user with all his required infos
    echo "<pre style=color:green>";
    print_r($customerTable);
    echo "</pre>";
    
?>

<form method="POST">
        <h1>Ihre Anmeldedaten in der Übersicht</h1>
        <p>Ändern Sie hier bequem Ihre Daten...</p>
       
        <h2>Ihre Anmeldedaten</h2>
        <hr>
        <select name="Anrede" id="selectGenderProfile">
                <option value="male">Herr</option>
                <option value="female">Frau</option>
                <option value="heli">ApacheHelicopter</option>
            </select><br>

            <input type="text" name="title" placeholder="Titel" value="Titel noch nicht in DB"><br>

            <input type="text" name="lastName" placeholder="Ihr Name*" value="<?if(isset($_POST['lastName'])){echo $_POST['lastName'];}else{echo htmlspecialchars($customerTable[0]['lastName']);}?>"><br>
            <input type="text" name="firstName" placeholder="Ihr Vorname*" value="<?if(isset($_POST['firstName'])){echo $_POST['firstName'];}else{echo htmlspecialchars($customerTable[0]['firstName']);}?>"><br>
            <input type="text" class="birthDateToCheck" name="birthDate" placeholder="Geburtsdatum*" onchange='checkBirthDate()' value="<?if(isset($_POST['birthDate'])){echo $_POST['birthDate'];}else{echo htmlspecialchars(date('d.m.Y' , strtotime($customerTable[0]['birthDate'])));}?>"><br>

            <p class="messageDate"></p>                                                                                 

            <input type="text" class="emailToCheck" name="email" placeholder="Ihre E-Mail-Adresse*" onchange='checkEmail()' value="<?if(isset($_POST['eMail'])){echo $_POST['eMail'];}else{echo htmlspecialchars($customerTable[0]['eMail']);}?>"><br>

            <p class="messageMail"></p>

            <input type="text" name="phone" placeholder="Telefon oder Mobilnummer:" value="<?if(isset($_POST['phone'])){echo $_POST['phone'];}else{echo htmlspecialchars($customerTable[0]['phone']);}?>"><br>
       
        

            <h2>Ihre Adresse</h2>
            <hr>

            <input type="text" class="streetInfo" name="streetInfo" placeholder="Straße*" value="<?if(isset($_POST['streetInfo'])){echo $_POST['streetInfo'];}else{echo htmlspecialchars($customerTable[0]['street']);}?>"><br>
            <input class="streetNo" type="text" name="streetNo" placeholder="Hausnummer*" value="<?if(isset($_POST['streetNo'])){echo $_POST['streetNo'];}else{echo htmlspecialchars($customerTable[0]['streetNumber']);}?>"><br>
            <input type="text" name="address2" placeholder="Adresszusatz" value="<?if(isset($_POST['address2'])){echo $_POST['address2'];}else{echo htmlspecialchars($customerTable[0]['additionalInformation']);}?>"><br>
            <input class="oneLine" type="text" name="zipcode" placeholder="PLZ*" value="<?if(isset($_POST['zipcode'])){echo $_POST['zipcode'];}else{echo htmlspecialchars($customerTable[0]['zipCode']);}?>">
            <input class="oneLine" type="text" name="city" placeholder="Ort*" value="<?if(isset($_POST['city'])){echo $_POST['city'];}else{echo htmlspecialchars($customerTable[0]['city']);}?>"><br>
            <input type="text" name="country" placeholder="Land*" value="<?if(isset($_POST['country'])){echo $_POST['country'];}else{echo htmlspecialchars($customerTable[0]['country']);}?>"><br><br>
           
           
            <hr>
            <p>Nur ausfüllen ein, wenn Sie Ihr Passwort ändern möchten!</p>
            <input type="password" class="passwordOld" name="passwordOld" placeholder="Ihr bisheriges Passwort*">
            <input type="password" class="password1" name="password" placeholder="Ihr neues Passwort*" onchange='checkPassword()'>
            <input type="password" class="password2" name="password-repeat" placeholder="Ihr neues Passwort wiederholt*" onchange='checkPassword()'><br>

            <p class="messagePassword"></p>
           
           
            <p>Die mit * markierten Felder sind Pflichtfelder</p>
            <input type="submit" name="submit" value="Absenden"></input>

          
        </form>

<h2>Profilbearbeitung</h2>
<?
    //'birthDate' => date('Y-m-d', strtotime($birthDate))]);
    //echo date('d.m.Y' , strtotime($customerTable[0]['birthDate']));
    /*$AccountFromDataBase = \protec\model\Account::findOne('username = '. "\"" . $_SESSION['email'] . "\"" );
    echo "<pre>";
    print_r($AccountFromDataBase);
    echo "</pre>";
    echo $AccountFromDataBase->username;*/
?>
</div>
</main>
</body>