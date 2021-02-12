<body class="Site">
<main class="Site-content">
    <div class="productBasketContentContainer">
        <h2>Ihr Warenkorb</h2>
        <div class="productBasketContainer">
            <div class="productBasketContent">
                <div class="productBasketElement">
                    <div class="columnHeaderProduct">Produkt</div>
                    <div class="columnHeaderQuantity">Anzahl</div>
                    <div class="columnHeaderPricing">Preis</div>
                </div>
            <?if ($_SESSION['productBasket']==null):?>
                <div class="productBasketElement">
                    <div class="columnContentProduct">------------</div>
                    <div class="columnContentQuantity">-</div>
                    <div class="columnContentPricing">-,--</div>
                </div>
            <?endif?>
            <?$summedUpQuantity=0; $summedUpPricing=0.0; $currency='Euro'?>
            <?if ($_SESSION['productBasket']!=null):?>
                <?foreach($_SESSION['productBasket'] as $productBasketEntry):?>
                    <?$product=\protec\model\Product::findOne("productID=".$productBasketEntry->productID);
                    $pricing=\protec\model\Pricing::findOne("pricingID=".$productBasketEntry->productID)?>

                    <div class="productBasketElement">
                         <div class="columnContentProduct"><?=$product->prodName?></div>
                         <div class="columnContentQuantity"><?=$productBasketEntry->quantityWanted?></div><?$summedUpQuantity+=$productBasketEntry->quantityWanted?>
                        <div class="columnContentPricing"><?= number_format($productBasketEntry->quantityWanted * $pricing->amount,2, ",",".")?> <?=$pricing->currency?></div><?$summedUpPricing+=$productBasketEntry->quantityWanted * $pricing->amount; $currency=$pricing->currency;?>
                    </div>

                <?endforeach?>
            <?endif?>
                <div class="productBasketElement">
                    <div class="columnSummaryProduct">Gesamt: </div>
                    <div class="columnSummaryQuantity"><?=$summedUpQuantity?></div>
                    <div class="columnSummaryPricing"><?=number_format($summedUpPricing,2, ",",".")?> <?=$currency?></div>
                </div>

            </div>
        </div>
        <form class="clearProductBasketForm" method="post">
            <button class="clearProductBasket" type="submit" name="resetProductBasket" value="resetProductBasket">Warenkorb leeren</button>
        </form>
    </div>
</main>
</body>