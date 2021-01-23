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
            <span class="loginRememberMe"><label><input class=loginRememberMe type="checkbox" name="RememberMe" value="RememberMe">Eingeloggt bleiben? </input></label></span>
        </form>
        <form action="index.php?c=pages&a=logout" method="post">
            <input type="submit" name="submitLogout" value="Logout Testbutton">
        </form>

        <a style="font-size:small" href="index.php?c=accounts&a=signup">Noch nicht registiert?</a>
        </div>
    </main>
</body>