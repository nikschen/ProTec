<body class="Site">
<main class="Site-content">
    <div class="checkoutContainer">
        <div class="navigationHistory">
            <span class="addressConfirmation" style="color:var(--orangeAccentColor)">1. Ihre Adresse</span>
            <span class="paymentConfirmation">2. Zahlungs- und Versandart</span>
            <span class="orderConfirmation">3. Bestellprüfung und Checkout</span>
        </div>
        <div class="addressView">
            <table width="120%">
                <tr>
                    <td>Vorname & Nachname</td>
                    <td><?=$customer->firstName." ".$customer->lastName ?></td>
                </tr>
                <tr>
                    <td>Straße & Hausnummer</td>
                    <td><?=$address->street." ".$address->streetNumber?></td>
                </tr>
                <tr>
                    <td>PLZ & Ort</td>
                    <td><?=$address->zipCode." ".$address->city?></td>
                </tr>
                <tr>
                    <td>Land</td>
                    <td><?=$address->country?></td>
                </tr>
                <tr>
                    <td>Adresszusatz</td>
                    <td><?=$address->additionalInformation?></td>
                </tr>
                <tr>
                    <td>Telefonnummer</td>
                    <td><?=$address->phone?></td>
                </tr>
                <tr>
                    <td>E-Mail</td>
                    <td><?=$customer->eMail?></td>
                </tr>
            </table>
        </div>

        <a class="continueCheckoutButton" href="index.php?c=products&a=checkoutPaymentAndShipping">Weiter</a>
    </div>
</main>
</body>