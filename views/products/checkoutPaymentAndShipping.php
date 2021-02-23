<body class="Site">
<main class="Site-content">
    <div class="checkoutContainer">
        <div class="navigationHistory">
            <span class="addressConfirmation">1. Ihre Adresse</span>
            <span class="paymentConfirmation" style="color:var(--orangeAccentColor)">2. Zahlungs- und Versandart</span>
            <span class="orderConfirmation">3. Bestellprüfung und Checkout</span>
        </div>
        <div class="checkoutContent">
            <form method="post" action="index.php?c=products&a=checkoutCheckAndBuy">
                <div class="chooseMethods">
                    <div class="choosePaymentMethod">
                        <p> Zahlungsart</p>
                        <br>
                        <input type="radio" id="paymentMethod1" name="paymentMethod" value="IBAN" checked required><label for="paymentMethod1">IBAN</label><br>
                        <input type="radio" id="paymentMethod2" name="paymentMethod" value="PayPal" required><label for="paymentMethod2">PayPal</label><br>
                        <input type="radio" id="paymentMethod3" name="paymentMethod" value="Invoice" required><label for="paymentMethod3">Rechnung</label><br>
                        <br>
                        <input type="text" name="paymentNumber" placeholder="IBAN/PayPal-Adresse (wird ignoriert bei Kauf auf Rechnung)" value="<?if(isset($payDetail)) echo $payDetail->paymentNumber; else echo ''?>"><?if(isset($payDetail)) echo $payDetail->paymentNumber; else echo ''?></input><br>
                    </div>

                    <div class="chooseShippingMethod">
                        <p> Versandsart</p>
                        <br>
                        <input type="radio" id="shippingMethod1" name="shippingMethod" value="DHL" checked required><label for="shippingMethod1">DHL</label><br>
                        <input type="radio" id="shippingMethod2" name="shippingMethod" value="UPS Standard" required><label for="shippingMethod2">UPS Standard</label><br>
                        <input type="radio" id="shippingMethod3" name="shippingMethod" value="UPS Saver Express" required><label for="shippingMethod3">UPS Saver Express</label><br>
                        <br>
                    </div>
                </div>

                <div class="endOfSite">
                    <button class="continueCheckoutButton" type="submit" value="submit">Weiter</button>
                </div>
            </form>
        </div>

    </div>
</main>
</body>