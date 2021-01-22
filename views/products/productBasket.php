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
                    <div class="columnContentPricing">-,--Euro</div>
                </div>
            <?endif?>
                <?$summedUpQuantity=0; $summedUpPricing=0.0?>
                <?foreach($_SESSION['productBasket'] as $productBasketEntry):?>
                    <?$product=\protec\model\Product::findOne("productID=".$productBasketEntry->productID);
                    $pricing=\protec\model\Pricing::findOne("pricingID=".$productBasketEntry->productID)?>

                    <div class="productBasketElement">
                         <div class="columnContentProduct"><?=$product->prodName?></div>
                         <div class="columnContentQuantity"><?=$productBasketEntry->quantityWanted?></div><?$summedUpQuantity+=$productBasketEntry->quantityWanted?>
                        <div class="columnContentPricing"><?=$pricing->amount?> <?=$pricing->currency?></div><?$summedUpPricing+=$pricing->amount?>
                    </div>

                <?endforeach?>
                <div class="productBasketElement">
                    <div class="columnSummaryProduct">Gesamt: </div>
                    <div class="columnSummaryQuantity"><?=$summedUpQuantity?></div>
                    <div class="columnSummaryPricing"><?=$summedUpPricing?> Euro</div>
                </div>

            </div>
        </div>
        <form class="clearProductBasketForm" action="index.php?c=pages&a=logout" method="post">
            <button class="clearProductBasket" type="submit" name="clearProductBasket" value="clearProductBasket">Warenkorb leeren</button>
        </form>
    </div>
</main>
</body>