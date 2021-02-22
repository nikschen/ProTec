<body class="Site">
<main class="Site-content">
    <div class="checkoutContainer">
        <div class="navigationHistory">
            <span class="addressConfirmation">1. Ihre Adresse</span>
            <span class="paymentConfirmation">2. Zahlungs- und Versandart</span>
            <span class="orderConfirmation" style="color:var(--orangeAccentColor)">3. Bestellprüfung und Checkout</span>
        </div>
        <div style="width:60%" class="productBasketSummary">
            <?$summedUpQuantity=0; $summedUpPricing=0.0; $currency='Euro'?>
            <table style="width:90%" class="productBasketContentCheckout">
                <thead>
                <tr class="productBasketElement">
                    <th class="columnHeaderProduct">Produkt</th>
                    <th class="columnHeaderQuantity">Anzahl</th>
                    <th class="columnHeaderPricing">Preis</th>
                </tr>
                </thead>
                <tbody>
                    <?foreach($_SESSION['productBasket'] as $productBasketEntry):?>
                        <?$product=\protec\model\Product::findOne("productID=".$productBasketEntry->productID);
                        $pricing=\protec\model\Pricing::findOne("pricingID=".$productBasketEntry->productID)?>
                            <tr class="productBasketElement">
                                <td class="columnContentProduct"><a class="columnContentProduct" href="index.php?c=products&a=product&pid=<?=$productBasketEntry->productID?>"><?=$product->prodName?></td>
                                <td class="columnContentQuantity">
                                    <?=$productBasketEntry->quantityWanted?>
                                </td>
                                <?$summedUpQuantity+=$productBasketEntry->quantityWanted?>
                                <td class="columnContentPricing">
                                    <?= number_format($productBasketEntry->quantityWanted * $pricing->amount,2, ",",".")?> <?=$pricing->currency?>
                                </td>
                                <?$summedUpPricing+=$productBasketEntry->quantityWanted * $pricing->amount; $currency=$pricing->currency;?>
                            </tr>
                    <?endforeach?>
                </tbody>
                <tfoot>
                <tr class="productBasketElement">
                    <th class="columnSummaryProduct">Gesamt: &nbsp;</th>
                    <th class="columnSummaryQuantity"><?=$summedUpQuantity?></th>
                    <th class="columnSummaryPricing"><?=number_format($summedUpPricing,2, ",",".")?> <?=$currency?></th>
                </tr>
                </tfoot>
            </table>
        </div>

        <div class="endOfSite">
            <a class="continueCheckoutButton" href="index.php?c=products&a=checkoutAfterPurchase">Zahlungspflichtig bestellen</a>
        </div>
    </div>
</main>
</body>