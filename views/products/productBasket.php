<body class="Site">
<main class="Site-content">
    <div class="productBasketContentContainer">
        <h2>Ihr Warenkorb</h2>
        <div class="productBasketContainer">
            <div class="productBasketContent">
                <?foreach($_SESSION['productBasket'] as $entry):?>

                    <div class="element">
                        <img src="<?=IMAGESPATH?><?=$entry->productID?>.png">
                        <p><?=$entry->prodName?><?=$entry->quantityWanted?></p></a>
                    </div>
                <?endforeach?>
            </div>
        </div>
    </div>
</main>
</body>

$_SESSION['productBasket']