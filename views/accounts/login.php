<body class="Site">
    <main class="Site-content">
        <?php if(isset($errors) && count($errors) > 0) : ?>
            <div class="error-message" style="border-radius:5px;background-color: red; color: white">
                <ul>
                    <?php foreach($errors as $key => $value) : ?>
                        <li><?=$value?></li>
                    <?php endforeach?>
                </ul>
            </div>
        <?php endif; ?>
        <?php if(isset($success) && $success) : ?>
            <div class="success-message" style="border-radius:5px;background-color:green; color: white">
                <ul>
                    <li>Erfolgreich angemeldet! Sie werden automatisch weitergeleitet...</li>
                </ul>
            </div>
        <?php endif; ?>
       
        <div class="loginForm">
            <h2>Login</h2>
            <hr>
            <form method="post">
                <label for="email">E-Mail</label> <br>
                <input type="email" id="emailLogin" name="email"  <?if (isset($_POST['email'])){echo "value=".htmlspecialchars($_POST['email']);};?> required ><br>
                <label for="password">Passwort</label><br>
                <input type="password" name="password" id="password"><br><br>
                <button type="submit" name="submit" value="Einloggen">Einloggen</button><br>
                <input class=loginRememberMe type="checkbox" name="Remember" <?=isset($_POST['Remember']) ? 'checked' : ''?>>Eingeloggt bleiben?
            </form><br>
        <a style="font-size:small" href="../pages/index.php?c=accounts&a=signup">Noch nicht registiert?</a>
        </div>
    </main>
</body>