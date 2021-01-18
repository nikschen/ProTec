<body class="Site">
<main class="Site-content">
    <h3 class="productName"><?=$product->prodName?></h3>
    <div class="productContainer">
    <div class="productImage"><img src="<?=IMAGESPATH?><?=$product->productID?>.png" alt="Produktbild <?=$product->prodName?>"</div>
        <div class="productShortInfos">
                <div class="productPrice"><?=$productPrice?></div>
                <div class="taxesAndShippingInfo">inklusive MwSt. und Versandkosten</div>
                <div class="quantityAvailable"><?=$product->quantityStored?> Stück verfügbar</div>
        </div>
    </div>
    <div class="descriptionContainer">
        <div class="productDescription">
            <h4 class="descriptionHeadline">Wichtige Daten</h4>
            <p class="productDescriptionText">
                <?=$product->prodDescription?>
            </p>
        </div>
    </div>
</main>
</body>

