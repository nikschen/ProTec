<body class="Site">
<main class="Site-content">
    <div class="productBasketContentContainer">
        <h2>Ihr Warenkorb</h2>
        <div class="productBasketContainer">
            <div class="productBasketContent">
                <?foreach($products as $product):?>

                    <div class="element">
                        <a href="index.php?c=pages&a=product&pid=<?=$product->productID?>">
                            <img src="<?=IMAGESPATH?><?=$product->productID?>.png">
                            <p><?=$product->prodName?></p></a>
                    </div>
                <?endforeach?>
            </div>
        </div>
    </div>
</main>
</body>

$_SESSION['productBasket']