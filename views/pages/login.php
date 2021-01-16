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
        <h1>Login</h1>
        <form method="post">
            <label for="email">E-Mail</label> <br />
            <input type="email" id="email" name="email"  <?if (isset($_POST['email'])){echo "value=".htmlspecialchars($_POST['email']);};?> required ><br>
            <label for="password">Passwort</label> <br />
            <input type="password" name="password" id="password" /><br />
            <br />
            <input type="submit" name="submit" value="Einloggen" /><br />
        </form>
        <form action="index.php?c=pages&a=logout" method="post">
            <input type="submit" name="submitLogout" value="Logout Testbutton">
        </form>

        <a style="font-size:small" href="index.php?c=accounts&a=signup">Noch nicht registiert?</a>
    </main>
</body>