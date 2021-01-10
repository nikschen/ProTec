
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/registration.css">
</head>

<body>


    <h1>Registrieren Sie sich als neuer Kunde von ProTec</h1>
    <p>Willkommen in der Welt von Morgen...heute schon.</p>
    
     <div class="registrationForm">
    <form action="" method="POST" enctype="text/plain">
    <h2>Ihre Logindaten</h2>
   
    <hr>
    <p>
        <input type="text" name="lastName" placeholder="Ihr Name" required>
        </p>
        <p>
        <input type="text" name="firstName" placeholder="Ihr Vorname" required>
        </p>
        <p>
            <select name="Anrede" id="selectgender">
                <option value="male">Herr</option>
                <option value="female">Frau</option>
                <option value="heli">ApacheHelicopter</option>
            </select>
        </p>
        <p>
        <input type="text" name="title" placeholder="Titel" required>
        </p>
        <p>
       <input type="text" name="email" placeholder="Ihre E-Mail-Adresse*" required>
        </p>
        <p>
        <input type="password" name="passwort" placeholder="Ihr Passwort*" required>
        </p>
        <p>
        <input type="password" name="passwort-repeat" placeholder="Ihr Passwort*" required>
        </p>
        <p>
       <input type="text" name="title" placeholder="Telefon oder Mobilnummer:" required>
        </p>

        <h2>Ihre Adresse</h2>
        <hr>
        <p>
        <input type="text" name="streetinfo" placeholder="Straße und Nr." required>
        </p>
        <p>
        <input type="text" name="additionaladdressinfo" placeholder="Adresszusatz">
        </p>
        <p>
        <input type="text" name="zipcode" placeholder="PLZ*" required>
        </p>
        <p>
       <input type="text" name="city" placeholder="Ort*" required>
        </p>
        <p>
        <input type="text" name="country" placeholder="Land*" required>
        </p>
      <p>
            <input type="submit" name="submit" value="Absenden"></button>
      </p>
        </form>

    </div>

</body>