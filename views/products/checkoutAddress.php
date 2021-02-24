<body class="Site">
<main class="Site-content">
    <div class="checkoutContainer">
        <div class="navigationHistory">
            <span class="addressConfirmation" style="color:var(--orangeAccentColor)">1. Ihre Adresse</span>
            <span class="paymentConfirmation">2. Zahlungs- und Versandart</span>
            <span class="orderConfirmation">3. Bestellprüfung und Checkout</span>
        </div>
        <div class="checkoutContent">
            <form method="post" action="index.php?c=products&a=checkoutPaymentAndShipping" >
                <div class="addressView">
                    <div class="shippingAddress">
                        <p> Ihre Lieferadresse</p>
                        <br>
                        <input type="text" name="firstNameShipping" placeholder="Ihr Vorname*" value="<?if (isset($_POST['firstNameShipping'])){echo htmlspecialchars($_POST['firstNameShipping']);}else echo $firstNameShippingValue?>" required >
                        <input type="text" name="lastNameShipping" placeholder="Ihr Name*" value="<?if (isset($_POST['lastNameShipping'])){echo htmlspecialchars($_POST["lastNameShipping"]);}else echo $lastNameShippingValue?>" required ><br>
                        <input class="oneLine" type="text" name="streetShipping" placeholder="Straße*" value="<?if (isset($_POST['streetShipping'])){echo htmlspecialchars($_POST['streetShipping']);}else echo $streetShippingValue?>" required >
                        <input class="oneLine" type="text" name="streetNoShipping" placeholder="Hausnummer*" value="<?if (isset($_POST['streetNoShipping'])){echo htmlspecialchars($_POST['streetNoShipping']);}else echo $streetNoShippingValue?>" required ><br>
                        <input class="oneLine" type="text" name="zipcodeShipping" placeholder="PLZ*" value="<?if (isset($_POST['zipcodeShipping'])){echo htmlspecialchars($_POST['zipcodeShipping']);}else echo $zipcodeShippingValue?>" required >
                        <input class="oneLine" type="text" name="cityShipping" placeholder="Ort*" value="<?if (isset($_POST['cityShipping'])){echo htmlspecialchars($_POST['cityShipping']);}else echo $cityShippingValue?>" required ><br>
                        <input type="text" name="countryShipping" id="countryShipping"placeholder="Land*" value="<?if (isset($_POST['countryShipping'])){echo htmlspecialchars($_POST['countryShipping']);}else echo $countryShippingValue?>" required ><br>
                        <input type="text" class="emailToCheck" id="email" name="emailShipping" placeholder="Ihre E-Mail-Adresse*"  onchange='checkEmail()' value="<?if (isset($_POST['emailShipping'])){echo htmlspecialchars($_POST['emailShipping']);}else echo $emailShippingValue?>" required >
                        <p class="messageMail" ></p>
                        <br>
                        <p class="note">Bitte beachten Sie, dass dies die letzte Chance ist,<br> um die Lieferadresse für diese Bestellung zu ändern.</p>
                    </div>

                    <div class="billingAddress">
                        <p> Ihre Rechnungsadresse</p>
                        <br>
                        <input type="text" name="firstNameBilling" placeholder="Ihr Vorname*" value="<?if (isset($_POST['firstNameBilling'])){echo htmlspecialchars($_POST['firstNameBilling']);}else echo $firstNameBillingValue?>" required >
                        <input type="text" name="lastNameBilling" placeholder="Ihr Name*" value="<?if (isset($_POST['lastNameBilling'])){echo htmlspecialchars($_POST["lastNameBilling"]);}else echo $lastNameBillingValue?>" required ><br>
                        <input class="oneLine" type="text" name="streetBilling" placeholder="Straße*" value="<?if (isset($_POST['streetBilling'])){echo htmlspecialchars($_POST['streetBilling']);}else echo $streetBillingValue?>" required >
                        <input class="oneLine" type="text" name="streetNoBilling" placeholder="Hausnummer*" value="<?if (isset($_POST['streetNoBilling'])){echo htmlspecialchars($_POST['streetNoBilling']);}else echo $streetNoBillingValue?>" required ><br>
                        <input class="oneLine" type="text" name="zipcodeBilling" placeholder="PLZ*" value="<?if (isset($_POST['zipcodeBilling'])){echo htmlspecialchars($_POST['zipcodeBilling']);}else echo $zipcodeBillingValue?>" required >
                        <input class="oneLine" type="text" name="cityBilling" placeholder="Ort*" value="<?if (isset($_POST['cityBilling'])){echo htmlspecialchars($_POST['cityBilling']);}else echo $cityBillingValue?>" required ><br>
                        <input type="text" name="countryBilling" id="countryBilling" placeholder="Land*" value="<?if (isset($_POST['countryBilling'])){echo htmlspecialchars($_POST['countryBilling']);}else echo $countryBillingValue?>" required ><br>
                        <p class="messageMail" ></p>
                        <br>

                        <p class="note">Bitte beachten Sie, dass dies die letzte Chance ist,<br> um die Rechnungsadresse für diese Bestellung zu ändern.</p>
                    </div>

                </div>
                <div class="endOfSite">
                    <button class="continueCheckoutButton" type="submit" name="submit" value="submit">Weiter</button>
                </div>
            </form>
        </div>

    </div>
</main>
</body>

