<body class="Site">
<main class="Site-content">
    <div class="productBasketContentContainer">
        <h2>Ihr Warenkorb</h2>
        <?$summedUpQuantity=0; $summedUpPricing=0.0; $currency='Euro'?>

        <table class="productBasketContent">
            <thead>
                <tr class="productBasketElement">
                    <th class="columnHeaderProduct">Produkt</th>
                    <th class="columnHeaderQuantity">Anzahl</th>
                    <th class="columnHeaderPricing">Preis</th>
                </tr>
            </thead>
            <tbody>
                <?if ($_SESSION['productBasket']==null) {?>
                <tr class="productBasketElement">
                            <td class="columnContentProduct">------------</td>
                            <td class="columnContentQuantity">-</td>
                            <td class="columnContentPricing">-,--</td>
                </tr>

                <?}else{?>
                <?foreach($_SESSION['productBasket'] as $productBasketEntry):?>
                    <?$product=\protec\model\Product::findOne("productID=".$productBasketEntry->productID);
                    $pricing=\protec\model\Pricing::findOne("pricingID=".$productBasketEntry->productID)?>
                    <tr class="productBasketElement">
                        <td class="columnContentProduct"><a href="index.php?c=products&a=product&pid=<?=$productBasketEntry->productID?>"> a<?=$product->prodName?></td>
                        <td class="columnContentQuantity">
                            <form method="post">
                                <select name="quantityWanted" id="quantityWanted">
                                    <option hidden="hidden" disabled="disabled" selected="selected" value="$productBasketEntry->quantityWanted"><?=$productBasketEntry->quantityWanted?></option>
                                    <?for($allowedAmount=1;$allowedAmount<=$product->quantityStored && $allowedAmount<=10;$allowedAmount++):?>
                                        <?if($allowedAmount!=$productBasketEntry->quantityWanted):?>
                                        <option value="<?=$allowedAmount?>"><?=$allowedAmount?></option>
                                        <?else:?>
                                        <option value="<?=$productBasketEntry->quantityWanted?>"><?=$productBasketEntry->quantityWanted?></option>
                                        <?endif?>
                                    <?endfor?>
                                </select>
                                <button class="updateWantedQuantityButton" name="updateWantedQuantity" type="submit" value="changeOfProductID<?=$productBasketEntry->productID?>"><img class="updateWantedQuantityIcon" src="<?=ICONSPATH?>updateIcon.png" alt="Update"></button>
                            </form>
                        </td>
                        <?$summedUpQuantity+=$productBasketEntry->quantityWanted?>
                        <td class="columnContentPricing"><?= number_format($productBasketEntry->quantityWanted * $pricing->amount,2, ",",".")?> <?=$pricing->currency?></td><?$summedUpPricing+=$productBasketEntry->quantityWanted * $pricing->amount; $currency=$pricing->currency;?>
                    </tr>

                <?endforeach?>
                <?}?>
            </tbody>
            <tfoot>
                <tr class="productBasketElement">
                    <th class="columnSummaryProduct">Gesamt: &nbsp;</th>
                    <th class="columnSummaryQuantity"><?=$summedUpQuantity?></th>
                    <th class="columnSummaryPricing"><?=number_format($summedUpPricing,2, ",",".")?> <?=$currency?></th>
                </tr>
            </tfoot>
        </table>
        <form class="clearProductBasketForm" method="post">
            <button class="clearProductBasket" type="submit" name="resetProductBasket" value="resetProductBasket">Warenkorb leeren</button>
        </form>
    </div>
</main>
</body>