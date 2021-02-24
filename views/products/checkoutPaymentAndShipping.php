<body class="Site">
<main class="Site-content">
    <div class="checkoutContainerShort">
        <div class="navigationHistory">
            <span class="addressConfirmation">1. Ihre Adresse</span>
            <span class="paymentConfirmation" style="color:var(--orangeAccentColor)">2. Zahlungs- und Versandart</span>
            <span class="orderConfirmation">3. Bestellprüfung und Checkout</span>
        </div>
        <div class="checkoutContentShort">
            <form method="post" >
                <div class="chooseMethods">
                    <div class="choosePaymentMethod">
                        <p>Zahlungsart</p>
                        <br>
                        <input type="radio" id="paymentMethod1" name="paymentMethod" value="IBAN" <?if(isset($_POST['paymentMethod'])){ if($_POST['paymentMethod']=='IBAN'){echo "checked";}else echo '';}else echo "checked"?> required onclick="showPaymentNumber()"><label for="paymentMethod1">IBAN</label><br>
                        <input type="radio" id="paymentMethod2" name="paymentMethod" value="PayPal" <?if(isset($_POST['paymentMethod'])){ if($_POST['paymentMethod']=='PayPal'){echo "checked";}else echo '';}?> required onclick="showPaymentNumber()"><label for="paymentMethod2">PayPal</label><br>
                        <input type="radio" id="paymentMethod3" name="paymentMethod" value="Invoice" <?if(isset($_POST['paymentMethod'])){ if($_POST['paymentMethod']=='Invoice'){echo "checked";}else echo '';}?> required onclick="hidePaymentNumber()"><label for="paymentMethod3">Rechnung</label><br>
                        <br>
                        <input type="text" id="paymentNumber"  name="paymentNumber" placeholder="IBAN/PayPal-Adresse" value="<?if(isset($payDetail)){ echo $payDetail->paymentNumber;} elseif (isset($_POST['paymentNumber'])) {echo htmlspecialchars($_POST['paymentNumber']);} else echo ''?>" required><br>
                        <?if(isset($error)):?>
                        <p class="errorMessage"><?=$error?></p>
                        <?endif?>
                    </div>

                    <div class="chooseShippingMethod">
                        <p>Versandsart</p>
                        <br>
                        <input type="radio" id="shippingMethod1" name="shippingMethod" value="DHL" checked required><label for="shippingMethod1">DHL</label><br>
                        <input type="radio" id="shippingMethod2" name="shippingMethod" value="UPS Standard" required><label for="shippingMethod2">UPS Standard</label><br>
                        <input type="radio" id="shippingMethod3" name="shippingMethod" value="UPS Saver Express" required><label for="shippingMethod3">UPS Saver Express</label><br>
                        <br>
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