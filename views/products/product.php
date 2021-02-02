<body class="Site">
<main class="Site-content">
    <div class="productPageContainer">
        <h3 class="productName"><?=$product->prodName?></h3>
        <div class="productContainer">
            <div class="productImage"><img src="<?=IMAGESPATH?><?=$product->productID?>.png" alt="Produktbild <?=$product->prodName?>"</div>
            <div class="productShortInfos">
                <div class="productPrice"><?=$productPrice?></div>
                <div class="taxesAndShippingInfo">inklusive MwSt. und Versandkosten</div>
                <div class="quantityAvailable"><span class=quantityNumber><?=$product->quantityStored?></span> Stück verfügbar</div>
                <form method="post">
                    <div class="addToBasketContainer">
                        <select name="quantityWanted" id="quantityWanted">
                            <?for($allowedAmount=1;$allowedAmount<=$product->quantityStored && $allowedAmount<=10;$allowedAmount++):?>
                            <option value="<?=$allowedAmount?>"><?=$allowedAmount?></option>
                            <?endfor?>
                        </select>
                        <button class="addToBasketButton" type="submit" name="submit" value="submit"><img class="addToBasketIcon" src="<?=ICONSPATH?>plusIcon.png" alt="+"/></button>
                    </div>
                </form>
            </div>
        </div>
        <div class="descriptionContainer">
            <div class="productDescription">
                <h4 class="descriptionHeadline">Wichtige Daten</h4>
                <p class="productDescriptionText">
                    <?=nl2br($product->prodDescription)?>
                </p>
            </div>
        </div>
    </div>
</main>
</body>

