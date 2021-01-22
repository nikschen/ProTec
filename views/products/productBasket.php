<body class="Site">
<main class="Site-content">
    <div class="productBasketContentContainer">
        <h2>Ihr Warenkorb</h2>
        <div class="productBasketContainer">
            <div class="productBasketContent">
                <div class="productBasketElement">
                    <div class="columnHeaderQuantity">Anzahl</div>
                    <div class="columnHeaderProduct">Produkt</div>
                </div>
            <?if ($_SESSION['productBasket']==null):?>
                <div class="productBasketElement">
                    <div class="columnContentQuantity">-</div>
                    <div class="columnContentProduct">------------</div>
                </div>
            <?endif?>
                <?foreach($_SESSION['productBasket'] as $productBasketEntry){?>
                    <?$product=\protec\model\Product::findOne("productID=".$productBasketEntry->productID);?>

                    <div class="productBasketElement">
                         <div class="columnContentQuantity"><?=$productBasketEntry->quantityWanted?></div>
                         <div class="columnContentProduct"><?=$product->prodName?></div>
                    </div>

                <?}?>

                <form action="index.php?c=pages&a=logout" method="post">
                    <input type="submit" name="submitLogout" value="Session beenden">
                </form>
            </div>
        </div>
    </div>
</main>
</body>