<body class="Site">
<main class="Site-content">
    <div class="manageCustomersContainer">

        <h2>Kunden löschen</h2>
        <div class="deleteCustomerFormularContainer">
            <form method="POST">
                <div class="customerInput">
                    <input class="customerIDInput" type="text" name="customerID" placeholder="Customer ID des zu entfernenden Kunden" required>
                </div>
                <div class="passwordCheck">
                    <input class="adminPasswordCheck" type="password" name="password" placeholder="Administrator Passwort" required>
                </div>
                <div class="submitOperation">
                    <button type="submit" name="submit" value="deleteCustomer">Kunden entfernen</button>
                    <button type="reset" name="reset" value="reset">Zurücksetzen</button>
                </div>
            </form>
        </div>
        <div class="errorsContainer">
            <?
            if (!empty($errors)): ?>
                <?
                foreach ($errors as $error): ?>
                    <p class="manageCustomersError"><?= $error ?></p>
                <?
                endforeach ?>
            <?
            endif ?>
        </div>
        <p><? if(!empty($success)) echo $success;?></p>
    </div>
</main>
</body>