<body class="Site">
<main class="Site-content">
    <div class="subCategoryContentContainer">
        <h2><?=$category?></h2>
        <div class="contentContainer">
            <div class="subcategoryContent">
            <?foreach($products as $product):?>

                    <div class="element">
                        <a href="index.php?c=products&a=product&pid=<?=$product->productID?>">
                        <img src="<?=IMAGESPATH?><?=$product->productID?>.png"></a>
                        <p><?=$product->prodName?></p>
                    </div>
            <?endforeach?>
            </div>
        </div>
    </div>
</main>
</body>

