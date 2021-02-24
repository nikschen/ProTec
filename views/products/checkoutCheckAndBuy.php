<body class="Site">
<main class="Site-content">
    <div class="checkoutContainer">
        <div class="navigationHistory">
            <span class="addressConfirmation">1. Ihre Adresse</span>
            <span class="paymentConfirmation">2. Zahlungs- und Versandart</span>
            <span class="orderConfirmation" style="color:var(--orangeAccentColor)">3. Bestellprüfung und Checkout</span>
        </div>
        <div class="summaryCheckoutContainer">
            <div class="productBasketSummary">
                <?$summedUpQuantity=0; $summedUpPricing=0.0; $currency='Euro'?>
                <table class="productBasketContentCheckout">
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
                        <th class="columnSummaryProduct">Gesamt:&nbsp;</th>
                        <th class="columnSummaryQuantity"><?=$summedUpQuantity?></th>
                        <th class="columnSummaryPricing"><?=number_format($summedUpPricing,2, ",",".")?> <?=$currency?></th>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <div class="shippingAndPaymentSummary">
                <div class="shippingSummary">
                    <table>
                        <thead>
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
                </div>
                <div class="paymentSummary">
                    <table>
                        <thead>
                            <tr>
                                <th class="tableHeader">Zahlungsart</th>
                                <th class="tableHeader">Versanddetails</th>
                            </tr>
                        </thead>
                        <tr>
                            <td><?=$paymentMethod?></td>
                            <td><?=$shippingMethod?></td>
                        </tr>
                        <?if ($paymentMethod!="Rechnung"):?>
                            <tr>
                                <td><br></td>
                                <td><br></td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold">Zahlungsdetails</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><?=$paymentDetails?></td>
                                <td></td>
                            </tr>
                        <?endif?>
                    </table>

                </div>
            </div>

        </div>
        <div class="endOfSite">
            <a class="continueCheckoutButton" href="index.php?c=products&a=checkoutAfterPurchase">Zahlungspflichtig bestellen</a>
        </div>
    </div>
</main>
</body>