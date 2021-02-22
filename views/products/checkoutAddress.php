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
                    <thead style="text-align: left">
                    <tr>
                        <th>Lieferadresse</th>
                        <th>Rechnungsadresse</th>
                    </tr>
                    </thead>
                <tbody>
                <?if($billingAddress==false) $source=$address; else $source=$billingAddress;?>
                <tr>
                    <td><?=$customer->firstName." ".$customer->lastName ?></td>
                    <td><?=$customer->firstName." ".$customer->lastName ?></td>
                </tr>
                <tr>
                    <td><?=$address->street." ".$address->streetNumber?></td>
                    <td><?=$source->street." ".$address->streetNumber?></td>
                </tr>
                <tr>
                    <td><?=$address->zipCode." ".$address->city?></td>
                    <td><?=$source->zipCode." ".$address->city?></td>
                </tr>
                <tr>
                    <td><?=$address->country?></td>
                    <td><?=$source->country?></td>
                </tr>
                <tr>
                    <td><?=$customer->eMail?></td>
                    <td><?=$customer->eMail?></td>
                </tr>
                <tr>
                    <td><?=$address->additionalInformation?></td>
                    <td><?=$source->additionalInformation?></td>
                </tr>
                <tr>
                    <td><?=$address->phone?></td>
                    <td><?=$source->phone?></td>
                </tr>
                </tbody>
            </table>


            <form method="post">

            </form>

        </div>

        <a class="continueCheckoutButton" href="index.php?c=products&a=checkoutPaymentAndShipping">Weiter</a>
    </div>
</main>
</body>