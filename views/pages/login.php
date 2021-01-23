<body class="Site">
    <main class="Site-content">

   <h2>Testrange</h2>
   <?php if(isset($errors) && count($errors) > 0) : ?>
     <div class="error-message" style ="border: 1px dottet red">
     <ul>
         <?php foreach($errors as $key => $value) : ?>
            <li><?=$value?></li>
            <?php endforeach?>

           
         </ul>
         </div>
         <?php endif; ?>
         <div class="loginForm">
        <h1>Login</h1>
        <hr>
        <form method="post">
            <label for="email">E-Mail</label> <br />
            <input type="email" id="emailLogin" name="email"  <?if (isset($_POST['email'])){echo "value=".htmlspecialchars($_POST['email']);};?> required ><br>
            <label for="password">Passwort</label> <br />
            <input type="password" name="password" id="password" /><br />
            <br />
            <button type="submit" name="submit" value="Einloggen">Einloggen</button>
            <input class=loginRememberMe type="checkbox" name="Remember" <?=isset($_POST['Remember']) ? 'checked' : ''?>>Stay tuned</input>
            <span class="loginRememberMe"><label><input class=loginRememberMe type="checkbox" name="RememberMe" value="RememberMe">Eingeloggt bleiben? </input></label></span>
        </form>
        <form action="index.php?c=pages&a=logout" method="post">
            <input type="submit" name="submitLogout" value="Logout Testbutton">
        </form>

        <a style="font-size:small" href="index.php?c=accounts&a=signup">Noch nicht registiert?</a>
        </div>
        <div class="Tests" style="color:white;font-size:large">
        <? 
        echo "Testfeld für Cookies"; 
        echo "<br>";
        if(isset($_SESSION['username']))
        {
            $user = $_SESSION['username'];
        }
        else {$user = ":   Nicht angemeldet!!!";}
        if(isset($_POST['Remember']))
        {
            $status = $_POST['Remember'];
        }
        else {$status = "off";}



        echo "User aus Session: " .  $user  ;
        echo "<br>";
        echo "RememberMe Status: " . $status ;
        echo "<br>";
        if(!isset($_COOKIE['email'])){
        echo "COOKIE EMAIL: " . $_COOKIE['email'];
        }
        else {echo "cookie email is not set";}
        echo "<br>";
        if(!isset($_COOKIE['password'])){
            echo "COOKIE PWHASH: " . $_COOKIE['password'];
            }
        else {echo "cookie PW Hash is not set";}
       
        //echo "Status RememberMeVariable: " . $_POST['RememberMe'];
        //echo $_POST['eMail'];
        //$title = $_POST['title'] ?? null
        ?>
        
        
        
        
        </div>
    </main>
</body>