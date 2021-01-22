<body class="Site">
<main class="Site-content">
    <div class="productBasketContentContainer">
        <h2>Ihr Warenkorb</h2>
        <div class="productBasketContainer">
            <div class="productBasketContent">
                <?foreach($productBasket as $entry):?>

                    <div class="productBasketElement">
                        <p>Produkt: <?=\protec\model\Product::findOne($entry->productID)->prodName?>  |  Anzahl: <?=$entry->quantityWanted?></p>
                    </div>
                <?endforeach?>
            </div>
        </div>
    </div>
</main>
</body>